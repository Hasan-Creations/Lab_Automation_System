<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestResult extends Model
{
    protected $fillable = [
        'test_id',
        'product_id',
        'product_code',
        'revision_number',
        'tester_name',
        'tester_department',
        'batch_revision_id',
        'test_type_id',
        'tester_id',
        'result',
        'observed_value',
        'remarks',
        'tested_at'
    ];

    protected $casts = [
        'tested_at' => 'datetime',
    ];

    public function revision(): BelongsTo
    {
        return $this->belongsTo(BatchRevision::class, 'batch_revision_id');
    }

    public function testType(): BelongsTo
    {
        return $this->belongsTo(TestType::class);
    }

    public function tester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tester_id');
    }

    // this runs when we save a record to grab some snapshots
    protected static function booted()
    {
        static::creating(function (TestResult $item) {
            // grab the latest info
            $rev = BatchRevision::with('batch.productType')->find($item->batch_revision_id);
            $user = User::with('dept')->find($item->tester_id);

            if ($rev && $user) {
                // save info so it doesn't change later
                $item->product_id = $rev->batch->product_id;
                $item->product_code = $rev->batch->productType->prefix ?? 'GEN';
                $item->revision_number = $rev->revision_number;

                // save who did it
                $item->tester_name = $user->full_name;
                $item->tester_department = $user->dept->name ?? 'QC';

                // make the 12 digit id if we don't have it
                if (!$item->test_id) {
                    $item->test_id = static::makeSimpleId($rev, $item->test_type_id);
                }
            }
        });
    }

    // build the 12 digit code for the srs report
    public static function makeSimpleId(BatchRevision $rev, $type_id): string
    {
        $type = TestType::findOrFail($type_id);

        $p_code = str_pad($rev->batch->productType->prefix, 3, '0', STR_PAD_LEFT);
        $r_num = str_pad(filter_var($rev->revision_number, FILTER_SANITIZE_NUMBER_INT), 2, '0', STR_PAD_LEFT);
        $t_code = str_pad($type->test_code, 4, '0', STR_PAD_LEFT);

        // check how many tests we already have
        $count = TestResult::where('batch_revision_id', $rev->id)->count() + 1;
        $seq = str_pad($count, 3, '0', STR_PAD_LEFT);

        return substr($p_code . $r_num . $t_code . $seq, 0, 12);
    }
}
