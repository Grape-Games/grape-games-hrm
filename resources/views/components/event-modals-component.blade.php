<!-- Add Event Modal -->
<div id="add_event" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEventForm" action="{{ route('dashboard.events.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="ev-errors-print mb-2"></div>
                    <div class="form-group">
                        <label>Event Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" placeholder="Event Name" required>
                    </div>
                    <div class="form-group">
                        <label>Event Start Date/Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" name="start_time" required>
                    </div>
                    <div class="form-group">
                        <label>Event End Date/Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" name="end_time" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Category/Color On Calendar</label>
                        <select class="form-control" name="category" required>
                            <option style="background-color: #f62d51;color: white;">Danger</option>
                            <option style="background-color: #55ce63;color: white;">Success</option>
                            <option style="background-color: #7460ee;color: white;">Purple</option>
                            <option style="background-color: #f43b48;color: white;">Primary</option>
                            <option style="background-color: #009efb;color: white;">Info</option>
                            <option style="background-color: #3a87ad;color: white;">Inverse</option>
                            <option style="background-color: #ffbc34;color: white;">Warning</option>
                        </select>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Event Modal -->

<!-- Event Modal -->
<div class="modal custom-modal fade" id="event-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer text-center">
                <button type="submit" class="btn btn-success submit-btn save-event">Create event</button>
                <button type="submit" class="btn btn-danger submit-btn delete-event"
                    data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- /Event Modal -->
