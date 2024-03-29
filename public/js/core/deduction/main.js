let btn = $(".submit-btn");

$("#addDeduction").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Creating Deduction Please wait...");
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
    btn.html("Add Deduction");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        $(".deduction-table").DataTable().ajax.reload();
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
        "updateDeduction"
        // "company-errors-print",
        // "companies-table"
    );
});

function updateDeduction(response, errorClassName, table) {
    // console.log(response);
    var input = $(
        '<input type="hidden" name="deduction_id" value="' + response.id + '">'
    );
    $("#addDeduction").append(input);
    $("[name=employee_id]").val(response.employee_id);
    $("[name=name]").val(response.name);
    $("[name=month]").val(response.month);
    $("[name=amount]").val(response.amount);
    $("[name=description]").val(response.description);

    $(".js-example-basic-multiple").val(myArr).trigger("change");

    btn.prop("disabled", false);
    btn.html("Add/Update Deduction");
}

$("#add_deduction").on("hidden.bs.modal", function () {
    // do something…
    $("[name=deduction_id]").remove();
    $(this).find("form").trigger("reset");
    $(this).find("select").trigger("change");
});
