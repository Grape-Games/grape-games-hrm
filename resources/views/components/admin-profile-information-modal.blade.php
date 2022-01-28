<div id="profile_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profile Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateProfileForm" action="{{ route('dashboard.profile.update', [$user->id]) }}"
                    method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="pf-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-img-wrap edit-img">
                                <img class="inline-block" src="{{ $user->getFirstMediaUrl('avatars') }}"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/img/placeholder.jpg') }}'"
                                    alt="">
                                <div class="fileupload btn">
                                    <span class="btn-text">edit</span>
                                    <input class="upload" type="file" name="file">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $user->name }}"
                                            name="name" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" value="{{ $user->email }}"
                                            name="email" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password<span class="text-danger">*</span></label>
                                        <input id="password" type="password" class="form-control" name="password"
                                            placeholder="Password" data-rule-password="true" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Confirm Password" data-msg="Password must match."
                                            data-rule-password="true" data-rule-equalTo="#password" required>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{ $user->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Profile Modal -->
