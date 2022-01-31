const dtColumns = [
    { title: "Leave Type", data: "name" },
    {
        title: "Status",
        data: "status",
        render: function (data, type, row, meta) {
            return data === "active"
                ? '<span class="badge badge-success">' + data + "</span>"
                : '<span class="badge badge-info">' + data + "</span>";
        },
    },
    { title: "Allowed Leave", data: "allowed" },
    { title: "Time Span", data: "time_span",className:"text-capitalize" },
    { title: "Added by", data: "owner.name" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Leave Type"  data-id="' +
                data +
                '" data-table="lv-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("lv-table", dtColumns);
