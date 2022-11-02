const dtColumns = [
    { title: "Name", data: "name" },
    {title:'Assign employees',
    render: function (data, type, row, meta) {
        return (
            '<a href="javascript:void(0)" class="addMembers mt-2 btn btn-info btn-sm" data-toggle="tooltip" title="Edit Project" data-id="' +row.id+'" data-table="teamlead-table" data-modal="teamMembers" data-original-title="Update Record">Team Members</a>'
        );
    },
    orderable: false,
    searchable: false,
    },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Project" data-id="' +
                data +
                '" data-table="teamlead-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' 
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("teamlead-table", dtColumns);


