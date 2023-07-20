$("body").on("click", ".delete", function () {
    var id = $(this).data("id");
    var table = $(this).data("table");
    Swal.fire({
        title: "Are you sure to delete ?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-outline-danger ms-1",
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            console.log(window.location.href);
            // ajax
            $.ajax({
                type: "DELETE",
                url: window.location.href + "/" + id,
                dataType: "json",
                success: function (response) {
                    makeToastr(
                        "success",
                        response.response + " 👌",
                        "Action Successful."
                    );
                    var oTable = $("." + table).dataTable();
                    oTable.fnDraw(false);
                },
                error: function (response) {
                    makeToastr(
                        "error",
                        response.responseJSON.response + " 😭",
                        "Action Failed."
                    );
                },
            });
        }
    });
});

$("body").on("click", ".delete2", function () {
    var id = $(this).data("id");
    var table = $(this).data("table");
    Swal.fire({
        title: "Are you sure to delete ?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-outline-danger ms-1",
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            // ajax
            $.ajax({
                type: "DELETE",
                url: window.location.href + "/dept/" + id,
                dataType: "json",
                success: function (response) {
                    console.log("success");
                    makeToastr(
                        "success",
                        response.response + " 👌",
                        "Action Successful."
                    );
                    var oTable = $("." + table).dataTable();
                    oTable.fnDraw(false);
                },
                error: function (response) {
                    console.log(response);
                    makeToastr(
                        "error",
                        response.responseJSON.response + " 😭",
                        "Action Failed."
                    );
                },
            });
        }
    });
});

$("body").on("click", ".delete-lv", function () {
    var id = $(this).data("id");
    var method = $(this).data("method");

    Swal.fire({
        title: "Are you sure to delete ?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-outline-danger ms-1",
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            Livewire.emit(method, id);
        }
    });
});
