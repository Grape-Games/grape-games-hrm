@extends('layouts.master')

@push('extended-css')
@endpush

@section('content')
<style>
    .Progress {
  width: 100%;
  background-color: #ddd;
  height:20px;
  margin-bottom:10px;
}

.Bar {
  width: 45%;
  height: 20px;
  background-color: #4CAF50;
  padding-left:6px;
  padding-right:0px;
  line-height: 20px;
  color: white;
  display:block;
}
.pct{font-size:12px}
</style>
{{-- evaluation table --}}
<div class="col-md-12 d-flex">
<div class="card card-table flex-fill">
    <div class="card-header">
        <h3 class="card-title mb-0">Recently Evaluations
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-nowrap custom-table mb-0">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Date</th> 
                        <th>Planning Coordination</th>
                        <th>Quality of Work</th>
                        <th>Communication Skill</th>
                        <th>Time Managment</th>
                        <th>Overall Rating</th>
                        <th>Total Rating</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($evaluations as $employee)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                              {{$employee->from_date}}
                            </td>  
                            <td style="font-size:20px">
                                {{ SetRatingStars($employee->planning_coordination)}}
                            </td>
                            <td style="font-size:20px">
                                {{ SetRatingStars($employee->quality_work)}}
                            </td>
                            <td style="font-size:20px">
                                {{ SetRatingStars($employee->communication_skill)}}
                            </td>
                            <td style="font-size:20px">
                                {{ SetRatingStars($employee->time_managment)}}
                            </td>
                            <td style="font-size:20px">
                                {{ SetRatingStars($employee->overall_rating)}}
                            </td>
                            <td>
                                <div class="Progress">
                                    <div class="Bar" data-value="{{$employee->total_rating}}"><div  class="pct">
                                    </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target=".bd-example-modal-lg" onClick="viewDetails({{$employee}})">View</button>
                            </td>
                        </tr>
                    @empty
                        <td colspan=3 class="text-center">No records available.</td>
                    @endforelse
                </tbody>
            </table>
            {!! $evaluations->links() !!}
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-3">
                <h3>Additional Comments</h3>
                <p class="comm-1"></p> <hr>
                <h3>Over All Performence</h3>
                <p class="comm-2"></p> <hr>
                <h3>Area of Improvements </h3>
                <p class="comm-3"></p> <hr>
            </div>
          </div>
        </div>
      </div>

    {{--End Modal --}}
</div>
</div>
{{--end evaluation table --}}



@endsection 

@push('extended-js')
<script>
    $( ".Bar" ).each(function() {
  let percent = $(this).attr('data-value');
  percent = percent * 100 / 25;
  //For too high values :
  if(percent > 100){
    percent = 100;
  }
  console.log(percent);
    $(this).animate({width: percent+'%' }, 2000);
    $(this).children('.pct').html(percent+'%');
});

function viewDetails(data){
   console.log(data);
   $(".comm-1").html(data.additional_comments);
   $(".comm-2").html(data.over_all_performance);
   $(".comm-3").html(data.area_of_improvements);
   $(".modal-title").html(data.from_date);
}
</script>
@endpush