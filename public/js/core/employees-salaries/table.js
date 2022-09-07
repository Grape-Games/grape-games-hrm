const salaryArray = [];
var uniqueElements;

const dtColumns = [
    {
        title: "Employee Name",
        render: function (data, type, row, meta) {
            return row.first_name + " " + row.last_name;
        },
    },
    { title: "Added by", data: "owner.name" },
    { title: "Company Name", data: "company.name" },
    {
        title: "More",
        render: function (data, type, row, meta) {
            return (
                '<button class="btn btn-success btn-sm mx-auto mt-1 incrementDetail" data-id="' +
                row.id +
                '" data-title="' +
                row.first_name +
                " " +
                row.last_name +
                '"data-toggle="modal" data-target="#IncementSheetView" title="Generate Employee Salary Slip">' +
                '<i class="fa fa-eye" aria-hidden="true"></i></button>'
            );
        },
    },
    {
        data: "id",
        title: "Set Salary",
        render: function (data, type, row, meta) {
            let status = "";
            if (row.salary_formula == undefined || row.salary_formula == null)
                status =
                    '<span class="badge badge-danger ml-2 bx-flashing">Not Set</span>';
            else {
                var obj = {};
                obj.id = row.id;
                obj.per_day = row.salary_formula.per_day;
                obj.per_hour = row.salary_formula.per_hour;
                obj.per_minute = row.salary_formula.per_minute;
                obj.basic_salary = row.salary_formula.basic_salary;
                obj.house_allowance = row.salary_formula.house_allowance;
                obj.mess_allowance = row.salary_formula.mess_allowance;
                obj.travelling_allowance =
                    row.salary_formula.travelling_allowance;
                obj.medical_allowance = row.salary_formula.medical_allowance;
                salaryArray.push(obj);
                uniqueElements = salaryArray.reduce((acc, item) => {
                    if (!acc.find((other) => item.id == other.id)) {
                        acc.push(item);
                    }
                    return acc;
                }, []);
                status =
                    '<span class="badge badge-success ml-2 bx-flashing">Already Set</span>';
            }
            return (
                '<button class="btn btn-info btn-sm mx-auto mt-1 gen-slip" data-id="' +
                data +
                '"  data-toggle="modal" data-target="#add_salary_formula" title="Generate Employee Salary Slip">' +
                '<i class="fa fa-print bx-tada" aria-hidden="true"></i></button>' +
                status
            );
        },
        orderable: false,
        searchable: false,
    },
];

makeDT("esf-table", dtColumns);
