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




    <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script src="{{ asset('js/core/charts/monthly-attendance.js') }}"></script>
    <script>
        var data = @json($dates);
        const d = new Date();
        let month = d.getMonth();

        let objArr = new Array();

        let obj2 = {
            backgroundColor: "#55ce63",
        };

        $.each(data, function(indexInArray, valueOfElement) {
            let obj = {};
            obj["d-" + valueOfElement[0]] = obj2;
            objArr.push(obj);
        });

        console.log(objArr);

        var myConfig = {
            type: "calendar",
            options: {
                endMonth: month,
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
                            echo '"d-' . $date[0] . '":{ backgroundColor: "#55ce63",},';
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
