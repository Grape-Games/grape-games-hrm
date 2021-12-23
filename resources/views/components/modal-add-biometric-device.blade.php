<!-- Add Biometric Device Modal -->
<div id="add_biometric_device" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Biometric Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addBiometricDeviceForm" action="{{ route('dashboard.biometric-devices.store') }}"
                    method="POST" novalidate>
                    @csrf
                    <div class="bd-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Device Name" name="name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Global IP address <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="198.168.0.1" name="ip_address"
                                    required>
                                <small class="text-muted">e.g : 129.24.222.20</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Internal ID</label>
                                <input class="form-control" type="text" placeholder="Internal ID" name="internal_id">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea rows="5" class="form-control" type="text" placeholder="Some Description"
                                    name="description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Biometric Device</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Biometric Device Modal -->
