function makeDT(classNme, columnDefs, route = "") {
    $("." + classNme).DataTable({
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
                    columns: ":not(:last-child)",
                },
            },
            {
                extend: "csvHtml5",
                className: "btn btn-secondary",
            },
            {
                extend: "pdfHtml5",
                className: "btn btn-info",
                exportOptions: {
                    columns: ":not(:last-child)",
                },
            },
        ],
    });
}
