let btn = $(".submit-btn");

$("#searchSalarySlipForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Please wait...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "essCallback",
            "errors-print",
            ""
        );
    }
});

function essCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Search");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr(
            "success",
            "Slip generated please wait...",
            "Action Successful. 😃"
        );
        successFlow(
            errorClassName,
            "Please wait while you are being redirected...",
            "bg-success"
        );
        setTimeout(() => {
            window.location.href = response.response;
        }, 1000);
    } else if (response.status == 400) {
        makeToastr(
            "error",
            response.responseJSON.response,
            "Exception occured 😢"
        );
    } else successFlow(errorClassName, response.response, "bg-danger");
}
