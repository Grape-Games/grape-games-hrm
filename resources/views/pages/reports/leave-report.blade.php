@extends('layouts.reports.master')
@section('content')
    <x-bread-crumb-component :modal=false />

    <x-dashboard.reports.select />

    @if (Request::has('employee_id') || Request::has('company_id'))
        <x-dashboard.reports.leaves-report :employeeId="request()->get('employee_id')" :companyId="request()->get('company_id')" :date="request()->get('date')" />
    @endif
@endsection
