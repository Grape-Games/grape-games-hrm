let btn = $(".submit-btn");

$("#addNoticeForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Notice...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "nbCallback",
            "nb-errors-print",
            "nb-table"
        );
    }
});

function nbCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Notice");
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
