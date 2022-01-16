<div class="col-md-6 d-flex">
    <div class="card profile-box flex-fill">
        <div class="card-body">
            <h3 class="card-title">Bank information</h3>
            <ul class="personal-info">
                <li>
                    <div class="title">Bank name</div>
                    <div class="text">{{ $details->bank_name }}</div>
                </li>
                <li>
                    <div class="title">Branch Name</div>
                    <div class="text">{{ $details->branch_name }}</div>
                </li>
                <li>
                    <div class="title">Account Number</div>
                    <div class="text">{{ $details->account_number }}</div>
                </li>
                <li>
                    <div class="title">Account Title</div>
                    <div class="text">{{ $details->account_title }}</div>
                </li>
                <li>
                    <div class="title">Updated At</div>
                    <div class="text">{{ $details->updated_at->format('Y-M-d h:m A') }}</div>
                </li>
            </ul>
        </div>
    </div>
</div>
