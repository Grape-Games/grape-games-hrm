<div id="profile_info_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="UpdateEmployeePasswordForm" action="{{ route('dashboard.update-pass', [auth()->id()]) }}"
                    method="POST" novalidate>
                    @csrf
                    <div class="eme-errors-print mb-2"></div>
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New Password<span class="text-danger">*</span></label>
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
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
