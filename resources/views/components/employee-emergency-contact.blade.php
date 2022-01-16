<form id="emergenctContactDetails" action="{{ route('dashboard.employees.update', [$employee->id]) }}" method="POST"
    novalidate>
    @method('PUT')
    <div class="employee-errors-print mb-2 mt-2"></div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="">Name of Person 1</label>
            <input type="text" class="form-control" placeholder="Name of Person 1"
                value="{{ isset($employee->emergency->first_person_name) ? $employee->emergency->first_person_name : '' }}"
                name="first_person_name">
        </div>
        <div class="col-md-4 mb-3">
            <label for="">Contact of Person 1</label>
            <input type="number" class="form-control" placeholder="Emergency Contact Number person 1"
                value="{{ isset($employee->emergency->emergency_contact_1) ? $employee->emergency->emergency_contact_1 : '' }}"
                name="emergency_contact_1">
        </div>
        <div class="col-md-4 mb-3">
            <label for="">Relation with person 1</label>
            <input type="text" class="form-control" placeholder="Relationship with person 1"
                value="{{ isset($employee->emergency->first_person_relationship) ? $employee->emergency->first_person_relationship : '' }}"
                name="first_person_relationship">
        </div>
        <div class="col-md-4 mb-3">
            <label for="">Name of Person 2</label>
            <input type="text" class="form-control" placeholder="Name of Person 2"
                value="{{ isset($employee->emergency->second_person_name) ? $employee->emergency->second_person_name : '' }}"
                name="second_person_name">
        </div>
        <div class="col-md-4 mb-3">
            <label for="">Emergency Contact# 2</label>
            <input type="number" class="form-control" placeholder="Emergency Contact# 2"
                value="{{ isset($employee->emergency->emergency_contact_2) ? $employee->emergency->emergency_contact_2 : '' }}"
                name="emergency_contact_2">
        </div>
        <div class="col-md-4 mb-3">
            <label for="">Relation with person 2</label>
            <input type="text" class="form-control" placeholder="Relationship with person 2"
                value="{{ isset($employee->emergency->second_person_relationship) ? $employee->emergency->second_person_relationship : '' }}"
                name="second_person_relationship">
        </div>
        <input type="hidden" name="type" value="emergency_contact_details">
        <div class="submit-section">
            <button class="btn btn-primary submit-btn">Add/Update Emergency Contact Details</button>
        </div>
    </div>
</form>
