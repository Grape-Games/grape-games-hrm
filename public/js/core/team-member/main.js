
$("[name=role]").val('team_lead');


let btn = $(".submit-btn");

$("#addEmployeeHRMAccount").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Creating Team lead Account Please wait...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "emCallback",
            "em-errors-print",
            "emhr-table"
        );
    }
});
function emCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Team lead");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        $(".teamlead-table").DataTable().ajax.reload();
        var oTable = $("." + table).dataTable();
        oTable.fnDraw(false);
    } else if (response.status == 409) {
        makeToastr(
            "error",
            response.responseJSON.response,
            "Exception occured 😢"
        );
    } else successFlow(errorClassName, response.response, "bg-danger");
}

$("body").on("click", ".addMembers", function () {
    $("#" + $(this).data("modal")).modal("toggle");
    $("[name=team_lead_id]").val($(this).data("id"))
    $.ajax({
        url: "/dashboard/team-all-members/"+$(this).data("id"),
        type: "get",
        success: function(response) {
            // console.log(response.data);

            var html = "";
            var counter = 1;
            $("#appendHere").html("");
            $.each(response.data, function(indexInArray,
                valueOfElement) {
                html += '<tr ><td scope="row">' + counter + '</td><td>' +
                valueOfElement.employee.first_name+" " +valueOfElement.employee.last_name + '</td><td>' +valueOfElement.assigned_by.name+ '</td><td>'+
                '<a  id="deleteMember" data-id="'+valueOfElement.id+'"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                +'</td></tr>';

                counter++;
            });
            $("#appendHere").html(html);
        },
      }); 

});



$("body").on("change", "#employee_id", function () {
   var emp_id = $(this).val();
   var team_lead_id = $("[name=team_lead_id]").val();
   $.ajax({
    url: "/dashboard/team-members",
    type: "post",
    data:{employee_id:emp_id,assigned_to:team_lead_id},
    success: function(response) {
        console.log("success", response);
        if(response.status == 200){
            makeToastr("success", response.message,"Action Successful. 😃");
            var html = "";
            var counter = 1;
            $("#appendHere").html("");
            $.each(response.data, function(indexInArray,
                valueOfElement) {
                html += '<tr ><td scope="row">' + counter + '</td><td>' +
                valueOfElement.employee.first_name+" " +valueOfElement.employee.last_name + '</td><td>' +valueOfElement.assigned_by.name+ '</td><td>'+
                '<a  id="deleteMember" data-id="'+valueOfElement.id+'"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                +'</td></tr>';

                counter++;
            });
            $("#appendHere").html(html);
        }else{
            makeToastr("error", response.message,"Action Successful.");
        }
            
      
       
    },
  });
     
});




$("table").on("click", "#deleteMember", function () {
    $(this).closest("tr").remove();
   $.ajax({
    url: "/dashboard/team-members/"+$(this).data("id"),
    type: "delete",
    success: function(response) {
        console.log("success", response); 
    },
  });
})



$("body").on("click", ".delete", function () {
    var id = $(this).data("id");
    var table = $(this).data("table");
    Swal.fire({
        title: "Are you sure to delete ?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-outline-danger ms-1",
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            // ajax
            $.ajax({
                type: "DELETE",
                url:   "/dashboard/employee-web-accounts/" + id,
                dataType: "json",
                success: function (response) {
                    makeToastr(
                        "success",
                        response.response + " 👌",
                        "Action Successful."
                    );
                    $(".teamlead-table").DataTable().ajax.reload();
                },
                error: function (response) {
                    makeToastr(
                        "error",
                        response.responseJSON.response + " 😭",
                        "Action Failed."
                    );
                },
            });
        }
    });
});

