const dtColumns = [
    {
        title: "Employee Name",
        render: function (data, type, row, meta) {
            return row.first_name + " " + row.last_name;
        },
    },
    { title: "Added by", data: "owner.name" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<button class="btn btn-info btn-sm mx-auto mt-1 gen-slip" data-id="' +
                data +
                '"  data-toggle="modal" data-target="#add_salary_formula" title="Generate Employee Salary Slip">' +
                '<i class="fa fa-print bx-tada" aria-hidden="true"></i></button>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("esf-table", dtColumns);
