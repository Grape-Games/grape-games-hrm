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
                            <th>No of Minutes ( Morning )</th>
                            <th>Minutes Amount Deducted</th>
                            <th>Deduction Compensated</th>
                            <th>Taxable Salary</th>
                            <th>Advance Salary</th>
                            <th>Loan / Installment</th>
                            <th>Arrears</th>
                            <th>Income Tax</th>
                            <th>Net Salary</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $employee)
                            @if (!array_key_exists('notValid', $employee))
                                <tr>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        <input type="hidden" class="getIds"
                                            data-id="{{ $employee['employee']->id }}" />
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['employee']->first_name . ' ' . $employee['employee']->last_name }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['employee']->cnic }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['employee']->designation->name ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->bank->account_number ?? 'Not Set' }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['tempered'] ?? 'Not Set' }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['employee']->salaryFormula->per_hour ?? 'Not Set' }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['employee']->salaryFormula->per_minute ?? 'Not Set' }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        <b
                                            class="gross-salary">{{ $employee['employee']->salaryFormula->basic_salary ?? 'Not Set' }}</b>
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['employee']->salaryFormula->house_allowance ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        {{ $employee['employee']->salaryFormula->mess_allowance ?? 'Not Set' }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['employee']->salaryFormula->travelling_allowance ?? 'Not Set' }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['employee']->salaryFormula->medical_allowance ?? 'Not Set' }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['additional']->eid_allowance ?? 'Not Set' }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['additional']->other_allowance ?? 'Not Set' }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        {{ $employee['employee']->salaryFormula->basic_salary ?? 'Not Set' }}
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        <a data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                            data-id="{{ $employee['employee']->id }}" data-type="Present"
                                            data-url="{{ route('json.getEmployeePresentDays') }}"
                                            class="details">{{ $employee['salariedDays'] }}</a>
                                        <span class="badge badge-success">Sat/Suns
                                            {{ $employee['weekendCounts'] - $employee['additionalDaysCount'] }}</span>
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        <a data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                            data-id="{{ $employee['employee']->id }}" data-type="Leaves"
                                            data-url="{{ route('json.getEmployeeLeavesApproved') }}" class="details">
                                            {{ $employee['leaves'] }}
                                        </a>
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
                                        <p>Note Half days are deducted in taxable salary</p>
                                        <b
                                            class="halfDays{{ $employee['employee']->id }}">{{ $employee['lateMinutesModule']['halfDays'] }}</b>
                                    </td>
                                    <td class="innerHtml{{ $employee['employee']->id }}">
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
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    <a data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                        data-id="{{ $employee['employee']->id }}" data-type="Absent"
                                        data-url="{{ route('json.getEmployeeAbsentDays') }}" class="details">
                                        {{ $employee['absents'] }}
                                    </a>
                                </td>
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    <b class="absent-deductions">{{ $employee['absentDeductions'] }}</b>
                                </td>
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    <a id="oldMinutes{{ $employee['employee']->id }}"
                                        data-still="{{ $employee['lateMinutesModule']['lateMinutesTotal'] }}"
                                        data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                        data-id="{{ $employee['employee']->id }}" data-type="Minutes"
                                        data-url="{{ route('json.getEmployeeLateMinutes') }}"
                                        class="details">{{ $employee['lateMinutesModule']['lateMinutesTotal'] }}
                                    </a>
                                </td>
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    <b id="minuteCompensate{{ $employee['employee']->id }}"
                                        data-old="{{ $employee['lateMinutesModule']['lateMinutesDeductions'] }}"
                                        class="minutes-deductions">{{ $employee['lateMinutesModule']['lateMinutesDeductions'] }}</b>
                                </td>
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    <input id="minutes{{ $employee['employee']->id }}" name="updateVal"
                                        data-id="{{ $employee['employee']->id }}"
                                        data-deduction="{{ $employee['employee']->salaryFormula->per_minute }}"
                                        class="form-control valtoSend{{ $employee['employee']->id }}"
                                        type="number" placeholder="10"
                                        value="{{ isset($employee['extras']) ? $employee['extras']->deduction_compensated : '0' }}">
                                </td>
                                <td>
                                    <b id="upCalculate{{ $employee['employee']->id }}"
                                        data-salary="{{ $employee['calculatedSalary'] - $employee['lateMinutesModule']['lateMinutesDeductions'] }}"
                                        data-value="{{ $employee['lateMinutesModule']['lateMinutesDeductions'] }}"
                                        class="taxable-salary">{{ $employee['calculatedSalary'] }}</b>
                                </td>
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    <input id="advance{{ $employee['employee']->id }}" name="updateVal"
                                        data-id="{{ $employee['employee']->id }}"
                                        class="form-control valtoSend{{ $employee['employee']->id }}"
                                        type="number" placeholder="10"
                                        value="{{ isset($employee['extras']) ? $employee['extras']->advance : '0' }}">
                                </td>
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    <input id="loan{{ $employee['employee']->id }}" name="updateVal"
                                        data-id="{{ $employee['employee']->id }}"
                                        class="form-control valtoSend{{ $employee['employee']->id }}"
                                        type="number" placeholder="10"
                                        value="{{ isset($employee['extras']) ? $employee['extras']->loan : '0' }}">
                                </td>
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    <input id="electricity{{ $employee['employee']->id }}" name="updateVal"
                                        data-id="{{ $employee['employee']->id }}"
                                        class="form-control valtoSend{{ $employee['employee']->id }}"
                                        type="number" placeholder="10"
                                        value="{{ isset($employee['extras']) ? $employee['extras']->electricity : '0' }}">
                                </td>
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    <input id="tax{{ $employee['employee']->id }}" name="updateVal"
                                        data-id="{{ $employee['employee']->id }}"
                                        class="form-control valtoSend{{ $employee['employee']->id }}"
                                        type="number" placeholder="10"
                                        value="{{ isset($employee['extras']) ? $employee['extras']->income_tax : '0' }}">
                                </td>
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    Rs : <b id="final{{ $employee['employee']->id }}"
                                        class="net-salary">{{ round($employee['calculatedSalary']) }}</b>
                                </td>
                                <td class="innerHtml{{ $employee['employee']->id }}">
                                    <button id="saveSal{{ $employee['employee']->id }}" type="button"
                                        data-id="{{ $employee['employee']->id }}"
                                        class="btn btn-primary saveEmployee">
                                        Save Salary
                                    </button>
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
                                <td></td>
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

    function updateSalary(empId) {

        var oldSalary = $("#upCalculate" + empId).data('salary');
        var updateEmpSalarySelector = $("#upCalculate" + empId);
        var oldMinutesSelector = $("#oldMinutes" + empId);
        var minuteCompensated = $("#minuteCompensate" + empId);
        var final = $("#final" + empId);

        var minutesSelector = $("#minutes" + empId);
        var advanceSelector = $("#advance" + empId);
        var loanSelector = $("#loan" + empId);
        var electricitySelector = $("#electricity" + empId);
        var taxSelector = $("#tax" + empId);

        var minutesDeductions = minutesSelector.val() * minutesSelector.data('deduction');

        var advanceDeductions = advanceSelector.val();
        var loanDeductions = loanSelector.val();
        var electricityDeductions = electricitySelector.val();
        var taxDeductions = taxSelector.val();

        oldMinutesSelector.html(oldMinutesSelector.data('still') - minutesSelector.val());
        minuteCompensated.html(minuteCompensated.data('old') - minutesDeductions)

        var calculation = minuteCompensated.data('old') + oldSalary + minutesDeductions - advanceDeductions -
            loanDeductions -
            electricityDeductions - taxDeductions;

        updateEmpSalarySelector.html(calculation);

        final.html(calculation)

    }

    $('[name="updateVal"]').keyup(function(e) {
        var empId = $(this).data('id');
        updateSalary(empId);
        reCal();
    });

    $(function() {
        $('.getIds').each(function() {
            updateSalary($(this).data('id'));
            reCal();
        });

        makeDTnAjaxCols("main-table", "A2", [0, 1, 3, 4, 8, 15, 20, 21, 22, 23, 24, 25, 26, 28, 29, 30]);


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

    $('body').on('click', 'tbody .saveEmployee', function() {

        var sendData = [];
        var url = "/save/saveEmployeeSlip";
        $('.innerHtml' + $(this).data('id')).each(function() {
            sendData.push(($(this).html()).replace(/<\/?[^>]+(>|$)/g, "").match(/\d+([\.]\d+)?/g));
        });

        $('.valtoSend' + $(this).data('id')).each(function() {
            sendData.push($(this).val() == "" ? "0" : $(this).val());
        })

        sendData.push($(".halfDays" + $(this).data('id')).html());

        $.ajax({
            type: "POST",
            url: url,
            data: {
                data: sendData,
                id: $(this).data('id'),
                date: "{{ request()->get('date') }}"
            },
            success: function(response) {
                console.log("success", response);

                makeToastr('success', response.response,
                    'Successful');
            },
            error: function(response) {
                console.log(response);
                makeToastr('error', response.responseJSON.message,
                    'Network error occured');
            }
        });
    });
</script>
@endpush
