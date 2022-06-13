var globalDtObj;
function makeDT(classNme, columnDefs, route = "") {
    $("." + classNme).DataTable({
        order: [],
        processing: true,
        serverSide: true,
        ajax: route == "" ? window.location.href : window.location.href + route,
        columns: columnDefs,
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excelHtml5",
                className: "btn btn-danger",
                exportOptions: {
                    stripHtml: false,
                    format: {
                        body: function (data, row, column, node) {
                            noSpace = data.replace(/ /g, "")
                            noTags = noSpace.replace(/<\/?[^>]+(>|$)/g, "")
                            return noTags.replace(/<br\s*\/?>/gi, "\r\n");
                        },
                    },
                },
            },
            {
                extend: "csvHtml5",
                className: "btn btn-secondary",
            },
            {
                extend: "pdfHtml5",
                className: "btn btn-info",
                orientation: "landscape",
                pageSize: "A0",
                // exportOptions: {
                //     columns: ":not(:last-child)",
                // },
            },
        ],
    });
}

function makeDTnAjax(classNme, pageSize = "A0") {
    globalDtObj = $("." + classNme).DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excelHtml5",
                className: "btn btn-danger",
                exportOptions: {
                    stripHtml: false,
                    format: {
                        body: function (data, row, column, node) {
                            noSpace = data.replace(/ /g, "")
                            noTags = noSpace.replace(/<\/?[^>]+(>|$)/g, "")
                            return noTags.replace(/<br\s*\/?>/gi, "\r\n");
                        },
                    },
                },
            },
            {
                extend: "csvHtml5",
                className: "btn btn-secondary",
            },
            {
                extend: "pdfHtml5",
                className: "btn btn-info",
                orientation: "landscape",
                pageSize: pageSize,
                exportOptions: {
                    stripHtml: false,
                    format: {
                        body: function (data, row, column, node) {
                            noSpace = data.replace(/ /g, "")
                            noTags = noSpace.replace(/<\/?[^>]+(>|$)/g, "")
                            return noTags.replace(/<br\s*\/?>/gi, "\r\n");
                        },
                    },
                },
                // exportOptions: {
                //     columns: ":not(:last-child)",
                // },
            },
        ],
    });
}

function makeDTnAjaxCols(classNme, pageSize = "A0", cols=[]) {
    $("." + classNme).DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excelHtml5",
                className: "btn btn-danger",
                exportOptions: {
                    stripHtml: false,
                    columns:cols,
                    format: {
                        body: function (data, row, column, node) {
                            noSpace = data.replace(/ /g, "")
                            noTags = noSpace.replace(/<\/?[^>]+(>|$)/g, "")
                            return noTags.replace(/<br\s*\/?>/gi, "\r\n");
                        },
                    },
                },
            },
            {
                extend: "csvHtml5",
                className: "btn btn-secondary",
            },
            {
                extend: "pdfHtml5",
                className: "btn btn-info",
                orientation: "landscape",
                pageSize: pageSize,
                exportOptions: {
                    stripHtml: false,
                    columns:cols,
                    format: {
                        body: function (data, row, column, node) {
                            noSpace = data.replace(/ /g, "")
                            noTags = noSpace.replace(/<\/?[^>]+(>|$)/g, "")
                            return noTags.replace(/<br\s*\/?>/gi, "\r\n");
                        },
                    },
                },
                // exportOptions: {
                //     columns: ":not(:last-child)",
                // },
            },
        ],
    });
}
