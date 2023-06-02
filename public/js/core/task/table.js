const dtColumns = [
    { title: "Project Name", data: "project.name" },
    {
        title: "Assigned to",
        render: function (data, type, row, meta) {
            return row.employee.first_name + ' ' + row.employee.last_name;
        }

    },
    { title: "Assigned by", data: "user.name" },
    { title: "Priority", data: "priority" },
    
    { title: "Status", 
    render: function (data, type, row, meta) {
        if(row.status == 1){
            return  '<select id="box" name="status" class="selectpicker form-control" data-style="warning" onChange="getStatus(this.value,'+row.id+');" >   <option value="1" selected="selected" >Pending</option>  <option value="2">On-Hold</option><option value="3">Done</option> </select>' 
        }else if(row.status == 2){
            return  '<select id="box" name="status" class="selectpicker form-control" data-style="warning" onChange="getStatus(this.value,'+row.id+');">    <option value="1"  >Pending</option><option selected="selected" value="2">On-Hold</option><option value="3">Done</option></select>' 
        }else if(row.status == 3){
            return  '<select id="box" name="status" class="selectpicker form-control" data-style="warning" onChange="getStatus(this.value,'+row.id+');">    <option value="1"  >Pending</option><option value="2">On-Hold</option><option  selected="selected" value="3">Done</option></select>' 
        }
    }
       },
    { title: "Added time", data: "created_at" },
    {
       
        title: "View",
        render: function (data, type, row, meta) {
            return (
                '<a href="/dashboard/task-details/'+row.id+'" class="mt-2 btn btn-success btn-sm">View</a>'
            );
        },
        orderable: false,
        searchable: false,
    },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Task" data-id="' +
                data +
                '" data-table="task-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" class="update2 mt-2 btn btn-info btn-sm" data-toggle="tooltip" title="Edit Task" data-id="' +
                data +
                '" data-table="task-table" data-modal="add_task" data-original-title="Update Record"><i class="fa fa-edit" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("task-table", dtColumns);