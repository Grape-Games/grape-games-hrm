// designation js

let btn = $(".submit-btn");

$("#addDesignationForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        if (
            parseInt($("[name=max_salary]").val()) <
            parseInt($("[name=min_salary]").val())
        ) {
            makeToastr(
                "error",
                "Maximum Salary must be greater than minimum salary.",
                "Oops ! Something went wrong."
            );

            $("[name=max_salary]")
                .removeClass("is-valid")
                .addClass("is-invalid error");
            return;
        }
        btn.prop("disabled", true);
        btn.html("Adding Desgination...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "designationCallback",
            "designation-errors-print",
            "designations-table"
        );
    }
});

function designationCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Designation");
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
    } else {
        let message;
        response.hasOwnProperty("responseJSON")
            ? (message = response.responseJSON.message)
            : (message = response.response);
        makeToastr("error", message, "Oops ! Something went wrong.");
        successFlow(errorClassName, message, "bg-danger");
    }
}
