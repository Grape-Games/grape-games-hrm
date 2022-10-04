<style>
    .star{
        font-size:30px;
    }
  
  .Progress {
  width: 100%;
  background-color: #E2F6ED;
  height:50px;
  
}

.Bar {
  width: 0%;
  height: 50px;
  background-color: #4CAF50;
  padding-left:10px;
  padding-right:10px;
  line-height: 20px;
  color: white;
  display:flex;
  align-items:center;

  
}
.pct{font-size:20px}

</style>

 
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body html-content">   
                <h4 class="payslip-title">Month : {{$result->month}}</h4>
               
                
                <div class="row">
                    <div class="col-sm-12">
                        <div>
                            <h4 class="m-b-10"><strong class="ml-2">Employee Evaluation</strong></h4>
                            <table class="table table-bordered pay-slip-table">
                                <tbody>
                                    <tr>
                                        <td>
                                        <div class="Progress"><div class="Bar" style="width:{{RatingPercentage($result->total_rating)}}%"><div class="pct">{{RatingPercentage($result->total_rating)}}%</div></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Planning Coordination</strong>
                                           
                                            <span class="float-right star">
                                              {{SetRatingStars($result->planning_coordination)}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Quality of Work</strong>
                                            <span class="float-right star">
                                            {{SetRatingStars($result->quality_work)}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Communication Skill</strong>
                                           <span class="float-right star">
                                            {{SetRatingStars($result->communication_skill)}}
                                            </span>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <td><strong>Time Managment</strong>
                                           <span class="float-right star">
                                            {{SetRatingStars($result->time_managment)}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Over All Rating</strong>
                                          <span class="float-right star">
                                            {{SetRatingStars($result->overall_rating)}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong >Additional Comments <span class="text-danger">*</span> </strong>
                                           <p class="ml-5">
                                            {{$result->additional_comments}}
                                            </p>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Over All Performence <span class="text-danger">*</span></strong>
                                           <p class="ml-5">
                                            {{$result->over_all_performance}}
                                            </p>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Area of Improvements <span class="text-danger">*</span></strong>
                                           <p class="ml-5">
                                            {{$result->area_of_improvements}}
                                            </p>
                                            
                                        </td>
                                    </tr>
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                  
                    
                </div>
            </div>
        </div>
    </div>
</div>
