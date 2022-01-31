// to print validation error messages

function validationPrint(response, errorsClassName) {
    $("." + errorsClassName).removeClass(
        "text-center text-white badge bg-success bg-danger"
    );
    $("." + errorsClassName).show();
    var html =
        '<div class="mb-4">' +
        "<strong class='text-danger'>Whoops! Something went wrong.</strong>" +
        '<ul class="mt-1 list-disc list-inside text-sm text-danger ul-class">';
    $.each(
        response.responseJSON.errors,
        function (indexInArray, valueOfElement) {
            html += "<li>" + valueOfElement + "</li>";
            makeToastr("error", valueOfElement, "Validation Error 😒");
        }
    );
    html += "</ul></div>";
    $("." + errorsClassName).html(html);
}

function successFlow(errorsClassName, html, back) {
    var element = $("." + errorsClassName);
    element
        .removeClass("text-danger")
        .addClass("text-center text-white badge " + back);
    element.html(
        '<p class="mt-4 mb-4"><strong class="h4 text-white">' +
            html +
            " 😉</strong></p>"
    );
    element.fadeIn("slow");
    element.css("display", "block");
    setTimeout(() => {
        element.fadeOut("slow");
    }, 3000);
}

function makeToastr(type, msg, heading) {
    toastr[type](msg, heading, {
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
    });
}

function refreshDivByid(elementId) {
    $("#" + elementId).load(" #" + elementId);
}

function refreshNotficationDivs() {
    refreshDivByid("notifyPill1");
    refreshDivByid("notifications");
}

function handleTickInit(tick) {
    var counter = Tick.count.schedule("every hour", {
        format: ["m", "s"],
    });
    counter.onupdate = function (value) {
        tick.value = value;
    };
}
