const dtColumns = [
    { title: "First Name", data: "employee.first_name" },
    { title: "Last Name", data: "employee.last_name" },
    { title: "Added_by", data: "user.name" },
    { title: "Month", data: "month" },
    {
        title: "Planning Coordination",
        data: "planning_coordination",
        render: function (data, type, row, meta) {
            return SetStar(data);
        },
        orderable: false,
        searchable: false,
    },
    {
        title: "Quality Work",
        data: "quality_work",
        render: function (data, type, row, meta) {
            return SetStar(data);
        },
        orderable: false,
        searchable: false,
    },
    {
        title: "Communication Skill",
        data: "communication_skill",
        render: function (data, type, row, meta) {
            return SetStar(data);
        },
        orderable: false,
        searchable: false,
    },
    {
        title: "Confidence Level",
        data: "confidence_level",
        render: function (data, type, row, meta) {
            return SetStar(data);
        },
        orderable: false,
        searchable: false,
    },
    {
        title: "Time Managment",
        data: "time_managment",
        render: function (data, type, row, meta) {
            return SetStar(data);
        },
        orderable: false,
        searchable: false,
    },
    { title: "Additional Comments", data: "additional_comments" },
    { title: "Over all Performance", data: "over_all_performance" },
    { title: "Area of Improvements", data: "area_of_improvements" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-toggle="tooltip" title="evaluation" data-id="' +
                data +
                '" data-table="evaluation-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" class="update2 mt-2 btn btn-info btn-sm" data-toggle="tooltip" title="Edit Evaluation" data-id="' +
                data +
                '" data-table="evaluation-table" data-modal="add_evaluation" data-original-title="Update Record"><i class="fa fa-edit" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("evaluation-table", dtColumns);

function SetStar(stars) {
    if (stars == 1) {
        return "★☆☆☆☆";
    } else if (stars == 2) {
        return "★★☆☆☆";
    } else if (stars == 3) {
        return "★★★☆☆";
    } else if (stars == 4) {
        return "★★★★☆";
    } else if (stars == 5) {
        return "★★★★★";
    } else {
        return "☆☆☆☆☆";
    }
}
