$(document).ready(function () {
    // Bar Chart

    Morris.Bar({
        element: "bar-charts",
        data: data,
        xkey: "y",
        ykeys: ["a", "b"],
        labels: ["Total Tasks", "Tasks Completed"],
        lineColors: ["#f43b48", "#453a94"],
        lineWidth: "3px",
        barColors: ["#f43b48", "#453a94"],
        resize: true,
        redraw: true,
    });
});
