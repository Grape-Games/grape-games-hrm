const dtColumns = [
    { title: "Device Name", data: "name" },
    { title: "IP address", data: "ip_address" },
    { title: "Description", data: "description" },
    { title: "Internal ID", data: "internal_id" },
    { title: "Added by", data: "owner.name" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Biometric Device" data-id="' +
                data +
                '" data-table="bd-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("bd-table", dtColumns);
