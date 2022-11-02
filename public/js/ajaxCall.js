// This is the cusom ajax call that works for all cases
// settings csrf for POST reqs

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function dynamicAjax(url, method, data, callBackFunc, arg2, arg3) {
    $.ajax({
        url: url,
        method: method,
        contentType: false,
        processData: false,
        data: data,
        dataType: "json",
        beforeSend: function () { },
        success: function (response) {
            // console.log("success");
            // console.log(response);
            window[callBackFunc](response, arg2, arg3);
        },
        error: function (response) {
            // console.log("error");
            // console.log(response);
            window[callBackFunc](response, arg2);
        },
        complete: function () {
            // $(".modal").modal("hide");
        },
    });
}
