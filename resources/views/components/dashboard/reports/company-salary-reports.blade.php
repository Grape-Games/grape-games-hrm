<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    <div class="card">
        <div class="card-header">
            Query Result
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="main-table table mb-0 table-striped custom-table table-nowrap">
                    <thead>
                        <tr>
                            <th colspan=12 style="text-align: center">
                                <h3>{{ env('APP_NAME') }}</h3>
                                Month of {{ date('M Y', strtotime($dates[0])) }} has
                                <br>
                                {{ $satSuns['saturdays'] . ' Saturdays and ' . $satSuns['sundays'] . ' Sundays' }}
                                <br>
                                <span class="text-white badge bg-success">Note : Saturdays and Sundays are paid</span>
                            </th>
                        </tr>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>CNIC</th>
                            <th>Designation</th>
                            <th>Bank Acc#</th>
                            <th>Per Day</th>
                            <th>Per Hour</th>
                            <th>Per Minute</th>
                            <th>Basic Salary</th>
                            <th>House Allowance</th>
                            <th>Mess/Food Allowance</th>
                            <th>Travelling Allowance</th>
                            <th>Medical Allowance</th>
                            <th>Eid Allowance</th>
                            <th>Other Allowances</th>
                            <th>Gross Salary</th>
                            <th>Salaried Days</th>
                            <th>Leaves Approved</th>
                            <th>Half Days</th>
                            <th>Half Days Details</th>
                            <th>No of Days ( Deduction )</th>
                            <th>Days Amount Deducted</th>
                            <th>No of Minutes ( Morning + Evening )</th>
                            <th>Minutes Amount Deducted</th>
                            <th>Deduction Compensated</th>
                            <th>Taxable Salary</th>
                            <th>Advance Salary</th>
                            <th>Loan / Installment</th>
                            <th>Electricity</th>
                            <th>Income Tax</th>
                            <th>Net Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $employee)
                            @if (!array_key_exists('notValid', $employee))
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->first_name . ' ' . $employee['employee']->last_name }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->cnic }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->designation->name ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->bank->account_number ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['tempered'] ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->salaryFormula->per_hour ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->salaryFormula->per_minute ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        <b
                                            class="gross-salary">{{ $employee['employee']->salaryFormula->basic_salary ?? 'Not Set' }}</b>
                                    </td>
                                    <td>
                                        {{ $employee['employee']->salaryFormula->house_allowance ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->salaryFormula->mess_allowance ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->salaryFormula->travelling_allowance ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->salaryFormula->medical_allowance ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['additional']->eid_allowance ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['additional']->other_allowance ?? 'Not Set' }}
                                    </td>
                                    <td>{{ $employee['employee']->salaryFormula->basic_salary ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        <a data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                            data-id="{{ $employee['employee']->id }}" data-type="Present"
                                            data-url="{{ route('json.getEmployeePresentDays') }}"
                                            class="details">{{ $employee['salariedDays'] }}</a>
                                        <span class="badge badge-success">Sat/Suns
                                            {{ $employee['weekendCounts'] - $employee['additionalDaysCount'] }}</span>
                                    </td>
                                    <td>
                                        <a data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                            data-id="{{ $employee['employee']->id }}" data-type="Leaves"
                                            data-url="{{ route('json.getEmployeeLeavesApproved') }}"
                                            class="details">
                                            {{ $employee['leaves'] }}
                                        </a>
                                    </td>
                                    <td>
                                        <p>Note Half days are deducted in taxable salary</p>
                                        {{ $employee['lateMinutesModule']['halfDays'] }}
                                    </td>
                                    <td>
                                        @foreach ($employee['lateMinutesModule']['halfDaysDetails'] as $punches)
                                            @if (count($punches) <= 1)
                                                <b class="text-dager">Punch Missing</b>
                                            @else
                                                <b>Working Hours Less than 4 hours</b>
                                            @endif
                                            @foreach ($punches as $punch)
                                                <p>Punch : {{ $punch->custom_date }}</p>
                                            @break;
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    <a data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                        data-id="{{ $employee['employee']->id }}" data-type="Absent"
                                        data-url="{{ route('json.getEmployeeAbsentDays') }}"
                                        class="details">
                                        {{ $employee['absents'] }}
                                    </a>
                                </td>
                                <td>
                                    <b class="absent-deductions">{{ $employee['absentDeductions'] }}</b>
                                </td>
                                <td>
                                    {{ $employee['lateMinutesModule']['lateMinutesMorningCounter'] .
                                        ' + ' .
                                        $employee['lateMinutesModule']['lateMinutesEveningCounter'] .
                                        ' = ' }}
                                    <a id="oldMinutes{{ $employee['employee']->id }}"
                                        data-still="{{ $employee['lateMinutesModule']['lateMinutesTotal'] }}"
                                        data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                        data-id="{{ $employee['employee']->id }}" data-type="Minutes"
                                        data-url="{{ route('json.getEmployeeLateMinutes') }}"
                                        class="details">{{ $employee['lateMinutesModule']['lateMinutesTotal'] }}
                                    </a>
                                </td>
                                <td>
                                    <b id="minuteCompensate{{ $employee['employee']->id }}"
                                        class="minutes-deductions">{{ $employee['lateMinutesModule']['lateMinutesDeductions'] }}</b>
                                </td>
                                <td>
                                    <input name="compensate" data-id="{{ $employee['employee']->id }}"
                                        data-deduction="{{ $employee['employee']->salaryFormula->per_minute }}"
                                        class="form-control" type="number" placeholder="10">
                                </td>
                                <td>
                                    <b id="upCalculate{{ $employee['employee']->id }}"
                                        data-salary="{{ $employee['calculatedSalary'] - $employee['lateMinutesModule']['lateMinutesDeductions'] }}"
                                        class="taxable-salary">{{ $employee['calculatedSalary'] }}</b>
                                </td>
                                <td>
                                    {{ $employee['additional']->advance_salary ?? 'Not Set' }}
                                </td>
                                <td>
                                    NULL
                                </td>
                                <td>
                                    {{ $employee['additional']->electricity ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['additional']->income_tax ?? 'Not Set' }}
                                </td>
                                <td>
                                    In points : {{ $employee['calculatedSalary'] }}
                                    <br>
                                    Rounded off : <b
                                        class="net-salary">{{ round($employee['calculatedSalary']) }}</b>
                                </td>
                            </tr>
                        @endif
                        @if ($loop->last)
                            <tr>
                                <td>{{ $loop->iteration + 1 }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Gross Total : <b class="grossResult"></b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Attendance Deductions : <b class="absentResult"></b></td>
                                <td></td>
                                <td>Late Minutes Deductions : <b class="lateResult"></b></td>
                                <td></td>
                                <td>Taxable Salary Total : <b class="taxableResult"></b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total here : <b class="totalResult"></b></td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

{{-- modal here --}}

<div id="detailsModal" class="modal custom-modal fade" role="dialog">
<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Details of User Name</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table another-table">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Type</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="appendHere"></tbody>
            </table>
        </div>
    </div>
</div>
</div>

@push('extended-js')
<script>
    function reCal() {
        var grossSalary = 0;
        var absentDeductions = 0;
        var minutesDeductions = 0;
        var taxableSalary = 0;
        var netSalary = 0;

        $('.gross-salary').each(function() {
            grossSalary += parseFloat($(this).html()); // Or this.innerHTML, this.innerText
        });

        $('.absent-deductions').each(function() {
            absentDeductions += parseFloat($(this).html()); // Or this.innerHTML, this.innerText
        });

        $('.minutes-deductions').each(function() {
            minutesDeductions += parseFloat($(this).html()); // Or this.innerHTML, this.innerText
        });

        $('.taxable-salary').each(function() {
            taxableSalary += parseFloat($(this).html()); // Or this.innerHTML, this.innerText
        });

        $('.net-salary').each(function() {
            netSalary += parseFloat($(this).html()); // Or this.innerHTML, this.innerText
        });

        $(".grossResult").html(grossSalary);
        $(".absentResult").html(absentDeductions);
        $(".lateResult").html(minutesDeductions);
        $(".taxableResult").html(taxableSalary);
        $(".totalResult").html(netSalary);

    }

    $('[name="compensate"]').keyup(function(e) {

        var empId = $(this).data('id');
        var amount = $(this).data('deduction');
        var oldMinutesSelector = $("#oldMinutes" + empId);
        var updateEmpSalarySelector = $("#upCalculate" + empId);
        var oldSelectorResult = $("#minuteCompensate" + empId);

        newMinutes = oldMinutesSelector.data('still') - $(this).val();

        if (newMinutes <= 0)
            newMinutes = 0;

        oldMinutesSelector.html(newMinutes);

        var oldStaticSalary = updateEmpSalarySelector.data('salary');

        oldSelectorResult.html(newMinutes * amount);

        updateEmpSalarySelector.html(oldStaticSalary + (newMinutes * amount));

        reCal();
    });
    $(function() {
        reCal();
        makeDTnAjax("main-table", "A0");


        var date = "{{ request()->get('date') }}";

        $(".details").click(function(e) {
            e.preventDefault();

            var type = $(this).data('type');
            var url = $(this).data('url');


            $.ajax({
                type: "GET",
                url: url,
                data: {
                    employeeId: $(this).data('id'),
                    date: date
                },
                success: function(response) {
                    console.log("success", response);

                    var html = "";
                    var counter = 1;
                    $("#appendHere").html("");

                    if (type == "Present") {
                        $.each(response.response.presents, function(indexInArray,
                            valueOfElement) {

                            html += '<tr><td scope="row">' + counter + '</td><td>' +
                                "Present" + '</td><td>' + valueOfElement[0]
                                .custom_date +
                                '</td></tr>';

                            counter++;
                        });

                        $.each(response.response.holidays, function(indexInArray,
                            valueOfElement) {

                            html += '<tr><td scope="row">' + counter + '</td><td>' +
                                "Holiday" + '</td><td>' + valueOfElement
                                .custom_date +
                                '</td></tr>';

                            counter++;
                        });

                        $.each(response.response.leaves, function(indexInArray,
                            valueOfElement) {

                            html += '<tr><td scope="row">' + counter + '</td><td>' +
                                "Leave" + '</td><td>From : ' + valueOfElement
                                .from_date + ' To : ' + valueOfElement.to_date +
                                '</td></tr>';

                            counter++;
                        });

                        $.each(response.response.additional, function(indexInArray,
                            valueOfElement) {

                            html += '<tr><td scope="row">' + counter + '</td><td>' +
                                "Additional Working Day" + '</td><td>' +
                                valueOfElement
                                .custom_date +
                                '</td></tr>';

                            counter++;
                        });


                    } else if (type == "Absent") {
                        $.each(response.response, function(indexInArray,
                            valueOfElement) {

                            html += '<tr><td scope="row">' + counter + '</td><td>' +
                                "Absent" + '</td><td>' +
                                valueOfElement +
                                '</td></tr>';

                            counter++;
                        });
                    } else if (type == "Leaves") {
                        $.each(response.response, function(indexInArray,
                            valueOfElement) {
                            html += '<tr><td scope="row">' + counter + '</td><td>' +
                                "Leave" + '</td><td>From : ' +
                                valueOfElement[0] + ' To : ' + valueOfElement[
                                    valueOfElement.length - 1]
                            '</td></tr>';
                            counter++;
                        });
                    } else if (type == "Minutes") {

                        $.each(response.response.lateMinutesMorning, function(indexInArray,
                            valueOfElement) {
                            html += '<tr><td scope="row">' + counter + '</td><td>' +
                                "Clock In" + '</td><td>' + valueOfElement
                                .date_second + ', Late Minutes : ' + valueOfElement
                                .minutes + '</td></tr>';
                            counter++;
                        });
                        $.each(response.response.lateMinutesEvening, function(indexInArray,
                            valueOfElement) {
                            html += '<tr><td scope="row">' + counter + '</td><td>' +
                                "Clock Out" + '</td><td>' + valueOfElement
                                .date_second + ', Late Minutes : ' + valueOfElement
                                .minutes + '</td></tr>';
                            counter++;
                        });
                    }
                    $("#appendHere").html(html);
                    makeDTnAjax("another-table", "A5");

                },
                error: function(response) {
                    console.log('error');
                    console.log(response);
                    makeToastr('error', response.responseJSON.message,
                        'Network error occured');

                }
            });
        });
    });

    $('#detailsModal').on('hidden.bs.modal', function() {
        // do something…
        $('.another-table').DataTable().clear().destroy();
    })
</script>
@endpush
