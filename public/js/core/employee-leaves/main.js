// deaprtment type js

let btn = $(".submit-btn");

$("#addEmployeeLeave").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Employee Leave Please wait...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "elCallback",
            "el-errors-print",
            "el-table"
        );
    }
});

function elCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Leave");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
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

$("[name=leave_type_id]").change(function (e) {
    e.preventDefault();
    $(".allowed-val").html($(this).find(":selected").data("allowed") + ' per year.');
});
