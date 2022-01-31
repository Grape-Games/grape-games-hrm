<div class="payroll-table card">
    <div class="table-responsive">
        <table class="table table-hover table-radius">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Per Day</th>
                    <td>
                        <input class="form-control" type="text" value="Rs:{{ $formula->per_day ?? '0' }}/-" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Per Hour</th>
                    <td>
                        <input class="form-control" type="text" value="Rs:{{ $formula->per_hour ?? '0' }}/-" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Per Minute</th>
                    <td>
                        <input class="form-control" type="text" value="Rs:{{ $formula->per_minute ?? '0' }}/-" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Basic Salary</th>
                    <td>
                        <input class="form-control" type="text" value="Rs:{{ $formula->basic_salary ?? '0' }}/-" readonly>
                    </td>
                </tr>
                <tr>
                    <th>House Allowance</th>
                    <td>
                        <input class="form-control" type="text" value="Rs:{{ $formula->house_allowance ?? '0' }}/-" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Mess Allowance</th>
                    <td>
                        <input class="form-control" type="text" value="Rs:{{ $formula->mess_allowance ?? '0' }}/-" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Travelling Allowance</th>
                    <td>
                        <input class="form-control" type="text" value="Rs:{{ $formula->travelling_allowance ?? '0' }}/-" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Medical Allowance</th>
                    <td>
                        <input class="form-control" type="text" value="Rs:{{ $formula->medical_allowance ?? '0' }}/-" readonly>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
