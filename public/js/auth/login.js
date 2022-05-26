// login form js

$("#loginForm").submit(function (e) {
    e.preventDefault();
    if ($(this).valid()) {
        $(".d-first").addClass("d-none");
        $(".d-second").removeClass("d-none");
        this.submit();
    }
});
