const dtColumns = [
    { title: "Employee Name", data: "name" },
    { title: "Employee Primary Email", data: "email" },
    { title: "Employee Secondary Email", data: "secondary_email" },
    {
        title: "Action",
        render: function (data, type, row, meta) {
            if (row.role != "admin") {
                return (
                    '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Employee Account" data-id="' +
                    row.id +
                    '" data-table="emhr-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>'
                );
            } else {
                return '<span class="badge badge-danger bx-flashing">Cannot delete admin account.</span>';
            }
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("emhr-table", dtColumns);
