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
var worldemapmarkers = "",
    storeVisitsSourceChart = "",
    customerImpressionChart = "";
function loadCharts() {
    var e,
        t = getChartColorsArray("sales-by-locations");
        
    (t = getChartColorsArray("customer_impression_charts")) &&
        ((e = {
            // load thông tin
            series: [
                {
                    name: "Đơn hàng",
                    type: "area",
                    data: orderGraph,
                },
                {
                    name: "Doanh thu",
                    type: "bar",
                    data: moneyGraph,
                },
            ],
            chart: { height: 450, type: "line", toolbar: { show: !1 } },
            stroke: {
                curve: "straight",
                dashArray: [0, 0, 8],
                width: [2, 0, 2.2],
            },
            fill: { opacity: [0.1, 0.9, 1] },
            markers: {
                size: [0, 0, 0],
                strokeWidth: 2,
                hover: { size: 4 },
            },
            xaxis: {
                categories: [
                    "Tháng 1",
                    "Tháng 2",
                    "Tháng 3",
                    "Tháng 4",
                    "Tháng 5",
                    "Tháng 6",
                    "Tháng 7",
                    "Tháng 8",
                    "Tháng 9",
                    "Tháng 10",
                    "Tháng 11",
                    "Tháng 12",
                ],
                axisTicks: { show: !1 },
                axisBorder: { show: !1 },
            },
            grid: {
                show: !0,
                xaxis: { lines: { show: !0 } },
                yaxis: { lines: { show: !1 } },
                padding: { top: 0, right: -2, bottom: 15, left: 10 },
            },
            legend: {
                show: !0,
                horizontalAlign: "center",
                offsetX: 0,
                offsetY: -5,
                markers: { width: 9, height: 9, radius: 6 },
                itemMargin: { horizontal: 10, vertical: 0 },
            },
            plotOptions: { bar: { columnWidth: "30%", barHeight: "70%" } },
            colors: t,
            tooltip: {
                shared: !0,
                y: [
                    {
                        formatter: function (e) {
                            return void 0 !== e ? e.toFixed(0) + " Đơn hàng" : e;
                        },
                    },
                    {
                        formatter: function (e) {
                            return void 0 !== e ? "" + e.toFixed(0) + " đ" : e;
                        },
                    },
                ],
            },
        }),
        "" != customerImpressionChart && customerImpressionChart.destroy(),
        (customerImpressionChart = new ApexCharts(
            document.querySelector("#customer_impression_charts"),
            e
        )).render());
}
(window.onresize = function () {
    setTimeout(() => {
        loadCharts();
    }, 0);
}),
    loadCharts();
var overlay,
    swiper = new Swiper(".vertical-swiper", {
        slidesPerView: 2,
        spaceBetween: 10,
        mousewheel: !0,
        loop: !0,
        direction: "vertical",
        autoplay: { delay: 2500, disableOnInteraction: !1 },
    }),
    layoutRightSideBtn = document.querySelector(".layout-rightside-btn");
layoutRightSideBtn &&
    (Array.from(document.querySelectorAll(".layout-rightside-btn")).forEach(
        function (e) {
            var t = document.querySelector(".layout-rightside-col");
            e.addEventListener("click", function () {
                t.classList.contains("d-block")
                    ? (t.classList.remove("d-block"), t.classList.add("d-none"))
                    : (t.classList.remove("d-none"),
                      t.classList.add("d-block"));
            });
        }
    ),
    window.addEventListener("resize", function () {
        var e = document.querySelector(".layout-rightside-col");
        e &&
            Array.from(
                document.querySelectorAll(".layout-rightside-btn")
            ).forEach(function () {
                window.outerWidth < 1699 || 3440 < window.outerWidth
                    ? e.classList.remove("d-block")
                    : 1699 < window.outerWidth && e.classList.add("d-block");
            }),
            "semibox" == document.documentElement.getAttribute("data-layout") &&
                (e.classList.remove("d-block"), e.classList.add("d-none"));
    }),
    (overlay = document.querySelector(".overlay"))) &&
    document.querySelector(".overlay").addEventListener("click", function () {
        1 ==
            document
                .querySelector(".layout-rightside-col")
                .classList.contains("d-block") &&
            document
                .querySelector(".layout-rightside-col")
                .classList.remove("d-block");
    }),
    window.addEventListener("load", function () {
        var e = document.querySelector(".layout-rightside-col");
        e &&
            Array.from(
                document.querySelectorAll(".layout-rightside-btn")
            ).forEach(function () {
                window.outerWidth < 1699 || 3440 < window.outerWidth
                    ? e.classList.remove("d-block")
                    : 1699 < window.outerWidth && e.classList.add("d-block");
            }),
            "semibox" == document.documentElement.getAttribute("data-layout") &&
                1699 < window.outerWidth &&
                (e.classList.remove("d-block"), e.classList.add("d-none"));
    });
