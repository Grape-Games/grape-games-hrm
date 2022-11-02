<div>
   
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Project</th>
      <th scope="col">Assigned by</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">Priority</th>
      <th scope="col">Details</th>
    </tr>
  </thead>
  <tbody>
   @foreach ($result as $key=> $task)
    <tr>
    <td>{{ $loop->iteration }}</td> 
    <td>{{$task->project->name}}</td> 
    <td>{{$task->user->name}}</td> 
    <td>{{$task->start_date}}</td> 
    <td>{{$task->end_date}}</td> 
    <td>{{$task->priority}}</td> 
    <td>
    <a href="#" class="view-details mt-2 btn btn-success btn-sm" data-toggle="tooltip" title="Edit Task" data-details="'{{$task->details}}'" data-table="task-table" data-modal="task_details" data-original-title="Update Record"><i class="fa fa-eye" aria-hidden="true"></i></a>
    </td> 
                           
    </tr>
   @endforeach
  </tbody>
</table>
</div>


@push('extended-js')

    <script>
         $("body").on("click", ".view-details", function () {
            $("#" + $(this).data("modal")).modal("toggle");
            $("#project_task_details").html($(this).data("details"))
  
});
    </script>

@endpush