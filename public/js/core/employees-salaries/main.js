// deaprtment type js

let btn = $(".submit-btn");

$(function () {
    const d = new Date();
    $("[name=dated]").val(d.toISOString().slice(0, 19).replace("T", " "));
});

$("#addMonthlySalaryForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Printing Employee Salary Slip...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "esfCallback",
            "esf-errors-print",
            "esf-table"
        );
    }
});

$("body").on("click", ".gen-slip", function () {
    $("[name=employee_id]").val($(this).data("id"));
});

function esfCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Generate Slip");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        // successFlow(errorClassName, response.response, "bg-success");
        window.location.href = response.response;
    } else if (response.status == 409) {
        makeToastr(
            "error",
            response.responseJSON.response,
            "Exception occured 😢"
        );
    } else successFlow(errorClassName, response.response, "bg-danger");
}
