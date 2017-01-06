$(document).ready(function() {
    /* get sale data from url('/chart/sale') */
    var tick_month = [
        [1, "一月"],
        [2, "二月"],
        [3, "三月"],
        [4, "四月"],
        [5, "五月"],
        [6, "六月"],
        [7, "七月"],
        [8, "八月"],
        [9, "九月"],
        [10, "十月"],
        [11, "十一月"],
        [12, "十二月"],
    ];
    var options = {
        series: {
            shadowSize: 0,
            lines: {
                show: true,
                lineWidth: 3,
            },
            points: {
                show: true,
            }
        },
        grid: {
            borderWidth: 0,
            labelMargin: 10,
            hoverable: true,
            clickable: true,
            // mouseActiveRadius: 6,
        },
        yaxis: {
            tickDecimals: 0,
            ticks: false
        },
        xaxis: {
            ticks: tick_month,
            tickColor: '#fff',
            tickDecimals: 0,
            font: {
                lineHeight: 13,
                style: "normal",
                color: "#9f9f9f"
            },
            shadowSize: 0,
        },
        legend: {
            show: false
        }
    };
    $.ajax({
        url: "/chart/sale",
        type: "GET",
        data: {},
        success: function(json) {
            console.log(json);
            $.plot($("#curved-line-chart"), [{
                data: json,
                lines: {
                    show: true,
                    fill: 0
                },
                label: 'Product 1',
                stack: true,
                color: '#16AFCC'
            }], options);
        }
    });
    $(".flot-chart").bind("plothover", function(event, pos, item) {
        if (item) {
            var x = item.datapoint[0],
                y = item.datapoint[1].toFixed(2);
            $(".flot-tooltip").html(x + "月的銷售額為：" + y).css({
                top: item.pageY + 5,
                left: item.pageX + 5
            }).show();
        } else {
            $(".flot-tooltip").hide();
        }
    });
    $("<div class='flot-tooltip' class='chart-tooltip'></div>").appendTo("body");
});