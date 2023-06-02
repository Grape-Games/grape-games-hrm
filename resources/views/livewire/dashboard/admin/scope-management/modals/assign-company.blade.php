<div>
    {{-- The Master doesn't talk, he acts. --}}
    @push('extended-js')
        @include('vendors.select2')
    @endpush
    <!-- Add leave Type Modal -->
    <div wire:ignore.self id="assign_company" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Company<span class="text-danger">*</span></label>
                                    <div class="form-group form-focus">
                                        <select wire:model.lazy='company_id' id="company_id"
                                            class="select select2 floating @error('company_id') is-invalid @enderror">
                                            <option value="">Select A company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('company_id')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Name<span class="text-danger">*</span></label>
                                    <div class="form-group form-focus">
                                        <select wire:model.lazy='user_id' id="user_id"
                                            class="select select2 floating @error('user_id') is-invalid @enderror">
                                            <option value="">Select A User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button wire:click.prevent="store" wire:loading.attr="disabled" type="submit"
                                class="btn btn-lg btn-primary submit-btn">
                                <span wire:loading.remove wire:target="store">Assign Now</span>
                                <span class="d-none" wire:loading.class.remove="d-none"
                                    wire:target="store">Assigning Please wait...
                                    <span class="spinner-border spinner-border-sm btn-spinner ml-2 mr-2" role="status"
                                        aria-hidden="true">
                                    </span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('extended-js')
    <script>
        $(function() {
            $('.select2').select2({
                placeholder: "Select a state",
                allowClear: true
            });
            $('#company_id').on('change', function(e) {
                var data = $('#company_id').select2("val");
                @this.set('company_id', data);
            });
            $('#user_id').on('change', function(e) {
                var data = $('#user_id').select2("val");
                @this.set('user_id', data);
            });
        });
    </script>
@endpush
