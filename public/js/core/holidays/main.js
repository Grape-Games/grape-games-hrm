let btn = $(".submit-btn");

$("#addHoldidayForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Holiday...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "hdCallback",
            "errors-print",
            "hd-table"
        );
    }
});

function hdCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Holiday");
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
        "updateHoliday",
        
    );
   
});

function updateHoliday(response, errorClassName, table) {
     console.log(response)
     var input = $(
        '<input type="hidden" name="hd_id" value="' + response.id + '">'
    );
    $("#addHoldidayForm").append(input);
    $("[name=date]").val(response.custom_date_second);
    $("[name=sandwich_id]").val(response.sandwich_id);
    $("[name=details]").val(response.details);
    btn.prop("disabled", false);
    btn.html("Add/Update Holiday");
}

$("#add_holiday").on("hidden.bs.modal", function () {
    // do something…
    $("[name=hd_id]").remove();
    $(this).find("form").trigger("reset");
    $(this).find("select").trigger("change");
});