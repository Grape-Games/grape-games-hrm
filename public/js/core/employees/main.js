// departments js

let btn = $(".submit-btn");

$("#addEmployeeForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Employee...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "employeeCallback1",
            "employee-errors-print"
        );
    }
});

$("#additionalInformationForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Additional Information...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "employeeCallback",
            "employee-errors-print"
        );
    }
});

$("#bankDetailsForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Bank Information...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "employeeCallback",
            "employee-errors-print"
        );
    }
});

$("#emergenctContactDetails").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Emergency Contacts...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "employeeCallback",
            "employee-errors-print"
        );
    }
});

function employeeCallback1(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Details");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        // window.location.href = "/dashboard/employees";
    } else successFlow(errorClassName, response.response, "bg-danger");
}

function employeeCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Details");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
    } else successFlow(errorClassName, response.response, "bg-danger");
}
