$("[name=employee_id]").change(function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url:
            "/dashboard/employee/last-increment&salry/" +
            $(this).find(":selected").val(),
        data: { id: $(this).find(":selected").val() },
        dataType: "json",
        success: function (response) {
            console.log(response.salry);
            if (response.last_increment) {
                $("#last_increment").val(response.last_increment.amount);
                $("#last_increment_Month").val(response.last_increment.month);
            } else {
                $("#last_increment").val("");
                $("#last_increment_Month").val("");
            }
            $("#basic_salry").val(response.salry.basic_salary);
            let percentage = parseInt($("input[name='percentage']").val());
            let salry = parseInt(response.salry.basic_salary);
            $("input[name='amount']").val((percentage * salry) / 100);
        },
        error: function (error) {
            console.log(error);
            makeToastr("error", error.responseJSON.message, "Not found 😒");
            $("#last_increment").val("0.00");
            $("#basic_salry").val("");
            $("input[name='percentage']").val("");
            $("input[name='amount']").val("");
            $("input[name='date']").val("");
            $("#purpose").val("");
        },
    });
});

let btn = $(".submit-btn");

$("#addNewIncrement").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Creating New Increment Please wait...");
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
    btn.html("Add New Increment");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        $(".increment-table").DataTable().ajax.reload();
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

$("input[name='percentage']").on("paste keyup", function () {
    if (!$("#basic_salry").val()) {
        alert("Please first Select Employee from list.");
        $(this).val("");
    } else {
        let percentage = parseInt($(this).val());
        let salry = parseInt($("#basic_salry").val());
        $("input[name='amount']").val((percentage * salry) / 100);
    }
});

$("input[name='amount']").on("paste keyup", function () {
    if (!$("#basic_salry").val()) {
        alert("Please first Select Employee from list.");
        $(this).val("");
    } else {
        let amount = parseInt($(this).val());
        let salry = parseInt($("#basic_salry").val());
        $("input[name='percentage']").val((amount / salry) * 100);
    }
});

$("body").on("click", ".update2", function () {
    $("#" + $(this).data("modal")).modal("toggle");
    dynamicAjax(
        window.location.pathname + "/" + $(this).data("id") + "/edit",
        "GET",
        "",
        "updateIncrement"
        // "company-errors-print",
        // "companies-table"
    );
});

function updateIncrement(response, errorClassName, table) {
    // console.log(response);
    var input = $(
        '<input type="hidden" name="increment_id" value="' + response.id + '">'
    );
    $("#addNewIncrement").append(input);
    $("[name=employee_id]").val(response.employee_id);
    $("[name=month]").val(response.month);
    $("[name=amount]").val(response.amount);
    $("[name=percentage]").val(response.percentage);
    $("[name=purpose]").val(response.purpose);
    $("#last_increment").val(response.amount);
    $("#last_increment_Month").val(response.month);
    $("[name=month]").val(response.month);

    // $(".js-example-basic-multiple").val(myArr).trigger("change");

    btn.prop("disabled", false);
    btn.html("Add/Update Increment");
}

$("#add_new_increment").on("hidden.bs.modal", function () {
    // do something…
    $("[name=increment_id]").remove();
    $(this).find("form").trigger("reset");
    $(this).find("select").trigger("change");
});
