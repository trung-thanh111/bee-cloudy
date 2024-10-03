function getChartColorsArray(r) {
    if (null !== document.getElementById(r)) {
        var t =
                "data-colors" +
                ("-" + document.documentElement.getAttribute("data-theme") ??
                    ""),
            t =
                document.getElementById(r).getAttribute(t) ??
                document.getElementById(r).getAttribute("data-colors");
        if (t)
            return (t = JSON.parse(t)).map(function (r) {
                var t = r.replace(" ", "");
                return -1 === t.indexOf(",")
                    ? getComputedStyle(
                          document.documentElement
                      ).getPropertyValue(t) || t
                    : 2 == (r = r.split(",")).length
                    ? "rgba(" +
                      getComputedStyle(
                          document.documentElement
                      ).getPropertyValue(r[0]) +
                      "," +
                      r[1] +
                      ")"
                    : t;
            });
        console.warn("data-colors attributes not found on", r);
    }
}
var options,
    chart,
    chartRadarBasicColors = getChartColorsArray("basic_radar"),
    chartRadarMultiColors =
        (chartRadarBasicColors &&
            ((options = {
                series: [{ name: "Series 1", data: [80, 50, 30, 40, 100, 20] }],
                chart: { height: 350, type: "radar", toolbar: { show: !1 } },
                colors: chartRadarBasicColors,
                xaxis: {
                    categories: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                    ],
                },
            }),
            (chart = new ApexCharts(
                document.querySelector("#basic_radar"),
                options
            )).render()),
        getChartColorsArray("multi_radar")),
    chartRadarPolyradarColors =
        (chartRadarMultiColors &&
            ((options = {
                series: [
                    { name: "Series 1", data: [80, 50, 30, 40, 100, 20] },
                    { name: "Series 2", data: [20, 30, 40, 80, 20, 80] },
                    { name: "Series 3", data: [44, 76, 78, 13, 43, 10] },
                ],
                chart: {
                    height: 350,
                    type: "radar",
                    dropShadow: { enabled: !0, blur: 1, left: 1, top: 1 },
                    toolbar: { show: !1 },
                },
                stroke: { width: 2 },
                fill: { opacity: 0.2 },
                markers: { size: 0 },
                colors: chartRadarMultiColors,
                xaxis: {
                    categories: [
                        "2014",
                        "2015",
                        "2016",
                        "2017",
                        "2018",
                        "2019",
                    ],
                },
            }),
            (chart = new ApexCharts(
                document.querySelector("#multi_radar"),
                options
            )).render()),
        getChartColorsArray("polygon_radar"));
chartRadarPolyradarColors &&
    ((options = {
        series: [{ name: "Series 1", data: [20, 100, 40, 30, 50, 80, 33] }],
        chart: { height: 350, type: "radar", toolbar: { show: !1 } },
        dataLabels: { enabled: !0 },
        plotOptions: { radar: { size: 140 } },
        title: { text: "Radar with Polygon Fill", style: { fontWeight: 500 } },
        colors: chartRadarPolyradarColors,
        markers: {
            size: 4,
            colors: ["#fff"],
            strokeColor: "#f34e4e",
            strokeWidth: 2,
        },
        tooltip: {
            y: {
                formatter: function (r) {
                    return r;
                },
            },
        },
        xaxis: {
            categories: [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ],
        },
        yaxis: {
            tickAmount: 7,
            labels: {
                formatter: function (r, t) {
                    return t % 2 == 0 ? r : "";
                },
            },
        },
    }),
    (chart = new ApexCharts(
        document.querySelector("#polygon_radar"),
        options
    )).render());
