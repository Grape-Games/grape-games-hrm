<style>
    #ShowPresent{
        cursor:pointer 
    }
 .tab-menu ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
}
.tab-menu ul li {
    -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%;
    text-align: center;
}
.tab-menu ul li a {
    color: #fff;
    
    font-family: "Oswald";
    font-weight: bold;
    display: inline-block;
    display: block;
    text-decoration: none;
    transition: 0.5s all;
    background: #C43B5D;
    border: 2px solid #C43B5D;
    border-bottom: 0;
}
.tab-menu ul li a:hover {
    background: #7B3A7C;
    color: #fff;
    text-decoration: none;
}
.tab-menu ul li a.active {
    background: #f4fcce;
    color: #000;
    text-decoration: none;
}
.tab-box {
    display: none;   
}

.tab-teaser {
    width: 100%;
    margin: 0 auto;
    font-family: "Oswald";
}
.tab-main-box {
    background: #f4fcce;
    padding: 10px 30px;
    border: 2px solid #C43B5D;
    margin-top: -2px;
}


</style>
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


<!-- Model -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="tab-teaser">
    <div class="tab-menu">
      <ul>
        @foreach($days as $index => $day)
        <li><a class="{{ $index == 0 ? 'active' : '' }}" onClick="ShowAttendance('{{$day->format('Y-m-d')}}')" href="#"  data-rel="tab-1">{{$day->format('l')}}</a></li>
        
        @endforeach
      </ul>
</div>

<div class="tab-main-box">
    <div class="tab-box" id="tab-1" style="display:block;">
       
    </div>
</div>
  </div>


      </div>
     
    </div>
  </div>
</div>
<!--end Model -->
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
                labels: ['Total Employees', '<span id="ShowPresent" data-toggle="modal" data-target="#exampleModalCenter">Total Present</span>'],
                lineColors: ['#f43b48', '#453a94'],
                lineWidth: '3px',
                resize: true,
                redraw: true
            });
           
        });
        $('.tab-menu li a').on('click', function(){
		   	var target = $(this).attr('data-rel');
			$('.tab-menu li a').removeClass('active');
		   	$(this).addClass('active');
		   	$("#"+target).fadeIn('slow').siblings(".tab-box").hide();
		   	return false;
  });
//   
function ShowAttendance(date){
       $('.tabe-bar').remove();
         $.ajax({
                type: "GET",
                url: 'dashboard/employee-attendance/' + date ,
                enctype: 'multipart/form-data',
               
                success: function (response) {
                    console.log(response);
                       response.forEach(function (value , index) {
                        let sr = index+1;
                    $(".tab-box").append(
                        '<p class="mb-0 tabe-bar" >'+ sr +'. '+value.employee.first_name+' ' +value.employee.last_name+'      '+date+'</p>' 
                       
                    )
                });
              
                }
            });

  }
   
    </script>

@endpush
