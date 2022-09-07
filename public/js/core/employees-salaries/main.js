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
    $("[name=per_day]").val("");
    $("[name=per_hour]").val("");
    $("[name=per_minute]").val("");
    $("[name=basic_salary]").val("");
    $("[name=house_allowance]").val("");
    $("[name=mess_allowance]").val("");
    $("[name=travelling_allowance]").val("");
    $("[name=medical_allowance]").val("");
    let id = $(this).data("id");
    $("[name=employee_id]").val(id);
    uniqueElements.forEach(function (item) {
        if (item.id == id) {
            $("[name=per_day]").val(item.per_day);
            $("[name=per_hour]").val(item.per_hour);
            $("[name=per_minute]").val(item.per_minute);
            $("[name=basic_salary]").val(item.basic_salary);
            $("[name=house_allowance]").val(item.house_allowance);
            $("[name=mess_allowance]").val(item.mess_allowance);
            $("[name=travelling_allowance]").val(item.travelling_allowance);
            $("[name=medical_allowance]").val(item.medical_allowance);
        }
    });
});

function esfCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Generate Slip");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        successFlow(errorClassName, response.response, "bg-success");
        // var oTable = $("." + table).dataTable();
        // oTable.fnDraw(false);
        // window.location.href = response.response;
    } else if (response.status == 409) {
        makeToastr(
            "error",
            response.responseJSON.response,
            "Exception occured 😢"
        );
    } else successFlow(errorClassName, response.response, "bg-danger");
}

$("body").on("click", ".incrementDetail", function () {
    var id = $(this).data("id");
    var emp_name = $(this).data("title");
    $(".modal-title").html(emp_name + " " + "Increment Details");
    $(".alert").remove();
    $(".inc-row").remove();
    $.ajax({
        type: "GET",
        url: "/dashboard/show/all-increments/" + id,
        enctype: "multipart/form-data",

        success: function (response) {
            console.log(response);
            if (response.next_Increment == "empty") {
                $(".top-section").append(
                    '<div class="text-center alert next-increment alert-primary" role="alert">' +
                        "Next Increment Yet Not set </div>"
                );
            } else {
                $(".top-section").append(
                    '<div class="text-center alert next-increment alert-primary" role="alert">' +
                        "Next Increment will be Start From " +
                        "<strong>" +
                        response.next_Increment +
                        "</strong></div>"
                );
            }
            response.all_inc.forEach(function (value, index) {
                var d = new Date(value.month);
                month = "" + (d.getMonth() + 1);
                if (month.length < 2) month = "0" + month;
                year = d.getFullYear();
                $(".Last-incements-tb").append(
                    '<tr class="inc-row"><td>' +
                        month +
                        "-" +
                        year +
                        "</td><td>" +
                        value.amount +
                        "</td><td>" +
                        value.percentage +
                        "%" +
                        "</td></tr>"
                );
            });
        },
    });
});
