const dtColumns = [
    { title: "Company Name", data: "name" },
    { title: "Branch Name", data: "branch_name" },
    { title: "Time In", data: "time_in" },
    { title: "Time Out", data: "time_out" },
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
                '" data-table="companies-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("companies-table", dtColumns);
