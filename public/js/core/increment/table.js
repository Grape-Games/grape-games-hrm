const dtColumns = [
    { title: "First Name", data: "employee.first_name" },
    { title: "Last Name", data: "employee.last_name" },
    { title: "Added_by", data: "user.name" },
    { title: "Increment Amount", data: "amount" },
    { title: "Month", data: "month" },
    { title: "Added time", data: "created_at" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Increment" data-id="' +
                data +
                '" data-table="increment-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" class="update2 mt-2 btn btn-info btn-sm" data-toggle="tooltip" title="Edit Increment" data-id="' +
                data +
                '" data-table="increment-table" data-modal="add_new_increment" data-original-title="Update Record"><i class="fa fa-edit" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("increment-table", dtColumns);
