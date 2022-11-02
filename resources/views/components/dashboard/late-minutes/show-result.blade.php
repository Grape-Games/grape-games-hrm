<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    <div class="card">
        <div class="card-header">
            Query Result
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped custom-table table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th colspan=4 style="text-align: center">
                                <h3>{{ env('APP_NAME') }}</h3>
                            </th>
                            @foreach ($dates as $date)
                                <th>{{ date('D', strtotime($date)) }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Sr.No</th>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th>Late Minutes/Absents/Presents/HD</th>
                            @foreach ($dates as $date)
                                <th><strong>{{ date('d-M', strtotime($date)) }}</strong></th>   
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data2 as $data)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    @isset($data->first()[0]->employee)
                                        {{ $data->first()[0]->employee->first_name . ' ' . $data->first()[0]->employee->last_name }}
                                    @else
                                        Not Set
                                    @endisset
                                </td>  
                                <td>
                                    @isset($data->first()[0]->employee)
                                        {{ $data->first()[0]->employee->designation->name }}
                                    @else
                                        Not Set
                                    @endisset
                                </td>
                                <td>
                                    @php
                                        $absents = count($dates) - count($data);  
                                    @endphp
                                    {{ $data->lateMinutes . ' / ' . $absents . ' / ' . count($data) . ' / ' . $data->hd }}
                                </td>
                                @foreach ($dates as $date)
                                    <td>
                                        @if (array_key_exists(date('Y-m-d', strtotime($date)), $data->toArray()))
                                            @php
                                                
                                                $da = $data[date('Y-m-d', strtotime($date))];
                                                echo 'Clock In : ' . $da[0]->attendance->format('g:i a') . '<br>' . ' Clock Out : ' . $da[count($da) - 1]->attendance->format('g:i a');
                                                $pt = $da[0]->attendance->diff($da[count($da) - 1]->attendance);
                                                echo '<br> Production Time :  ' . $pt->h . ':' . $pt->i . ' Hrs<br>';
                                                if ($pt->h < 5) {
                                                    echo '<span class="badge bg-warning text-white">Half Day</span>';
                                                } else {
                                                    echo '<span class="badge bg-success text-white">Full Day</span>';
                                                }
                                            @endphp
                                        @else
                                            <span class="badge bg-danger text-white">Absent</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('extended-js')
    <script>
        $(function() {
            makeDTnAjax("table");
        });
    </script>
@endpush
