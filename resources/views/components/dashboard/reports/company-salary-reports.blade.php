<style>
    input {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: groove;
        background-color: #eee;
        width: 150px;
      }
    
</style>
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
                            <th>Bank Acc#</th>
                            <th>Designation</th>
                            <th>Basic Salary</th>
                            <th>Absents</th>
                            <th>Absents amount Deduction</th>
                            <th>No of Half Days</th>  
                            <th>Half Days Deduction</th>
                            <th>Late Minutes</th>
                            <th>Late Minutes Deduction</th>
                            <th>Sand Wich Rule Deduction</th>
                            <th>Other Deduction</th>
                            <th>Tax Deduction</th>
                            <th>Loan</th>
                            <th>Total Increment</th>
                            <th>Total Salary</th>
                            <th>Deduction befor Compensation</th>
                            <th>Bouns</th>
                            <th>Compensation</th>
                            <th>Deduction after Compensation</th>
                            <th>Total Salary approved</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $key=> $employee)
                            @if (!array_key_exists('notValid', $employee))
                                <tr>
                                    <td>
                                        {{ $loop->iteration }} 
                                    </td>
                                    <th class="emp_name">
                                       {{ $employee['employee']->first_name . ' ' . $employee['employee']->last_name }}
                                      
                                    </th>
                                    <th class="emp_account">
                                       {{ $employee['employee']->bank->account_number ?? 'Not Set' }}
                                    </th>
                                    <th class="emp_designation">
                                    {{ $employee['employee']->designation->name ?? 'Not Set' }}
                                    </th>
                                    <th class="emp_basicSalary">
                                              {{ $employee['employee']->salaryFormula->basic_salary ?? 'Not Set' }}
                                    </th>
                                    <th class="absents">
                                        <a data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                        data-id="{{ $employee['employee']->id }}" data-type="Absent"
                                        data-url="{{ route('json.getEmployeeAbsentDays') }}"
                                        class="details">
                                         @if ($employee['absents'] > 0)
                                           {{ $employee['absents'] }}
                                         @else
                                           0
                                         @endif
                                      </a>
                                    </th>
                                    <th class="absentDeductions ">
                                         @if ($employee['absentDeductions'] > 0)
                                           {{$employee['absentDeductions']}}
                                         @else
                                           0
                                         @endif 
                                    </th>
                                    <th class="totalHalfDays">
                                         <a data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                        data-id="{{ $employee['employee']->id }}" data-type="HalfDaysDetails"
                                        data-url="{{ route('json.getEmployeeAbsentDays') }}"
                                        class="details">
                                        {{ $employee['totalHalfDays'] }}
                                      </a>
                                       
                                    </th>
                                   
                                    <th class="halfDaysDeductions deduct">
                                        {{$employee['halfDaysDeductions']}}
                                    </th>
                                   <td class="innerHtml{{ $employee['employee']->id }} total_lateMinutes">
                                        <a id="oldMinutes{{ $employee['employee']->id }}"
                                            data-still="{{ $employee['lateMinutesModule']   ['lateMinutesTotal'] }}"
                                            data-target="#detailsModal" data-toggle="modal"     href="#detailsModal"
                                            data-id="{{ $employee['employee']->id }}" data-type="Minutes"
                                            data-url="{{ route('json.getEmployeeLateMinutes') }}"
                                            class="details">{{ $employee['lateMinutesModule']   ['lateMinutesTotal'] }}
                                        </a>
                                    </td>
                                    <th class="lateMinutesDeductions "> 
                                            {{$employee['lateMinutesModule']  ['lateMinutesDeductions'] }}
                                    </th>
                                    <th class="snadWhichRuleDeductions "> 
                                        <a data-target="#detailsModal" data-toggle="modal" href="#detailsModal"
                                        data-id="{{ $employee['employee']->id }}" data-type="snadWhichRule"
                                        data-url="{{ route('json.getEmployeeAbsentDays') }}"
                                        class="details"> {{(int)$employee['snadWhichRuleDeductions']}} </a>
                                    </th>
                                    <th class="otherDeduction">
                                              {{$employee['deduction']}}
                                    </th>
                                    <th><input  type="number" value="{{$employee['empsalarySlip']['tax_deduction'] ?? 0}}" name="taxDeduction"></th>
                                    <th class="loan">
                                           {{$employee['loan']}}
                                    </th>
                                     <th class="emp_totalIncrement">
                                              {{ $employee['increment'] ?? 'Not Set' }}
                                    </th>
                                     <th class="emp_totalSalary">
                                              {{ $employee['employee']->salaryFormula->basic_salary + $employee['increment'] ?? 'Not Set' }}
                                    </th>
                                    <th class="DeductionBeforComp">
                                          {{$employee['empsalarySlip']['deduction_before_compensation'] ?? $employee['totalDeductions']}}   
                                   </th>  
                                    <th class="bouns">
                                       {{$employee['bouns']}}
                                    </th>
                                    <th>
                                        <input type="text" name="compensation" value="{{$employee['empsalarySlip']['compensation'] ?? 0}}" >
                                    </th>  
                                    <th class="DeductionafterComp">
                                             {{$employee['empsalarySlip']['deduction_after_compensation'] ?? $employee['totalDeductions']}}
                                    <th class="totalSalaryApprove">
                                        @if(isset($employee['empsalarySlip']['tax_deduction']))
                                            {{$employee['calculatedSalary']+$employee['empsalarySlip']['compensation']-$employee['empsalarySlip']['tax_deduction']}}
                                        @else
                                           {{$employee['calculatedSalary']}}
                                        @endif
                                    </th>  
                                   <td class="innerHtml{{ $employee['employee']->id }}">
                                        <button id="saveSal{{ $employee['employee']->id }}" type="button"
                                            data-id="{{ $employee['employee']->id }}"
                                            class="btn btn-primary saveEmployee">
                                             Save Salary
                                        </button>
                                   </td>
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
        reCal();
        makeDTnAjaxCols("main-table", "A2", [0,1,3,4,8,15,20,21,22,23,24,25,26,28,29,30]);


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
                    // console.log("success", response);

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
                       console.log(response.response);
                        $.each(response.response.dates, function(indexInArray,
                            valueOfElement) {
                           
                                
                                    html += '<tr><td scope="row">' + counter + '</td><td>' +
                                   "Absent" + '</td><td>' +
                                   valueOfElement +
                                   '</td></tr>';
                              

                            counter++;
                        });
                        
                    } else if(type=='snadWhichRule'){
                        console.log(response.response);
                         $.each(response.response.sendWhichRule, function(indexInArray,
                            valueOfElement) {     
                                    html += '<tr><td scope="row">' + counter + '</td><td>' +
                                   "Apply Sand Which Rule" + '</td><td>' +
                                   valueOfElement +
                                   '</td></tr>';
                              

                            counter++;
                        });

                    } else if (type =="HalfDaysDetails"){
                         console.log(response.response.halfDaysDetails);
                           $.each(response.response.halfDaysDetails, function(indexInArray,
                            valueOfElement) {
                                  
                                    html += '<tr><td scope="row">' + counter + '</td><td>' +
                                   "Working Hours Less than 4 hours" + '</td><td>' +
                                   valueOfElement[0].custom_date+
                                   '</td></tr>';
                              

                            counter++;
                        });
                    }
                     else if (type == "Leaves") {
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
    });

 $("table").on("paste keyup", "input[name='taxDeduction']", function() {
      var row = $(this).closest("tr");
       if($(this).val()=='' || row.find("input[name='compensation']").val()==''){
           row.find(".saveEmployee").prop('disabled', true);
        }else{
            row.find(".saveEmployee").prop('disabled', false);
        }
      var taxDeduction = parseFloat(row.find("input[name='taxDeduction']").val());
      var absentDeductions = parseFloat(row.find(".absentDeductions").text());
      var halfDaysDeductions = parseFloat(row.find(".halfDaysDeductions").text());
      var lateMinutesDeductions = parseInt(row.find(".lateMinutesDeductions").text());
      var snadWhichRuleDeductions = parseFloat(row.find(".snadWhichRuleDeductions").text());
      var otherDeduction = parseFloat(row.find(".otherDeduction").text());
     
      var compensation = parseFloat(row.find("input[name='compensation']").val());
   
     var totalDeductions = taxDeduction+absentDeductions+halfDaysDeductions+lateMinutesDeductions+snadWhichRuleDeductions+otherDeduction;

     var totalDeductionsafterComp = totalDeductions-compensation;
     var bouns = parseFloat(row.find(".bouns").text());
     var loan = parseFloat(row.find(".loan").text());

     var totalSalary = parseFloat(row.find(".emp_totalSalary").text());
     var totalSalaryApprove = (totalSalary+bouns)-(totalDeductionsafterComp+loan);
       row.find(".DeductionBeforComp").text(isNaN(totalDeductions) ? "" : totalDeductions);
       row.find(".DeductionafterComp").text(isNaN(totalDeductionsafterComp) ? "" : totalDeductionsafterComp);
       row.find(".totalSalaryApprove").text(isNaN(totalSalaryApprove) ? "" : totalSalaryApprove);
    });
    $("table").on("paste keyup", "input[name='compensation']", function() {
        var row = $(this).closest("tr");
        if($(this).val()=='' || row.find("input[name='taxDeduction']").val()==''){
           row.find(".saveEmployee").prop('disabled', true);
        }else{
            row.find(".saveEmployee").prop('disabled', false);
        }
        
        var compensation = parseFloat(row.find("input[name='compensation']").val());
        var DeductionBeforComp = parseFloat(row.find(".DeductionBeforComp").text());
        var DeductionAfterComp = DeductionBeforComp-compensation;
        row.find(".DeductionafterComp").text(isNaN(DeductionAfterComp) ? "" : DeductionAfterComp);
        var totalSalary = parseFloat(row.find(".emp_totalSalary").text());
        var bouns = parseFloat(row.find(".bouns").text());
        var loan = parseFloat(row.find(".loan").text());
        var totalSalaryApprove = (totalSalary+bouns)-(DeductionAfterComp+loan);
        row.find(".totalSalaryApprove").text(isNaN(totalSalaryApprove) ? "" : totalSalaryApprove);

    });
    $(".saveEmployee").click(function(){
        var url = "/save/saveEmployeeSlip";
        var $row = $(this).closest("tr");
        $.ajax({
            type: "POST",
            url: url, 
            data: {
            'id':$(this).data('id'),
            'emp_name':$row.find(".emp_name").text(),
            'emp_account':$row.find(".emp_account").text(),
            'emp_designation':$row.find(".emp_designation").text(),
            'emp_basicSalary':$row.find(".emp_basicSalary").text(),
            'emp_totalIncrement':$row.find(".emp_totalIncrement").text(),
            'emp_totalSalary':$row.find(".emp_totalSalary").text(),
            'absents':$row.find(".absents").text(),
            'absentDeductions':$row.find(".absentDeductions").text(),
            'totalHalfDays':$row.find(".totalHalfDays").text(),
            'halfDaysDeductions':$row.find(".halfDaysDeductions").text(),
            'total_lateMinutes':$row.find(".total_lateMinutes").text(),
            'lateMinutesDeductions':$row.find(".lateMinutesDeductions").text(),
            'snadWhichRuleDeductions':$row.find(".snadWhichRuleDeductions").text(),
            'otherDeduction':$row.find(".otherDeduction").text(),
            'loan':$row.find(".loan").text(),
            'taxDeduction':$row.find("input[name='taxDeduction']").val(),
            'compensation':$row.find("input[name='compensation']").val(),
            'DeductionBeforComp':$row.find(".DeductionBeforComp").text(),
            'bouns':$row.find(".bouns").text(),
            'DeductionafterComp':$row.find(".DeductionafterComp").text(),
            'totalSalaryApprove':$row.find(".totalSalaryApprove").text(),
            'monthYear':"{{ request()->get('date') }}",
        },
            beforeSend: function() {
                $row.find(".saveEmployee").attr('disabled', true);
            },
            success: function(response) {
                console.log("success", response);

                makeToastr('success', response.response,
                    'Successful');
            },
            error: function(response) {
                console.log(response);
                $row.find(".saveEmployee").attr('disabled', false);
                makeToastr('error', response.responseJSON.message,
                    'Network error occured');
            },
            complete: function(response) {
                $row.find(".saveEmployee").attr('disabled', false);
            },
        });
       
    });

</script>
@endpush  
  