const dtColumns = [
    { title: "Designation Name", data: "name" },
    { title: "Parent Designation Name", data: "parent_designation.name" },
    { title: "Max. Salary", data: "max_salary" },
    { title: "Min. Salary", data: "min_salary" },
    {
        title: "Status",
        data: "status",
        render: function (data, type, row, meta) {
            return data === "active"
                ? '<span class="badge badge-success">' + data + "</span>"
                : '<span class="badge badge-info">' + data + "</span>";
        },
    },
    { title: "Added by", data: "owner.name" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip"  data-id="' +
                data +
                '" data-table="designations-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("designations-table", dtColumns);
