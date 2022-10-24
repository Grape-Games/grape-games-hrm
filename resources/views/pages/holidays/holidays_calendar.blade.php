@extends('layouts.master')

@push('extended-js')
    <script>
       
        var defaultEvents = [];
        // var events = @json($holiday);
        var birthdays = @json($holiday);
        console.log(birthdays);
        $.each(birthdays, function(indexInArray, valueOfElement) {
            let obj = {};
            obj.title = valueOfElement.date;
            // obj.className = "bg-" + valueOfElement.date;
            // obj.start = valueOfElement.start_time;
            // obj.end = valueOfElement.end_time;
            // obj.id = valueOfElement.id;   
            // defaultEvents.push(obj);  
        });
        var currentTime = new Date();
        console.log(currentTime);
        $.each(birthdays, function(indexInArray, valueOfElement) {
            if (valueOfElement.date !== null) {
                var check = 0;
                var date = new Date(valueOfElement.date);
                while (check < 2) {
                    let obj = {};
                    obj.title = '🎂 ';
                       
                    obj.className = "bg-success";
                    var str = currentTime.getFullYear() + check + '-' + valueOfElement.created_at.substring(5);
                    obj.start = str;
                    obj.id = valueOfElement.id;  
                    defaultEvents.push(obj);
                    check++;
                }
            }

        });
    </script>
@endpush

@push('extended-css')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.calendar')
@endpush

@section('content')
    @can('is-employee')
        <x-bread-crumb-component :modal=false />
    @endcan

    @can('is-universal')
        <x-bread-crumb-component :modal=true modalType="Event" modalId="add_event" />
        <x-event-modals-component />
    @endcan

    <x-events-calendar-component />
@endsection


@push('extended-js')
    <script src="{{ asset('js/core/events/main.js') }}"></script>
@endpush
