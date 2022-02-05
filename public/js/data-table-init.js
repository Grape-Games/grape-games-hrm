function makeDT(classNme, columnDefs) {
    $("." + classNme).DataTable({
        processing: true,
        serverSide: true,
        ajax: window.location.href,
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
