@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0">Record Test Result</h2>
                <p class="text-secondary mb-0">Submit quality control results for pending batches.</p>
            </div>
            <div class="text-end">
                <span class="badge bg-primary px-3 py-2 fs-6">Department: {{ Auth::user()->dept->name ?? 'N/A' }}</span>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm mb-4">{{ session('error') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($pending->isEmpty())
        <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
            <div class="mb-3">
                <i class="fas fa-check-circle fa-4x text-success bg-success bg-opacity-10 p-4 rounded-circle"></i>
            </div>
            <h4 class="fw-bold">No Pending Batches</h4>
            <p class="text-secondary">Great job! All batches for your department have been tested today.</p>
        </div>
        @else
        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-5">
                <form action="{{ route('user.tests.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold">Select Batch & Revision</label>
                        <select name="batch_id" id="batchSelect" class="form-select bg-light border-0 py-3" required>
                            <option value="">-- Choose Batch to Test --</option>
                            @foreach($pending as $batch)
                            <option value="{{ $batch->id }}" data-type="{{ $batch->productType->name }}">
                                {{ $batch->batch_code }} ({{ $batch->currentRevision->revision_number }}) - {{ $batch->productType->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4 d-none" id="testTypeContainer">
                        <label class="form-label fw-bold">Select Test Type</label>
                        <select name="test_type_id" id="testTypeSelect" class="form-select bg-light border-0 py-3" disabled>
                            <option value="">-- Select Test --</option>
                            {{-- Options populated by JS --}}
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Result Outcome</label>
                        <div class="d-flex gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="result" id="resPass" value="PASS" required>
                                <label class="form-check-label text-success fw-bold" for="resPass">PASS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="result" id="resFail" value="FAIL">
                                <label class="form-check-label text-danger fw-bold" for="resFail">FAIL</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Observed Value / Reading</label>
                        <input type="text" name="observed_value" class="form-control bg-light border-0 py-3" placeholder="Enter measurement or observation...">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Remarks / Technical Notes</label>
                        <textarea name="remarks" class="form-control bg-light border-0" rows="2" placeholder="Any additional details..."></textarea>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary py-3 fw-bold" style="border-radius: 12px;">Submit Final Result</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>

@php
// Build a simple array: batchId => [ {id, name}, ... ]
$batchTests = [];
foreach ($pending as $batch) {
$tests = [];
$rev = $batch->currentRevision;

// get list of tests already done
$performedIds = [];
foreach ($rev->testResults as $res) {
$performedIds[] = $res->test_type_id;
}

// check what else is needed
foreach ($batch->productType->requirements as $req) {
$testType = $req->testType;

$alreadyDone = false;
foreach ($performedIds as $pId) {
if ($pId == $testType->id) {
$alreadyDone = true;
break;
}
}

if ($alreadyDone == false) {
$tests[] = [
'id' => $testType->id,
'name' => $testType->test_name . ' (' . $testType->test_code . ')',
];
}
}
$batchTests[$batch->id] = $tests;
}
@endphp

<script>
    // Inject server-side data safely as JSON
    const batchData = JSON.parse('{!! json_encode($batchTests) !!}');

    document.addEventListener('DOMContentLoaded', function() {
        const batchSelect = document.getElementById('batchSelect');
        const testSelect = document.getElementById('testTypeSelect');
        const container = document.getElementById('testTypeContainer');

        function resetTestSelect() {
            testSelect.innerHTML = '<option value="">-- Select Test --</option>';
            testSelect.disabled = true;
            testSelect.removeAttribute('required');
        }

        resetTestSelect();

        batchSelect.addEventListener('change', function() {
            const batchId = this.value;

            resetTestSelect();

            if (batchId && Array.isArray(batchData[batchId]) && batchData[batchId].length > 0) {
                // populate options
                batchData[batchId].forEach(test => {
                    const opt = document.createElement('option');
                    opt.value = test.id;
                    opt.textContent = test.name;
                    testSelect.appendChild(opt);
                });
                container.classList.remove('d-none');
                testSelect.disabled = false;
                testSelect.setAttribute('required', 'required');
            } else {
                // no tests left for this batch (or no batch selected)
                container.classList.add('d-none');
            }
        });
    });
</script>
@endsection