const dtColumns = [
    {
        title: "Name",
        render: function (data, type, row, meta) {
            return row.first_name + " " + row.last_name;
        },
    },
    { title: "CNIC", data: "cnic" },
    { title: "Father Name", data: "father_name" },
    { title: "Registration No", data: "registration_no" },
    { title: "Enrollment No", data: "enrollment_no" },
    { title: "Company", data: "company.name" },
    { title: "Designation", data: "designation.name" },
    { title: "Email Address", data: "email_address" },
    { title: "Primary Contact", data: "primary_contact" },
    { title: "City", data: "city" },
    { title: "Gender", data: "gender" },
    { title: "Added by", data: "owner.name" },
    {
        data: "id",
        title: "Action",
        render: function (data, type, row, meta) {
            return (
                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm mr-2 mt-1" data-toggle="tooltip" title="Delete Employee"  data-id="' +
                data +
                '" data-table="employees-table" data-original-title="Delete Record"><i class="fa fa-trash bx-tada" aria-hidden="true"></i></a>' +
                '<a href="' +
                window.location.href +
                "/" +
                data +
                '/edit" class="update btn btn-info btn-sm mx-auto mt-1" data-toggle="tooltip" title="Edit Employee" data-original-title="Update Record">' +
                '<i class="fa fa-edit bx-tada" aria-hidden="true"></i></a>'
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("employees-table", dtColumns);
