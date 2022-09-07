let btn = $(".submit-btn");

$("#addEvaluation").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Creating Evaluation Please wait...");
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
    btn.html("Add Evaluation");
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

$("body").on("click", ".update2", function () {
    $("#" + $(this).data("modal")).modal("toggle");
    dynamicAjax(
        window.location.pathname + "/" + $(this).data("id") + "/edit",
        "GET",
        "",
        "updateLoan"
        // "company-errors-print",
        // "companies-table"
    );
});

function updateLoan(response, errorClassName, table) {
    // console.log(response);
    var input = $(
        '<input type="hidden" name="loan_id" value="' + response.id + '">'
    );
    var input2 = $(
        '<input type="hidden" name="created_at" value="' +
            response.created_at +
            '">'
    );
    $("#addloan").append(input, input2);
    $("[name=employee_id]").val(response.employee_id);
    $("[name=name]").val(response.name);
    $("[name=number_installment]").val(response.number_installment);
    $("[name=amount]").val(response.amount);
    $("[name=description]").val(response.description);

    $(".js-example-basic-multiple").val(myArr).trigger("change");

    btn.prop("disabled", false);
    btn.html("Add/Update Deduction");
}

$("#add_evaluation").on("hidden.bs.modal", function () {
    // do something…
    // $("[name=loan_id]").remove();
    // $("[name=created_at]").remove();
    $(this).find("form").trigger("reset");
    $(this).find("select").trigger("change");
    var text = $("span").text();
    $(".star > span").html("☆");
});
