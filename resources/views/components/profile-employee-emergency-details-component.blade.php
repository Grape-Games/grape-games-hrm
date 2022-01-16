<div class="col-md-6 d-flex">
    <div class="card profile-box flex-fill">
        <div class="card-body">
            <h3 class="card-title">Emergency Contacts
                {{-- <a href="#" class="edit-icon" data-toggle="modal"
                    data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a> --}}
            </h3>
            <h5 class="section-title">Primary</h5>
            <ul class="personal-info">
                <li>
                    <div class="title">Name</div>
                    <div class="text">{{ $details->first_person_name }}</div>
                </li>
                <li>
                    <div class="title">Relationship</div>
                    <div class="text">{{ $details->first_person_relationship }}</div>
                </li>
                <li class="">
                    <div class="title">Phone </div>
                    <div class="text">{{ $details->emergency_contact_1 }}</div>
                </li>
            </ul>
            <hr>
            <h5 class="section-title ">Secondary</h5>
            <ul class="personal-info">
                <li>
                    <div class="title">Name</div>
                    <div class="text">{{ $details->second_person_name }}</div>
                </li>
                <li>
                    <div class="title">Relationship</div>
                    <div class="text">{{ $details->second_person_relationship }}</div>
                </li>
                <li class="">
                    <div class="title">Phone </div>
                    <div class="text">{{ $details->emergency_contact_2 }}</div>
                </li>
            </ul>
        </div>
    </div>
</div>
