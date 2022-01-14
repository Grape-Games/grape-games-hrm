$(".employees-results-table").DataTable({
    dom: "Bfrtip",
    buttons: [
        {
            extend: "excelHtml5",
            className: "btn btn-danger",
        },
        {
            extend: "csvHtml5",
            className: "btn btn-secondary",
        },
        {
            extend: "pdfHtml5",
            className: "btn btn-info",
        },
    ],
});
