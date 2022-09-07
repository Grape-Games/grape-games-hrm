let btn = $(".submit-btn");

$("#addNewSandWichRule").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Creating New Sand Which Rule Please wait...");
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
    btn.html("Add New Sand wich Rule");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        $(".sandwich-table").DataTable().ajax.reload();
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
        "updateSandWich"
        // "company-errors-print",
        // "companies-table"
    );
});

function updateSandWich(response, errorClassName, table) {
    // console.log(response);
    var input = $(
        '<input type="hidden" name="sandwich_id" value="' + response.id + '">'
    );
    $("#addNewSandWichRule").append(input);
    $("[name=date]").val(response.date);

    btn.prop("disabled", false);
    btn.html("Add/Update Sand Wich Rule");
}

$("#add_sandwichRule").on("hidden.bs.modal", function () {
    // do something…
    $("[name=sandwich_id]").remove();
    $(this).find("form").trigger("reset");
    $(this).find("select").trigger("change");
});
