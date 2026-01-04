<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CpriSubmission extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'batch_revision_id',
        'submission_date',
        'cpri_reference',
        'status',
        'remarks',
        'submitted_by'
    ];

    protected $casts = [
        'submission_date' => 'date',
    ];

    // the revision we are tracking here
    public function revision(): BelongsTo
    {
        return $this->belongsTo(BatchRevision::class, 'batch_revision_id');
    }

    // who did the work
    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    // color for the dash
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'approved' => 'success',
            'rejected' => 'danger',
            default    => 'warning'
        };
    }
}
