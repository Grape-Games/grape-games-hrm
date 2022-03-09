<div class="col-md-6 d-flex">
    <div class="card profile-box flex-fill">
        <div class="card-body">
            <h3 class="card-title">Personal Information
                {{-- <a href="#" class="edit-icon" data-toggle="modal"
                    data-target="#personal_info_modal"><i class="fa fa-pencil"></i> --}}
                </a></h3>
            <ul class="personal-info">
                <li>
                    <div class="title">Address</div>
                    <div class="text">{{ $details->address }}</div>
                </li>
                <li>
                    <div class="title">Blood Group</div>
                    <div class="text">{{ $details->blood_group }}</div>
                </li>
                <li>
                    <div class="title">Date of Birth</div>
                    <div class="text"><a
                            href="#">{{ \Carbon\Carbon::parse($details->dob)->format('d-M-Y') }}</a>
                    </div>
                </li>
                <li>
                    <div class="title">Join Date</div>
                    <div class="text">{{ $details->join_date }}</div>
                </li>
                <li>
                    <div class="title">Referred By</div>
                    <div class="text">{{ $details->referred_by }}</div>
                </li>
                <li>
                    <div class="title">Job Description</div>
                    <div class="text">{{ $details->job_description }}</div>
                </li>
                <li>
                    <div class="title">Resignation Date</div>
                    <div class="text">{{ $details->resignation_date }}</div>
                </li>
                <li>
                    <div class="title">Certificate Name</div>
                    <div class="text">{{ $details->certificate_name }}</div>
                </li>
            </ul>
        </div>
    </div>
</div>
