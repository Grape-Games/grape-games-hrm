const dtColumns = [
    { title: "First Name", data: "employee.first_name" },
    { title: "Last Name", data: "employee.last_name" },
    { title: "Added_by", data: "user.name" },
    { title: "Month", data: "month" },
    {title:"Approved|Disapproved",data:"approvedby"},
    { title: "Status",
       render: function (data, type, row, meta) {
            if(row.role == 'team_lead'){
                if(row.status == 0){
                    return ' <span class="badge bg-inverse-warning">Pending</span>';
                }else if(row.status == 1){
                    return '<span class="badge bg-inverse-success">Approved</span>';
                }else{
                    return '<span class="badge bg-inverse-danger">Disapproved</span>';
                }
              
            }else{
                if(row.status == 0){
                    return  '<select id="box" name="status"  class="selectpicker form-control bg-inverse-warning" data-style="warning" onChange="getStatus(this.value,'+row.id+');"><option value="0" selected="selected" >Pending</option><option value="1">Approved</option><option value="2">Disapproved</option></select>';
                }else if(row.status == 1){
                    return  '<select id="box" name="status" color:#fff" class="selectpicker form-control bg-inverse-success" data-style="warning" onChange="getStatus(this.value,'+row.id+');"><option value="0"  >Pending</option><option value="1" selected="selected">Approved</option><option value="2">Disapproved</option></select>';
                }else{
                    return  '<select id="box" name="status" color:#fff" class="selectpicker form-control bg-inverse-danger" data-style="warning" onChange="getStatus(this.value,'+row.id+');"><option value="0"  >Pending</option><option value="1" >Approved</option><option selected="selected" value="2">Disapproved</option></select>';
                }
             
            }
      } 
     },
    // {
    //     title: "Planning Coordination",
    //     data: "planning_coordination",
    //     render: function (data, type, row, meta) {
    //         return SetStar(data);
    //     },
    //     orderable: false,
    //     searchable: false,
    // },
    // {
    //     title: "Quality Work",
    //     data: "quality_work",
    //     render: function (data, type, row, meta) {
    //         return SetStar(data);
    //     },
    //     orderable: false,
    //     searchable: false,
    // },
    // {
    //     title: "Communication Skill",
    //     data: "communication_skill",
    //     render: function (data, type, row, meta) {
    //         return SetStar(data);
    //     },
    //     orderable: false,
    //     searchable: false,
    // },
    // {
    //     title: "Overall Rating",
    //     data: "overall_rating",
    //     render: function (data, type, row, meta) {
    //         return SetStar(data);
    //     },
    //     orderable: false,
    //     searchable: false,
    // },
    // {
    //     title: "Time Managment",
    //     data: "time_managment",
    //     render: function (data, type, row, meta) {
    //         return SetStar(data);
    //     },
    //     orderable: false,
    //     searchable: false,
    // },
    // { title: "Additional Comments", data: "additional_comments" },
    // { title: "Over all Performance", data: "over_all_performance" },
    // { title: "Area of Improvements", data: "area_of_improvements" },
    {
        title:"Total Rating",
        render: function (data, type, row, meta) {
            percent = row.total_rating * 100 / 25;
           if(percent > 100){
            percent = 100;  
          }
          return ('<div class="Progress"><div class="Bar" style="width:'+percent+'%"><div class="pct">'+percent+'%</div></div></div>');
         
         
        },
        orderable: false,
        searchable: false,

    },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="evaluation" data-id="' +
                data +
                '" data-table="evaluation-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" class="update2 mt-2 btn btn-info btn-sm" data-toggle="tooltip" title="Edit Evaluation" data-id="' +
                data +
                '" data-table="evaluation-table" data-modal="add_evaluation" data-original-title="Update Record"><i class="fa fa-edit" aria-hidden="true"></i></a>'
            );  
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("evaluation-table", dtColumns);

function SetStar(stars) {
    if (stars == 1) {
        return "★☆☆☆☆";
    } else if (stars == 2) {
        return "★★☆☆☆";
    } else if (stars == 3) {
        return "★★★☆☆";
    } else if (stars == 4) {
        return "★★★★☆";
    } else if (stars == 5) {
        return "★★★★★";
    } else {
        return "☆☆☆☆☆";
    }
}


function getStatus(val,id){
    $.ajax({
        url: "/dashboard/evaluation-status",
        type: "POST",
        data: {id : id, status:val},
        success: function(response) {
            console.log("success", response);
            $(".evaluation-table").DataTable().ajax.reload();
            makeToastr('success', response.response,
                'Successful');
        },
      });
 
 }