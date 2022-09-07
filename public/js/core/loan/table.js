const dtColumns = [
    { title: "First Name", data: "employee.first_name" },
    { title: "Last Name", data: "employee.last_name" },
    { title: "Added_by", data: "user.name" },
    { title: "Loan Name", data: "name" },
    { title: "Loan Amount", data: "amount" },
    { title: "Number of Installment", data: "number_installment" },
    { title: "Added time", data: "created_at" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Loan" data-id="' +
                data +
                '" data-table="loan-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" class="update2 mt-2 btn btn-info btn-sm" data-toggle="tooltip" title="Edit Loan" data-id="' +
                data +
                '" data-table="loan-table" data-modal="add_loan" data-original-title="Update Record"><i class="fa fa-edit" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("loan-table", dtColumns);
