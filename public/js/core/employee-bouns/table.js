const dtColumns = [
    { title: "First Name", data: "employee.first_name" },
    { title: "Last Name", data: "employee.last_name" },
    { title: "Added_by", data: "user.name" },
    { title: "Bonus Name", data: "bouns_name" },
    { title: "Bonus Amount", data: "amount" },
    { title: "Bonus Month", data: "month" },
    { title: "Added time", data: "created_at" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Employee Bouns" data-id="' +
                data +
                '" data-table="employee-bouns-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" class="update2 mt-2 btn btn-info btn-sm" data-toggle="tooltip" title="Edit Employee Bouns" data-id="' +
                data +
                '" data-table="employee-bouns-table" data-modal="add_employee_bouns" data-original-title="Update Record"><i class="fa fa-edit" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("employee-bouns-table", dtColumns);
