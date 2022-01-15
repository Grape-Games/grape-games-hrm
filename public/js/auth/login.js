// login form js

$("#loginForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        $(".d-first").addClass("d-none");
        $(".d-second").removeClass("d-none");
        this.submit();
    }
});
