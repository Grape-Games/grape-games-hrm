const dtColumns = [
    { title: "Leave Type", data: "type.name" },
    { title: "Total Leaves", data: "number_of_leaves" },
    { title: "From", data: "from_date" },
    { title: "To", data: "to_date" },
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
];

makeDT("el-table", dtColumns);
