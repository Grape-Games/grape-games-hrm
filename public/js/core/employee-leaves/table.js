const dtColumns = [
    {
        title: "Leave Type",
        render: function (data, type, row, meta) {
            let approval;
            row.type == undefined || row.type == null
                ? (approval = "Not specified")
                : (approval = row.type.name);
            return approval;
        },
    },
    // { title: "Total Leaves", data: "number_of_leaves" }, 
    { title: "From", data: "from_date" },
    { title: "To", data: "to_date" },
    { title: "Total Leaves", data: "number_of_leaves" },
    { title: "Description", data: "description" },
    {
        title: "Remarks",
        data: "remarks",
        render: function (data, type, row, meta) {
            if (data == undefined || data == "" || data == null)
                return "Waiting for response...";
            return data;
        },
    },
    {
        title: "Status",
        data: "status",
        render: function (data, type, row, meta) {
            let classNam = "";
            data == "pending"
                ? (classNam = "badge-warning")
                : data == "approved"
                    ? (classNam = "badge-success")
                    : (classNam = "badge-danger");
            return (
                '<span class="text-capitalize badge ' +
                classNam +
                '">' +
                data +
                "</span>"
            );
        },
    },
    {
        data: "approved_by",
        title: "Approved/Disapproved By",
        render: function (data, type, row, meta) {
            let approval;
            data == undefined || data == null
                ? (approval = "Waiting for someones response...")
                : (approval = data.name);
            return approval;
        },
    },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm mr-2 mt-1" data-toggle="tooltip" title="Delete Employee Leave"  data-id="' +
                data +
                '" data-table="el-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("el-table", dtColumns);
