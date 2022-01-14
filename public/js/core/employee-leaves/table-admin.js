const dtColumns = [
    { title: "Leave Type", data: "type.name" },
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
                '<div class="dropdown">' +
                '<button class="btn ' +
                classNam +
                ' dropdown-toggle text-capitalize" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                data +
                " </button>" +
                '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">' +
                '  <a data-id="' +
                row.id +
                '" class="dropdown-item" data-target="#commentsModal" data-toggle="modal" data-value="approved" href="#">Approve</a>' +
                '  <a data-id="' +
                row.id +
                '" class="dropdown-item" data-target="#commentsModal" data-toggle="modal" data-value="rejected" href="#">Reject</a>' +
                " </div>" +
                "</div>"
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