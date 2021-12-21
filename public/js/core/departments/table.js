const dtColumns = [
    { title: "Department Name", data: "name" },
    { title: "Branch Name", data: "branch_name" },
    { title: "Time In", data: "time_in" },
    { title: "Time Out", data: "time_out" },
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
                '" data-table="department-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("departments-table", dtColumns);
