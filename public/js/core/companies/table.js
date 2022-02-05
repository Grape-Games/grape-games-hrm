const dtColumns = [
    { title: "Company Name", data: "name" },
    { title: "Branch Name", data: "branch_name" },
    { title: "Time In", data: "time_in" },
    { title: "Time Out", data: "time_out" },
    { title: "Grace Minutes", data: "grace_minutes" },
    {
        title: "Late Minutes Deduction",
        data: "late_minutes_deduction",
        render: function (data, type, row, meta) {
            if (data == 0) return "No";
            return "Yes";
        },
    },
    {
        title: "Departments",
        data: "departments",
        render: function (data, type, row, meta) {
            var values = "";
            $.each(data, function (indexInArray, valueOfElement) {
                values +=
                    "<p>" +
                    valueOfElement.type.name +
                    "</p>" +
                    '<a href="javascript:void(0)" class="delete2 btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Department from Company" data-id="' +
                    valueOfElement.id +
                    '" data-table="companies-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>';
            });
            return values;
        },
    },
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
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Company" data-id="' +
                data +
                '" data-table="companies-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" class="update2 mt-2 btn btn-info btn-sm" data-toggle="tooltip" title="Edit Company" data-id="' +
                data +
                '" data-table="companies-table" data-modal="add_company" data-original-title="Update Record"><i class="fa fa-edit" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("companies-table", dtColumns);
