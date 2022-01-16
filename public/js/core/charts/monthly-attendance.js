const d = new Date();
let month = d.getMonth();
var myConfig = {
    type: "calendar",
    options: {
        endMonth: month,
        year: {
            visible: false,
        },
        weekday: {
            values: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            item: {
                fontFamily: "CircularStd",
                fontSize: 12,
            },
        },
        day: {
            items: {
                "d-2022-01-04": {
                    backgroundColor: "#55ce63",
                },
            },
            inactive: {
                backgroundColor: "lightgrey",
            },
        },
        values: [
            ["2022-01-04", 1, "P"],
            ["2022-01-03", 1, "A"],
            ["2022-01-05", 3],
            ["2022-01-06", 4],
            ["2022-01-07", 9],
            ["2022-01-11", 5],
            ["2022-01-12", 5],
            ["2022-01-13", 9],
            ["2022-01-14", 9],
            ["2022-01-18", 4],
            ["2022-01-20", 5],
            ["2022-01-21", 6],
            ["2022-01-25", 5],
            ["2022-01-26", 9],
            ["2022-01-27", 6],
            ["2022-01-28", 6],
        ],
    },
    plotarea: {
        marginTop: "0%",
        marginBottom: "0%",
    },
    tooltip: {
        text: "%data-day",
    },
    plot: {
        valueBox: {
            text: "%data-info0",
        },
    },
};

zingchart.loadModules("calendar", function () {
    zingchart.render({
        id: "myChart",
        data: myConfig,
        height: 400,
        width: "100%",
    });
});
