// company js

let btn = $(".submit-btn");

$(function () {
    $(".js-example-basic-multiple").select2({
        placeholder: "Departments",
    });
});

$("#addCompanyForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Company...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "companyCallback",
            "company-errors-print",
            "companies-table"
        );
    }
});

function companyCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Company");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        var oTable = $("." + table).dataTable();
        oTable.fnDraw(false);
    } else successFlow(errorClassName, response.response, "bg-danger");
}
