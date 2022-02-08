const dtColumns = [
    {
        title: "Employee Name",
        render: function (data, type, row, meta) {
            if (row.employee != null) {
                return (row.employee.first_name + ' ' + row.employee.last_name);
            } else {
                return ('No Name found');
            }
        },
    },
    { title: "Month", data: "month" },
    { title: "Punch Time", data: "date" },
    { title: "Minutes Late", data: "minutes" },
    { title: "Lates Type", data: "type", className: "text-capitalize" },
    {
        title: "Added by",
        render: function (data, type, row, meta) {
            if (row.owner != null)
                return row.owner.name
            return 'System Generated'
        }
    },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Late Minutes"  data-id="' +
                data +
                '" data-table="lm-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

var url_string = window.location.href
var url = new URL(url_string);
var c = url.searchParams.get("month");

makeDT("lm-table", dtColumns);
