<h3 id="incomplete-flash" class="badge badge-danger text-center bx-flashing d-none">You profile is not completed,
    kindly let {{ $user->owner->name }} know.</h3>
<div class="card mb-0">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-view">
                    <div class="profile-img-wrap">
                        <div class="profile-img">
                            <a href="#">
                                <img alt="" src="{{ $user->getFirstMediaUrl('avatars') }}"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                            </a>
                        </div>
                    </div>
                    <div class="profile-basic">
                        @if ($user !== null)
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{ $user->name }}</h3>
                                        <h6 class="text-muted">{{ $user->company->name }} Team</h6>
                                        <small class="text-muted">{{ $user->designation->name }}</small>
                                        <div class="staff-id">Employee ID : {{ $user->registration_no }}
                                        </div>
                                        <div class="small doj text-muted">Date of Join :
                                            {{ $user->created_at->format('F j, Y, g:i a') }}</div>
                                        {{-- <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send
                                                Message</a></div> --}}
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Phone:</div>
                                            <div class="text"><a href="#">{{ $user->primary_contact }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Email:</div>
                                            <div class="text"><a href="#">{{ $user->user->email }}</a>
                                                <br>
                                                <small class="text-danger">Note : This is the
                                                    email you will login with.</small>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="title">CNIC:</div>
                                            <div class="text">{{ $user->cnic }}</div>
                                        </li>
                                        <li>
                                            <div class="title">City:</div>
                                            <div class="text">{{ $user->city }}
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Gender:</div>
                                            <div class="text" style="text-transform: capitalize">
                                                {{ $user->gender }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Reports to:</div>
                                            <div class="text">
                                                <div class="avatar-box">
                                                    <div class="avatar avatar-xs">
                                                        <img src="{{ $user->owner->getFirstMediaUrl('avatars') }}">
                                                    </div>
                                                </div>
                                                <a href="#">
                                                    {{ $user->owner->name }}
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    @if ($user->additional !== null)
        <x-profile-employee-additional-details-component />
    @elseif ($user->emergency !== null)
        <x-profile-employee-emergency-details-component />
    @elseif ($user->bank)
        <x-profile-employee-bank-details-component />
    @else
        @push('extended-js')
            <script>
                $(function() {
                    $(".bx-flashing").removeClass('d-none');
                });
            </script>
        @endpush
    @endif
</div>
