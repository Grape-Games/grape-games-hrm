// login form js

$("#loginForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    $(".d-first").addClass("d-none");
    $(".d-second").removeClass("d-none");
    obj.valid() ? this.submit() : "";
});
