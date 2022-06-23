let btn = $(".submit-btn");

$("#addEmployeeSalarySlip").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Adding Salary Slip...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "ssCallback",
            "ss-errors-print",
            ""
        );
    }
});

function ssCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add Salary Slip");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr(
            "success",
            "Please wait for system to redirect...",
            "Action Successful. 😃"
        );
        successFlow(
            errorClassName,
            "Slip generated successfully. Please wait...",
            "bg-success"
        );
        window.location.href = response.response;
    } else if (response.status == 409) {
        makeToastr(
            "error",
            response.responseJSON.response,
            "Exception occured 😢"
        );
    } else successFlow(errorClassName, response.response, "bg-danger");
}

//Create PDf from HTML...
function download() {
    $(".print-btn").addClass("d-none");
    $(".loader-btn").removeClass("d-none");
    var HTML_Width = $(".html-content").width();
    var HTML_Height = $(".html-content").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + top_left_margin * 2;
    var PDF_Height = PDF_Width * 1.5 + top_left_margin * 2;
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".html-content")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF("p", "pt", [PDF_Width, PDF_Height]);
        pdf.addImage(
            imgData,
            "JPG",
            top_left_margin,
            top_left_margin,
            canvas_image_width,
            canvas_image_height
        );
        for (var i = 1; i <= totalPDFPages; i++) {
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(
                imgData,
                "JPG",
                top_left_margin,
                -(PDF_Height * i) + top_left_margin * 4,
                canvas_image_width,
                canvas_image_height
            );
        }
        pdf.save(fileName + ".pdf");

        $(".print-btn").removeClass("d-none");
        $(".loader-btn").addClass("d-none");
        // $(".html-content").hide();
    });
}

$(function () {
    var deducts = [];
    $(".deduct").each(function () {
        var sd = $(this)
            .html()
            .replace(/[^0-9]/gi, ""); // Replace everything that is not a number with nothing
        var number = parseInt(sd, 10);
        deducts.push(number);
    });
    var earnings = [];
    $(".earned").each(function () {
        var sd = $(this)
            .html()
            .replace(/[^0-9]/gi, ""); // Replace everything that is not a number with nothing
        var number = parseInt(sd, 10);
        earnings.push(number);
    });
    let numOr0 = (n) => (isNaN(n) ? 0 : n);
    if (
        earnings != undefined &&
        earnings.length != 0 &&
        deducts != undefined &&
        deducts.length != 0
    ) {
        // let totalEarning = earnings.reduce((a, b) => numOr0(a) + numOr0(b));
        let totalDeduction = deducts.reduce((a, b) => numOr0(a) + numOr0(b));
        let netTotal = $(".earning-result-r").html();
        // $(".earning-result").html(totalEarning);
        $(".deduction-result").html(totalDeduction);
        $(".net-total")
            .html(
                "Net total : " +
                    netTotal +
                    " RS " +
                    number2words(netTotal) +
                    " Only/-"
            )
            .addClass("bx-flashing text-capitalize");
    }
});

var num =
    "zero one two three four five six seven eight nine ten eleven twelve thirteen fourteen fifteen sixteen seventeen eighteen nineteen".split(
        " "
    );
var tens = "twenty thirty forty fifty sixty seventy eighty ninety".split(" ");

function number2words(n) {
    if (n < 20) return num[n];
    var digit = n % 10;
    if (n < 100) return tens[~~(n / 10) - 2] + (digit ? "-" + num[digit] : "");
    if (n < 1000)
        return (
            num[~~(n / 100)] +
            " hundred" +
            (n % 100 == 0 ? "" : " " + number2words(n % 100))
        );
    return (
        number2words(~~(n / 1000)) +
        " thousand" +
        (n % 1000 != 0 ? " " + number2words(n % 1000) : "")
    );
}
