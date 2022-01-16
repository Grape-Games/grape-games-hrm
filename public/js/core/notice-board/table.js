const dtColumns = [
    { title: "Details", data: "details" },
    {
        title: "Priority",
        data: "priority",
        render: function (data, type, row, meta) {
            if (data === "high")
                return (
                    '<span class="badge badge-danger text-capitalize">' +
                    data +
                    "</span>"
                );
            else if (data == "medium")
                return (
                    '<span class="badge badge-warning text-capitalize">' +
                    data +
                    "</span>"
                );
            else
                return (
                    '<span class="badge badge-success text-capitalize">' +
                    data +
                    "</span>"
                );
        },
    },
    { title: "Added By", data: "owner.name" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Notice"  data-id="' +
                data +
                '" data-table="nb-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("nb-table", dtColumns);
