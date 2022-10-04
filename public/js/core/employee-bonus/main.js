let btn = $(".submit-btn");

$("#addEmployeeBonus").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Creating Employee Bonus Please wait...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "emCallback",
            "em-errors-print",
            "emhr-table"
        );
    }
});

function emCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Bonus");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        $(".employee-bonus-table").DataTable().ajax.reload();
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

$("body").on("click", ".update2", function () {
    $("#" + $(this).data("modal")).modal("toggle");
    dynamicAjax(
        window.location.pathname + "/" + $(this).data("id") + "/edit",
        "GET",
        "",
        "updateEmployeeBonus"
        // "company-errors-print",
        // "companies-table"
    );
});

function updateEmployeeBonus(response, errorClassName, table) {
    // console.log(response);
    var input = $(
        '<input type="hidden" name="bonus_id" value="' + response.id + '">'
    );
    $("#addEmployeeBonus").append(input);
    $("[name=employee_id]").val(response.employee_id);
    $("[name=bouns_name]").val(response.bouns_name);
    $("[name=month]").val(response.month);
    $("[name=amount]").val(response.amount);
    $("[name=description]").val(response.description);
    $("[name=biometric_device_id]").val(response.biometric_device_id);

    btn.prop("disabled", false);
    btn.html("Add/Update Company");
}

$("#add_employee_bonus").on("hidden.bs.modal", function () {
    // do something…
    $("[name=bonus_id]").remove();

    $(this).find("form").trigger("reset");
    $(this).find("select").trigger("change");
});
