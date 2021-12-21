// departments js

let btn = $(".submit-btn");

$("#addDepartmentForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Department...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "departmentCallback",
            "department-errors-print",
            "departments-table"
        );
    }
});

function departmentCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Department");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        var oTable = $("." + table).dataTable();
        oTable.fnDraw(false);
    } else successFlow(errorClassName, response.response, "bg-danger");
}
