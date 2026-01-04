<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BatchRevision extends Model
{
    protected $fillable = [
        'batch_id',
        'revision_number',
        'status',
        'created_by',
        'failed_at',
        'approved_at'
    ];

    protected $casts = [
        'failed_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    // the parent batch
    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    // all the test results for this try
    public function testResults(): HasMany
    {
        return $this->hasMany(TestResult::class);
    }

    // who started this revision
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // is it done?
    public function isCompleted(): bool
    {
        $done_list = ['APPROVED', 'FAILED', 'CPRI_PENDING', 'CPRI_APPROVED', 'CPRI_REJECTED'];
        return in_array($this->status, $done_list);
    }

    // color for the ui
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'APPROVED', 'CPRI_APPROVED' => 'success',
            'FAILED', 'CPRI_REJECTED'  => 'danger',
            'CPRI_PENDING'              => 'info',
            default                     => 'warning'
        };
    }

    // pretty status text
    public function getStatusLabelAttribute(): string
    {
        return str_replace('_', ' ', $this->status);
    }
}
