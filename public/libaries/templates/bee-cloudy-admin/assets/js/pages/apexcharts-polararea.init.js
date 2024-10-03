function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var t =
                "data-colors" +
                ("-" + document.documentElement.getAttribute("data-theme") ??
                    ""),
            t =
                document.getElementById(e).getAttribute(t) ??
                document.getElementById(e).getAttribute("data-colors");
        if (t)
            return (t = JSON.parse(t)).map(function (e) {
                var t = e.replace(" ", "");
                return -1 === t.indexOf(",")
                    ? getComputedStyle(
                          document.documentElement
                      ).getPropertyValue(t) || t
                    : 2 == (e = e.split(",")).length
                    ? "rgba(" +
                      getComputedStyle(
                          document.documentElement
                      ).getPropertyValue(e[0]) +
                      "," +
                      e[1] +
                      ")"
                    : t;
            });
        console.warn("data-colors attributes not found on", e);
    }
}
var chart,
    chartPolarareaBasicColors = getChartColorsArray("basic_polar_area"),
    options =
        (chartPolarareaBasicColors &&
            ((options = {
                series: [14, 23, 21, 17, 15, 10, 12, 17, 21],
                chart: { type: "polarArea", width: 400 },
                labels: [
                    "Series A",
                    "Series B",
                    "Series C",
                    "Series D",
                    "Series E",
                    "Series F",
                    "Series G",
                    "Series H",
                    "Series I",
                ],
                stroke: { colors: ["#fff"] },
                fill: { opacity: 0.8 },
                legend: { position: "bottom" },
                colors: chartPolarareaBasicColors,
            }),
            (chart = new ApexCharts(
                document.querySelector("#basic_polar_area"),
                options
            )).render()),
        {
            series: [42, 47, 52, 58, 65],
            chart: { width: 400, type: "polarArea" },
            labels: ["Rose A", "Rose B", "Rose C", "Rose D", "Rose E"],
            fill: { opacity: 1 },
            stroke: { width: 1, colors: void 0 },
            yaxis: { show: !1 },
            legend: { position: "bottom" },
            plotOptions: {
                polarArea: {
                    rings: { strokeWidth: 0 },
                    spokes: { strokeWidth: 0 },
                },
            },
            theme: {
                mode: "light",
                palette: "palette1",
                monochrome: {
                    enabled: !0,
                    shadeTo: "light",
                    color: "#405189",
                    shadeIntensity: 0.6,
                },
            },
        });
document.querySelector("#monochrome_polar_area") &&
    (chart = new ApexCharts(
        document.querySelector("#monochrome_polar_area"),
        options
    )).render();
