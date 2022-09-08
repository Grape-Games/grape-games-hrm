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
        $(".evaluation-table").DataTable().ajax.reload();
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
        "updateEvaluation"
    );
});

function updateEvaluation(response, errorClassName, table) {
    console.log(response);
    var input = $(
        '<input type="hidden" name="evaluation_id" value="' + response.id + '">'
    );
    var input2 = $(
        '<input type="hidden" name="created_at" value="' +
            response.created_at +
            '">'
    );
    $("#addEvaluation").append(input, input2);
    $("[name=employee_id]").val(response.employee_id);
    $("[name=month]").val(response.month);
    $("[name=planning_coordination]").val(response.planning_coordination);
    $("[name=quality_work]").val(response.quality_work);
    $("[name=communication_skill]").val(response.communication_skill);
    $("[name=overall_rating]").val(response.overall_rating);
    $("[name=time_managment]").val(response.time_managment);
    $("[name=additional_comments]").val(response.additional_comments);
    $("[name=over_all_performance]").val(response.over_all_performance);
    $("[name=area_of_improvements]").val(response.area_of_improvements);

    // $(".js-example-basic-multiple").val(myArr).trigger("change");

    btn.prop("disabled", false);
    btn.html("Add/Update Deduction");
    ShowUpdateRatingStar(
        response.planning_coordination,
        $(".planning_star_rating > span")
    );
    ShowUpdateRatingStar(
        response.quality_work,
        $(".quality_star_rating > span")
    );
    ShowUpdateRatingStar(
        response.communication_skill,
        $(".communication_star_rating > span")
    );
    ShowUpdateRatingStar(
        response.overall_rating,
        $(".overall_rating_star > span")
    );
    ShowUpdateRatingStar(
        response.time_managment,
        $(".time_star_rating > span")
    );
}

$("#add_evaluation").on("hidden.bs.modal", function () {
    // do something…
    $("[name=evaluation_id]").remove();
    $("[name=created_at]").remove();
    $(this).find("form").trigger("reset");
    $(this).find("select").trigger("change");
    var text = $("span").text();
    $(".star > span").html("☆");
});

function ShowUpdateRatingStar(rating, stars) {
    var len = rating;
    for (var i = 0; i < len; i++) {
        if (i < rating) {
            stars[i].innerHTML = "★";
        } else {
            stars[i].innerHTML = "☆";
        }
    }
}
