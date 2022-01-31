@extends('layouts.master')

@push('extended-css')

    @include('vendors.date-time-picker')
    @include('vendors.select2')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false modalType="" modalId="" />

    <x-view-employee-attendance />

    @if (Request::has(['month', 'year']))

        <div class="row mb-4 mt-lg-4">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date </th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                                <th>Production</th>
                                <th>Break</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($result as $key => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($key)->format('l jS \of F Y') }}</td>
                                    <td>{{ $item[count($item) - 1]->attendance }}</td>
                                    <td>{{ isset($item[0]) ? $item[0]->attendance : 'Not found' }}</td>
                                    <td>{{ App\Http\Controllers\EmployeeAttendanceaController::convertToHoursMins(\Carbon\Carbon::parse($item[0]->attendance)->diffInMinutes(\Carbon\Carbon::parse($item[count($item) - 1]->attendance))) ?? '0' }}
                                        hrs
                                    </td>
                                    <td>1 hrs</td>
                                </tr>
                            @empty
                                <td colspan="6" class="text-center">No data available</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endif

@endsection

@push('extended-js')
@endpush
