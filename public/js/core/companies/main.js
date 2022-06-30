// company js

let btn = $(".submit-btn");

$(function () {
    $(".js-example-basic-multiple").select2({
        placeholder: "Departments",
    });
});

$("#addCompanyForm").submit(function (e) {
    e.preventDefault();
    btn.html("Add Company");
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Company...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "companyCallback",
            "company-errors-print",
            "companies-table"
        );
    }
});

function companyCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add/Update Company");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        var oTable = $("." + table).dataTable();
        oTable.fnDraw(false);
    } else successFlow(errorClassName, response.response, "bg-danger");
}

$("body").on("click", ".update2", function () {
    $("#" + $(this).data("modal")).modal("toggle");
    dynamicAjax(
        window.location.pathname + "/" + $(this).data("id") + "/edit",
        "GET",
        "",
        "updateCompany",
        "company-errors-print",
        "companies-table"
    );
});

function updateCompany(response, errorClassName, table) {
    var input = $(
        '<input type="hidden" name="company_id" value="' + response.id + '">'
    );
    $("#addCompanyForm").append(input);
    $("[name=branch_name]").val(response.branch_name);
    $("[name=grace_minutes]").val(response.grace_minutes);
    $("[name=name]").val(response.name);
    $("[name=time_in]").val(response.time_in);
    $("[name=time_out]").val(response.time_out);
    var myArr = [];
    response.departments.forEach((element) => {
        myArr.push(element.department_type_id);
    });
    $(".js-example-basic-multiple").val(myArr).trigger("change");
    $("input:radio[name=status]")
        .filter("[value=" + response.status + "]")
        .attr("checked", true);
    $('[name="late_minutes_deduction"]').removeAttr("checked");
    $('[name="over_time_payment"]').removeAttr("checked");
    $("input:radio[name=late_minutes_deduction]")
        .filter("[value=" + response.late_minutes_deduction + "]")
        .attr("checked", true);
    $("input:radio[name=over_time_payment]")
        .filter("[value=" + response.over_time_payment + "]")
        .attr("checked", true);
    btn.prop("disabled", false);
    btn.html("Add/Update Company");
}

$("#add_company").on("hidden.bs.modal", function () {
    // do something…
    $("[name=company_id]").remove();
    $(this).find("form").trigger("reset");
    $(this).find("select").trigger("change");
});
