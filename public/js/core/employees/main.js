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

$("[name=biometric_device_id]").change(function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/api/ZKteco/js/getDeviceUsers",
        data: { id: $(this).find(":selected").val() },
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#enrollment_no").empty().trigger("change");
            $.each(response.response, function (indexInArray, valueOfElement) {
                var newOption = new Option(
                    valueOfElement.name +
                        " ( " +
                        valueOfElement.enrollment_no +
                        " )",
                    valueOfElement.enrollment_no,
                    false,
                    false
                );
                $("#enrollment_no").append(newOption).trigger("change");
            });
        },
        error: function (error) {
            console.log(error);
            $("#enrollment_no").empty().trigger("change");
            $("#emp_id")
                .removeClass("text-success")
                .addClass("text-danger")
                .html("NULL");
            makeToastr("error", error.responseJSON.message, "Exception 😒");
        },
    });
});

$("#enrollment_no").change(function (e) {
    e.preventDefault();
    let obj = $("#emp_id");
    obj.html($(this).find(":selected").val());
    obj.text() == "NULL"
        ? obj.removeClass("text-success").addClass("text-danger")
        : obj.removeClass("text-danger").addClass("text-success");
});
