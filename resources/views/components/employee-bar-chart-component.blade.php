@push('extended-css')

@endpush

<section class="dash-section">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Monthly Tasks Progress</h3>
            <div id="bar-charts"></div>
        </div>
    </div>
</section>

@push('extended-js')

    <script>
        function randomIntFromInterval(min, max) { // min and max included 
            return Math.floor(Math.random() * (max - min + 1) + min)
        }
        var dates = @json($dataBarChart);
        var datesArr = [];
        $.each(dates, function(indexInArray, valueOfElement) {
            let obj = {};
            obj.y = valueOfElement.month + '-' + valueOfElement.year;
            obj.a = randomIntFromInterval(1, 100);
            obj.b = randomIntFromInterval(1, 100);
            datesArr.push(obj)
        });
        barData = datesArr;
    </script>

@endpush
