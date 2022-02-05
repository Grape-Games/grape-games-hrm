const dtColumns = [
    { title: "Holiday Details", data: "details" },
    { title: "Holiday Date", data: "date" },
    { title: "Added by", data: "owner.name" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Holiday"  data-id="' +
                data +
                '" data-table="hd-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("hd-table", dtColumns);
