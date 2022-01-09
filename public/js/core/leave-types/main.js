$("#isPaid").on("click", function () {
    $(this).is(":checked") ? $(this).val("true") : $(this).val("false");
});

// leave type js

let btn = $(".submit-btn");

$("#addLeaveTypeForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Leave Type...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "lvCallback",
            "lv-errors-print",
            "lv-table"
        );
    }
});

function lvCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Leave Type");
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
