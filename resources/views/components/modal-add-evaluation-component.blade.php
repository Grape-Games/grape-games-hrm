<style>
    .star span{
        font-size:30px;
        cursor :pointer;
    }
</style>

<div>
   <div id="add_evaluation" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Evaluation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEvaluation" method="POST"
                   action="{{ route('dashboard.evaluation.store') }}" novalidate>  
                    @csrf
                    <div class="row">
                        <input type="hidden" name="user_id" id="" value="{{$user->id}}"> 
                            <div class="col-md-6">
                               <div class="form-group">
                                <label>Please select the Employee <span
                                        class="text-danger">*</span></label>
                                <select class="js-example-basic-single select2 form-control select" 
                                    name="employee_id" required id="employee_id">
                                    <option value="">Select employee</option>
                                    @forelse ($employees as $emp)
                                    @if($user->role == 'team_lead')
                                        <option value="{{ $emp->employee->id }}">
                                            {{ $emp->employee->first_name.' '.$emp->employee->last_name }}
                                        </option>
                                    @else
                                        <option value="{{ $emp->id }}">
                                            {{ $emp->first_name.' '.$emp->last_name }}
                                        </option>
                                    @endif
                                    @empty
                                        <option value="">No employee eligible for account is found.</option>
                                    @endforelse
                                </select>
                                </div>
                            </div>
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date *</label>
                                <input type="date" class="form-control" disabled name="from_date" id="evaluationDate"  required>
                            </div>
                           </div>
                            <div class="col-md-4">
                                <label for="">Planning Coordination</label>
                                <input type="hidden" class="Coordination-rating-rating" value="0" name="planning_coordination">
                                <div class="planning_star_rating star">
			                        <span data-rating="1">☆</span>
			                        <span data-rating="2">☆</span>
			                        <span data-rating="3">☆</span>
			                        <span data-rating="4">☆</span>
			                        <span data-rating="5">☆</span>
		                        </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Quality of Work</label>
                                <input type="hidden" class="quality-rating" value="0" name="quality_work">
                                <div class="quality_star_rating star">
			                        <span data-rating="1">☆</span>
			                        <span data-rating="2">☆</span>
			                        <span data-rating="3">☆</span>
			                        <span data-rating="4">☆</span>
			                        <span data-rating="5">☆</span>
		                        </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Communication Skill</label>
                                <input type="hidden" class="communication-rating" value="0" name="communication_skill">
                                <div class="communication_star_rating star">
			                        <span data-rating="1">☆</span>
			                        <span data-rating="2">☆</span>
			                        <span data-rating="3">☆</span>
			                        <span data-rating="4">☆</span>
			                        <span data-rating="5">☆</span>
		                        </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="">Time Managment</label>
                                <input type="hidden" class="time-rating" value="0" name="time_managment">
                                <div class="time_star_rating star">
			                        <span data-rating="1">☆</span>
			                        <span data-rating="2">☆</span>
			                        <span data-rating="3">☆</span>
			                        <span data-rating="4">☆</span>
			                        <span data-rating="5">☆</span>
		                        </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Overall Rating</label>
                                <input type="hidden" class="overall-rating" value="0" name="overall_rating">
                                <div class="overall_rating_star star">
			                        <span data-rating="1">☆</span>
			                        <span data-rating="2">☆</span>
			                        <span data-rating="3">☆</span>
			                        <span data-rating="4">☆</span>
			                        <span data-rating="5">☆</span>
		                        </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Additional Comments <span
                                        class="text-danger">*</span></label>
                                <textarea name="additional_comments" id="" cols="6" rows="3" class="form-control"></textarea >
                            </div>
                            <div class="col-md-6">
                                <label for="">Over All Performence <span
                                        class="text-danger">*</span></label>
                                <textarea name="over_all_performance" id="" cols="6" rows="3" class="form-control"></textarea >
                            </div>
                            <div class="col-md-12">
                                <label for="">Area of Improvements <span
                                        class="text-danger">*</span></label>
                                <textarea name="area_of_improvements" id="" cols="6" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="submit-section">
                           <button class="btn btn-primary submit-btn">Add Evaluation</button>
                         
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@push('extended-js')
<script>
	var planning_star;
	var quality_star;
	var communication_star;
	var overallRating_star;
	var time_star;
	document.addEventListener('DOMContentLoaded', () => {
		planning_star = document.querySelectorAll(".planning_star_rating span");
		quality_star = document.querySelectorAll(".quality_star_rating span");
		communication_star = document.querySelectorAll(".communication_star_rating span");
		overallRating_star = document.querySelectorAll(".overall_rating_star span");
		time_star = document.querySelectorAll(".time_star_rating span");

		planning_star.forEach(item => {
			item.addEventListener('click', function () {
				var rating = this.getAttribute("data-rating");
				document.querySelector(".Coordination-rating-rating").value = rating;
				return SetRatingStar(rating, planning_star);
			});
		});
        
		quality_star.forEach(item => {
			item.addEventListener('click', function () {
				var rating = this.getAttribute("data-rating");
				document.querySelector(".quality-rating").value = rating;
				return SetRatingStar(rating, quality_star);
			});
		});

		communication_star.forEach(item => {
			item.addEventListener('click', function () {
				var rating = this.getAttribute("data-rating");
				document.querySelector(".communication-rating").value = rating;
				return SetRatingStar(rating, communication_star);
			});
		});
		overallRating_star.forEach(item => {
			item.addEventListener('click', function () {
				var rating = this.getAttribute("data-rating");
				document.querySelector(".overall-rating").value = rating;
				return SetRatingStar(rating, overallRating_star);
			});
		});
		time_star.forEach(item => {
			item.addEventListener('click', function () {
				var rating = this.getAttribute("data-rating");
				document.querySelector(".time-rating").value = rating;
				return SetRatingStar(rating, time_star);
			});
		});
	});



	function SetRatingStar(rating, stars) {
		var len = stars.length;
		console.log(rating);

		for (var i = 0; i < len; i++) {
			if (i < rating) {
				stars[i].innerHTML = '★';
			
			} else {
				stars[i].innerHTML = '☆';
			}
		}

	};

    $("body").on("change", "#employee_id", function () {
        $("[name=emp_added]").remove();
        $("[name=last_evaluation]").remove();
        $.ajax({
        // url: "/dashboard/employee-company/"+$(this).val(),
        url: "/dashboard/employee/last-evaluation/"+$(this).val(),
        type: "get",
        success: function(response) {
            console.log("success", response.employee);
            $("#evaluationDate").attr("disabled", false);
            var input = $('<input type="hidden" name="emp_added" value="' +response.employee.created_at + '">');
            var last_evaluation = $('<input type="hidden" name="last_evaluation" value="' +response.evaluation + '">');
            $("#addEvaluation").append(input);
            $("#addEvaluation").append(last_evaluation);
            $("#evaluationDate").val('');
        },
      });
    });
        
        $("body").on("change", "#evaluationDate", function () {
            var GivenDate = $("[name=emp_added").val().slice(0, 10);
            var CurrentDate = new Date($(this).val());
            var last_evalution = $("[name=last_evaluation").val();
            GivenDate = new Date(GivenDate);
           
            if(GivenDate > CurrentDate){
              makeToastr(
              "error",
              'Date should be Greater than '+$("[name=emp_added").val().slice(0, 10),
               "Exception occured 😢"
               );
              $(this).val('');
           }else {
            if( $(".modal-header > h5").text() == 'Create Evaluation'){
                if(last_evalution !== 'null'){
                //   alert(addMonths(new Date(last_evalution), 3))
                if(CurrentDate >= new Date(last_evalution) && CurrentDate <= addMonths(new Date(last_evalution),3)
                ){
                    var date = addMonths(new Date(last_evalution),3).toString();
                    makeToastr(
                    "error",
                    'Aready Exist Next quarter Should be add after'+' '+date[0]+date[1]+date[2]+' '+date[4]+date[5]+date[6]+ ' ' +date[8]+date[9]+' '+date[11]+date[12]+date[13]+date[14] ,
                    "Exception occured 😢"
            );
                $(this).val('');
                }
                }
            }
           }
           
        }); 
        
        function addMonths(date, months) {
              var d = date.getDate();
              date.setMonth(date.getMonth() + +months);
              if (date.getDate() != d) {
                 date.setDate(0);
                }
            return date;
        }
</script>
@endpush