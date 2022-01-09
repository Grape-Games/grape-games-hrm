<div class="card mb-0">
    <div class="card-body" style="min-height: 170px;">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-view">
                    <div class="profile-img-wrap">
                        <div class="profile-img">
                            <a href="#"><img alt="" src="{{ $user->getFirstMediaUrl('avatars') }}"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                            </a>
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="profile-info-left">
                                    <h3 class="user-name m-t-0 mb-0">{{ $user->name }}</h3>
                                    <h6 class="text-muted">Administration Team</h6>
                                    <small class="text-muted">{{ $user->admin }}</small>
                                    <div class="staff-id">Employee ID : {{ $user->id }}</div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul class="personal-info">
                                    <li>
                                        <div class="title">Email:</div>
                                        <div class="text"><a href="">{{ $user->email }}</a></div>
                                    </li>
                                    <li>
                                        <div class="title">Date of join :</div>
                                        <div class="text">{{ $user->created_at->format('F j, Y, g:i a') }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal"
                            class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- admin profile update modal --}}
<x-admin-profile-information-modal :userModel=$user />
