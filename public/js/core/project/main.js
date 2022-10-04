let btn = $(".submit-btn");

$("#addNewProject").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Creating New Project Please wait...");
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
    btn.html("Add New Project");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        $(".project-table").DataTable().ajax.reload();
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

$("body").on("click", ".update2", function () {
    $("#" + $(this).data("modal")).modal("toggle");
    dynamicAjax(
        window.location.pathname + "/" + $(this).data("id") + "/edit",
        "GET",
        "",
        "updateSandWich"
    );
});

function updateSandWich(response, errorClassName, table) {
    console.log(response);
    var input = $(
        '<input type="hidden" name="project_id" value="' + response.id + '">'
    );
    $("#addNewProject").append(input);
    $("[name=owner_id]").val(response.owner_id);
    $("[name=name]").val(response.name);
    $("[name=buget]").val(response.buget);
    $("[name=url]").val(response.url);

    btn.prop("disabled", false);
    btn.html("Add/Update Sand Wich Rule");
}

$("#add_project").on("hidden.bs.modal", function () {
    // do something…
    $("[name=project_id]").remove();
    $(this).find("form").trigger("reset");
});



function getStatus(val,id){
    $.ajax({
        url: "/dashboard/project-status",
        type: "POST",
        data: {id : id, status:val},
        success: function(response) {
            console.log("success", response);

            makeToastr('success', response.response,
                'Successful');
        },
      });
}