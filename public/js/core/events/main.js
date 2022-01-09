// deaprtment type js

let btn = $(".submit-btn");
let btn1 = $(".delete-event");
let btn2 = $(".update-event");
let btn3 = $(".save-event");

$("#addEventForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Event...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "evCallback",
            "ev-errors-print",
            ""
        );
    }
});

function evCallback(response, errorClassName) {
    btn.prop("disabled", false);
    btn.html("Add Event");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        location.reload();
    } else if (response.status == 409) {
        makeToastr(
            "error",
            response.responseJSON.response,
            "Exception occured 😢"
        );
    } else successFlow(errorClassName, response.response, "bg-danger");
}

$("body").on("click", ".delete-event", function () {
    btn1.prop("disabled", true);
    btn1.html("Deleting Event...");
    $.ajax({
        type: "POST",
        url: deleteEventRoute,
        data: { id: $("[name=sid]").val() },
        dataType: "json",
        success: function (response) {
            makeToastr("success", response.response, "Action Successful. 😃");
        },
        error: function (response) {
            console.log(response);
            if (response.status == 409 || response.status == 400) {
                makeToastr(
                    "error",
                    response.responseJSON.response,
                    "Exception occured 😢"
                );
            } else {
                makeToastr("error", response.statusText, "Error occured 😢");
            }
        },
        complete: function () {
            btn1.prop("disabled", false);
            btn1.html("Delete");
        },
    });
});

$("body").on("click", ".update-event", function () {
    btn2.prop("disabled", true);
    btn2.html("Updating Event...");
    $.ajax({
        type: "POST",
        url: updateEventRoute,
        data: { id: $("[name=sid]").val(), name: $("[name=sname]").val() },
        dataType: "json",
        success: function (response) {
            makeToastr("success", response.response, "Action Successful. 😃");
        },
        error: function (response) {
            console.log(response);
            if (response.status == 409 || response.status == 400) {
                makeToastr(
                    "error",
                    response.responseJSON.response,
                    "Exception occured 😢"
                );
            } else {
                makeToastr("error", response.statusText, "Error occured 😢");
            }
        },
        complete: function () {
            btn2.prop("disabled", false);
            btn2.html("Save");
        },
    });
});

$("body").on("click", ".save-event", function () {
    var title = $("[name='title']").val();
    if (title !== null && title.length != 0) {
        btn3.prop("disabled", true);
        btn3.html("Creating Event...");
        var start = $("[name=start_time2]").val();
        var end = $("[name=end_time2]").val();
        var start_time = new Date(start).toISOString().slice(0, 10);
        var end_time = new Date(end).toISOString().slice(0, 10);
        $.ajax({
            type: "POST",
            url: createEventRoute,
            data: {
                name: $("[name=title]").val(),
                start_time: start_time,
                end_time: end_time,
                category: $("[name=category]").val(),
            },
            dataType: "json",
            success: function (response) {
                makeToastr(
                    "success",
                    response.response,
                    "Action Successful. 😃"
                );
            },
            error: function (response) {
                console.log(response);
                if (response.status == 409 || response.status == 400) {
                    makeToastr(
                        "error",
                        response.responseJSON.response,
                        "Exception occured 😢"
                    );
                } else {
                    makeToastr(
                        "error",
                        response.statusText,
                        "Error occured 😢"
                    );
                }
            },
            complete: function () {
                btn3.prop("disabled", false);
                btn3.html("Create Event");
            },
        });
    } else {
        $("[name=title]").addClass("is-invalid error").removeClass("is-valid");
    }
});
$("body").on("keyup", "[name=title]", function () {
    $(this).val() != null && $(this).val().length != 0
        ? $(this).removeClass("is-invalid error").addClass("is-valid")
        : $(this).addClass("is-invalid error");
});
