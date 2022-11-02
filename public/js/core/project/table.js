const dtColumns = [
    { title: "Name", data: "name" },
    { title: "Buget", data: "buget" },
    { title: "Added_by", data: "user.name" },
    { title: "URL", data: "url" },
    { title: "Status", 
    render: function (data, type, row, meta) {
        
            if(row.status == 1){
                return  '<select id="box" name="status" class="selectpicker form-control" data-style="warning" onChange="getStatus(this.value,'+row.id+');" >   <option value="1" selected="selected" >Not Started</option>  <option value="2">In-Progress</option><option value="3">On-Hold</option><option value="4">Cancelled</option><option value="5">Finished</option> </select>' 
            }else if(row.status == 2){
                return  '<select id="box" name="status" class="selectpicker form-control" data-style="warning" onChange="getStatus(this.value,'+row.id+');">    <option value="1"  >Not Started</option><option selected="selected" value="2">In-Progress</option><option value="3">On-Hold</option><option value="4">Cancelled</option><option value="5">Finished</option></select>' 
            }else if(row.status == 3){
                return  '<select id="box" name="status" class="selectpicker form-control" data-style="warning" onChange="getStatus(this.value,'+row.id+');">    <option value="1"  >Not Started</option><option value="2">In-Progress</option><option  selected="selected" value="3">On-Hold</option><option value="4">Cancelled</option><option value="5">Finished</option></select>' 
            }else if(row.status == 4){
                return  '<select id="box" name="status" class="selectpicker form-control" data-style="warning" onChange="getStatus(this.value,'+row.id+');">    <option value="1"  >Not Started</option><option value="2">In-Progress</option><option value="3">On-Hold</option><option value="4" selected="selected">Cancelled</option><option value="5">Finished</option></select>' 
            }else{
                return  '<select id="box" name="status" class="selectpicker form-control" data-style="warning" onChange="getStatus(this.value,'+row.id+');">    <option value="1"  >Not Started</option><option value="2">In-Progress</option><option value="3">On-Hold</option><option value="4">Cancelled</option><option value="5" selected="selected">Finished</option></select>'
            }
           
       
        
    },
    orderable: false,
    searchable: false, },
    { title: "Added time", data: "created_at" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Project" data-id="' +
                data +
                '" data-table="project-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" class="update2 mt-2 btn btn-info btn-sm" data-toggle="tooltip" title="Edit Project" data-id="' +
                data +
                '" data-table="project-table" data-modal="add_project" data-original-title="Update Record"><i class="fa fa-edit" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("project-table", dtColumns);


