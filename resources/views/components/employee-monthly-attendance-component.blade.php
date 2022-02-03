@push('extended-css')
    <script nonce="undefined" src="https://cdn.zingchart.com/zingchart.min.js"></script>
@endpush

<section>
    <h5 class="dash-title">Current Month Attendance</h5>
    <div class="card">
        <div class="card-body">
            <div id='myChart'></div>
        </div>
    </div>
</section>

@push('extended-js')

    <script>
        var data = @json($dates);
        const d = {{ $monthNumber }};

        var myConfig = {
            type: "calendar",
            options: {
                startMonth: d,
                endMonth: d,
                year: {
                    visible: false,
                },
                weekday: {
                    values: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    item: {
                        fontFamily: "CircularStd",
                        fontSize: 12,
                    },
                },
                day: {
                    items: {
                        @php
                        foreach ($dates as $date) {
                            if ($date[2] == 'P') {
                                echo '"d-' . $date[0] . '":{ backgroundColor: "#55ce63",},';
                            } elseif ($date[2] == 'A') {
                                echo '"d-' . $date[0] . '":{ backgroundColor: "#ff4949",},';
                            } else {
                                echo '"d-' . $date[0] . '":{ backgroundColor: "#6C7EB7",},';
                            }
                        }
                        @endphp
                    },
                    inactive: {
                        backgroundColor: "lightgrey",
                    },
                },
                values: data,
            },
            plotarea: {
                marginTop: "0%",
                marginBottom: "0%",
            },
            tooltip: {
                text: "%data-day",
            },
            plot: {
                valueBox: {
                    text: "%data-info0",
                },
            },
        };

        zingchart.loadModules("calendar", function() {
            zingchart.render({
                id: "myChart",
                data: myConfig,
                height: 400,
                width: "100%",
            });
        });
    </script>
@endpush
