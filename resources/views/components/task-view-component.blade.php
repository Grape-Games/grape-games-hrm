<div>
<div class="card mb-0">
            <div class="card-header" style="display: flex;justify-content: space-between">
                <div class="left">
                    <h4>Assigned to : {{$result->employee->first_name.' '.$result->employee->last_name}}</h4>
                    <h4>Project : {{$result->project->name}}</h4>
                    <h4 >Priority: {{$result->priority}}</h4>
                </div>
                <div class="right">
                    <h4>Start Date: {{$result->start_date}}</h4>
                    <h4>End Date  : {{$result->end_date}}</h4>
                    <h4>Status : 
                      <span class="badge rounded-pill bg-info text-white">
                        @if($result->status == 1)
                          Pending
                        @elseif($result->status == 2)
                          On-Hold 
                        @else 
                          Done
                        @endif
                        </span>
                    </h4>
                </div>
                
            </div>
            <div class="card-body">
            {!! $result->details !!}
            </div>
        </div>
</div>
