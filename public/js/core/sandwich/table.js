const dtColumns = [
    { title: "Added By", data: "user.name" },
    { title: "Name", data: "name" },
    { title: "Date", data: "date" },
    { title: "Status", data: "status",
    render: function (data, type, row, meta) {
        if(data == 1) {
            return '<span class="badge badge-success">Active</span>';
        }else{
            return '<span class="badge badge-danger">In Active</span>';
        }
    }
     },
    { title: "Added time", data: "created_at" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title=" sand-wich" data-id="' +
                data +
                '" data-table="sandwich-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" class="update2 mt-2 btn btn-info btn-sm" data-toggle="tooltip" title="Edit sand-wich" data-id="' +
                data +
                '" data-table="sandwich-table" data-modal="add_sandwichRule" data-original-title="Update Record"><i class="fa fa-edit" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("sandwich-table", dtColumns);
