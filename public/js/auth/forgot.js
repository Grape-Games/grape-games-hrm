// forgot form js

$("#forgotForm").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        makeToastr(
            "info",
            "Please wait we are trying to send you a reset link...",
            "Password Reset 🔏"
        );
        this.submit();
    }
});
