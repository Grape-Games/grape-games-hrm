<div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Tasks Completion Summary</h3>
                            <div id="bar-charts-admin"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Weekly Attendance Overview</h3>
                            <div id="line-charts-admin"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('extended-js')

    <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            Morris.Bar({
                element: "bar-charts-admin",
                data: @json($barData),
                xkey: "y",
                ykeys: ["a", "b"],
                labels: ["Total Tasks Assigned", "Total Tasks marked as completed"],
                lineColors: ["#f43b48", "#453a94"],
                lineWidth: "3px",
                barColors: ["#f43b48", "#453a94"],
                resize: true,
                redraw: true,
            });

            Morris.Line({
                element: 'line-charts-admin',
                data: @json($lineData),
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Total Employees', 'Total Present'],
                lineColors: ['#f43b48', '#453a94'],
                lineWidth: '3px',
                resize: true,
                redraw: true
            });
        });
    </script>

@endpush
