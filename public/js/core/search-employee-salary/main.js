$(".search-company").click(function (e) {
    e.preventDefault();
    $(this).valid() ? $("#searchEmployees").submit() : "";
});

$(function () {
    const d = new Date();
    $("[name=dated]").val(d.toISOString().slice(0, 19).replace("T", " "));
});

$(".gen-slip-fin").click(function (e) {
    e.preventDefault();
    $("[name=per_day]").val(
        $(this).data("per_day") ? $(this).data("per_day") : ""
    );
    $("[name=per_hour]").val(
        $(this).data("per_hour") ? $(this).data("per_hour") : ""
    );
    $("[name=per_minute]").val(
        $(this).data("per_minute") ? $(this).data("per_minute") : ""
    );
    $("[name=basic_salary]").val(
        $(this).data("basic_salary") ? $(this).data("basic_salary") : ""
    );
    $("[name=house_allowance]").val(
        $(this).data("house_allowance") ? $(this).data("house_allowance") : ""
    );
    $("[name=mess_allowance]").val(
        $(this).data("mess_allowance") ? $(this).data("mess_allowance") : ""
    );
    $("[name=travelling_allowance]").val(
        $(this).data("travelling_allowance")
            ? $(this).data("travelling_allowance")
            : ""
    );
    $("[name=medical_allowance]").val(
        $(this).data("medical_allowance")
            ? $(this).data("medical_allowance")
            : ""
    );
    $("[name=employee_id]").val($(this).data("id"));
});


