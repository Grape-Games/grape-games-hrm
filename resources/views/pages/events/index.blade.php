@extends('layouts.master')

@push('extended-js')
    <script>
        var deleteEventRoute = "{{ route('dashboard.events.delete2') }}";
        var updateEventRoute = "{{ route('dashboard.events.update2') }}";
        var createEventRoute = "{{ route('dashboard.events.create2') }}";
        var defaultEvents = [];
        var events = @json($events);
        var birthdays = @json($birthdays);

        $.each(events, function(indexInArray, valueOfElement) {
            let obj = {};
            obj.title = valueOfElement.name;
            obj.className = "bg-" + valueOfElement.category;
            obj.start = valueOfElement.start_time;
            obj.end = valueOfElement.end_time;
            obj.id = valueOfElement.id;
            defaultEvents.push(obj);
        });
        var currentTime = new Date();
        $.each(birthdays, function(indexInArray, valueOfElement) {
            if (valueOfElement.dob !== null) {
                var check = 0;
                while (check < 2) {
                    let obj = {};
                    obj.title = '🎂 ' + valueOfElement.employee.first_name + ' ' + valueOfElement.employee
                        .last_name;
                    obj.className = "bg-success";
                    var str = currentTime.getFullYear() + check + '-' + valueOfElement.dob.substring(5);
                    obj.start = str;
                    var newDate = new Date(str);
                    newDate.setDate(newDate.addHours(5));
                    obj.start = newDate;
                    obj.id = valueOfElement.id;
                    console.log(obj);
                    defaultEvents.push(obj);
                    check++;
                }
            }

        });

        Date.prototype.addHours = function(h) {
            this.setHours(this.getHours() + h);
            return this;
        }
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
