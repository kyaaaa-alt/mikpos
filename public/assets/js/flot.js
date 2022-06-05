/*---- placeholder1----*/
$(function() {
    'use strict'

    var sin = [],
        cos = [];
    for (var i = 0; i < 14; i += 0.1) {
        sin.push([i, Math.sin(i)]);
        cos.push([i, Math.cos(i)]);
    }
    var plot = $.plot("#placeholder1", [{
        data: sin
    }, {
        data: cos
    }], {
        series: {
            lines: {
                show: true
            }
        },
        lines: {
            show: true,
            fill: true,
            fillColor: {
                colors: [{
                    opacity: 0.7
                }, {
                    opacity: 0.7
                }]
            }
        },
        crosshair: {
            mode: "x"
        },
        grid: {
            hoverable: false,
            autoHighlight: false,
            borderColor: "rgba(119, 119, 142, 0.1)",
            verticalLines: false,
            horizontalLines: false
        },
        colors: ['#6c5ffc', '#05c3fb'],
        yaxis: {
            min: -1.2,
            max: 1.2,
            tickLength: 0
        },
        xaxis: {
            tickLength: 0
        }
    });
    
});

/*---- placeholder2----*/
$(function() {
    'use strict'

    var sin = [],
        cos = [];
    for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)]);
        cos.push([i, Math.cos(i)]);
    }
    var plot = $.plot("#placeholder2", [{
        data: sin,
        label: "data1"
    }, {
        data: cos,
        label: "data2"
    }], {
        series: {
            lines: {
                show: true
            },
            points: {
                show: true
            }
        },
        grid: {
            hoverable: true,
            clickable: true,
            borderColor: "rgba(119, 119, 142, 0.1)",
            verticalLines: false,
            horizontalLines: false
        },
        colors: ['#6c5ffc', '#05c3fb'],
        yaxis: {
            min: -1.2,
            max: 1.2,
            tickLength: 0
        },
        xaxis: {
            tickLength: 0
        }
    });
});


/*---- placeholder4----*/
$(function() {
    'use strict'

    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data = [],
        totalPoints = 300;

    function getRandomData() {
    'use strict'

        if (data.length > 0) data = data.slice(1);
        // Do a random walk
        while (data.length < totalPoints) {
            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5;
            if (y < 0) {
                y = 0;
            } else if (y > 100) {
                y = 100;
            }
            data.push(y);
        }
        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]])
        }
        return res;
    }
    var updateInterval = 30;
    $("#updateInterval").val(updateInterval).change(function() {
        var v = $(this).val();
        if (v && !isNaN(+v)) {
            updateInterval = +v;
            if (updateInterval < 1) {
                updateInterval = 1;
            } else if (updateInterval > 2000) {
                updateInterval = 2000;
            }
            $(this).val("" + updateInterval);
        }
    });
    var plot = $.plot("#placeholder4", [getRandomData()], {
        series: {
            shadowSize: 0 // Drawing is faster without shadows
        },
        grid: {
            borderColor: "rgba(119, 119, 142, 0.1)",
        },
        colors: ["#6c5ffc"],
        yaxis: {
            min: 0,
            max: 100,
            tickLength: 0
        },
        xaxis: {
            tickLength: 0,
            show: false
        }
    });

    function update() {
    'use strict'
        plot.setData([getRandomData()]);
        plot.draw();
        setTimeout(update, updateInterval);
    }
    update();
});

/*---- placeholder6----*/
$(function() {
    'use strict'

    var d1 = [];
    for (var i = 0; i <= 10; i += 1) {
        d1.push([i, parseInt(Math.random() * 30)]);
    }
    var d2 = [];
    for (var i = 0; i <= 10; i += 1) {
        d2.push([i, parseInt(Math.random() * 30)]);
    }
    var d3 = [];
    for (var i = 0; i <= 10; i += 1) {
        d3.push([i, parseInt(Math.random() * 30)]);
    }
    var stack = 0,
        bars = true,
        lines = false,
        steps = false;

    function plotWithOptions() {
    'use strict'

        $.plot("#placeholder6", [d1, d2, d3], {
            series: {
                stack: stack,
                lines: {
                    show: lines,
                    fill: true,
                    steps: steps
                },
                bars: {
                    show: bars,
                    barWidth: 0.6
                }
            },
            grid: {
                borderColor: "rgba(119, 119, 142, 0.1)",
            },
            colors: ['#6c5ffc', '#05c3fb'],
            yaxis: {
                tickLength: 0
            },
            xaxis: {
                tickLength: 0,
                show: false
            }
        });
    }
    plotWithOptions();
    $(".stackControls button").click(function(e) {
        e.preventDefault();
        stack = $(this).text() == "With stacking" ? true : null;
        plotWithOptions();
    });
    $(".graphControls button").click(function(e) {
        e.preventDefault();
        bars = $(this).text().indexOf("Bars") != -1;
        lines = $(this).text().indexOf("Lines") != -1;
        steps = $(this).text().indexOf("steps") != -1;
        plotWithOptions();
    });
});

$(function() {
    'use strict'
    
    var data = [],
        series = Math.floor(Math.random() * 4) + 3;
    for (var i = 0; i < series; i++) {
        data[i] = {
            label: "Series" + (i + 1),
            data: Math.floor(Math.random() * 100) + 1
        }
    }
    var placeholder = $("#placeholder");
    $("#example-1").on('click', function() {
        placeholder.unbind();
        $("#title").text("Default pie chart");
        $("#description").text("The default pie chart with no options set.");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true
                }
            },
            colors: ['#6c5ffc', '#05c3fb', '#09ad95', '#1170e4', '#f82649'],
        });
    });
    $("#example-2").on('click', function() {
        placeholder.unbind();
        $("#title").text("Default without legend");
        $("#description").text("The default pie chart when the legend is disabled. Since the labels would normally be outside the container, the chart is resized to fit.");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true
                }
            },
            colors: ['#6c5ffc', '#05c3fb', '#09ad95', '#1170e4', '#f82649'],
            legend: {
                show: false
            }
        });
    });
    $("#example-3").on('click', function() {
        placeholder.unbind();
        $("#title").text("Custom Label Formatter");
        $("#description").text("Added a semi-transparent background to the labels and a custom labelFormatter function.");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 1,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.8
                        }
                    }
                }
            },
            colors: ['#1170e4', '#d43f8d', '#45aaf2', '#ecb403', '#e86a91'],
            legend: {
                show: false
            }
        });
    });
    $("#example-4").on('click', function() {
        placeholder.unbind();
        $("#title").text("Label Radius");
        $("#description").text("Slightly more transparent label backgrounds and adjusted the radius values to place them within the pie.");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 3 / 4,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.5
                        }
                    }
                }
            },
            colors: ['#1170e4', '#d43f8d', '#45aaf2', '#ecb403', '#64E572'],
            legend: {
                show: false
            }
        });
    });
    $("#example-5").on('click', function() {
        placeholder.unbind();
        $("#title").text("Label Styles #1");
        $("#description").text("Semi-transparent, black-colored label background.");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 3 / 4,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.5,
                            color: "#000"
                        }
                    }
                }
            },
            colors: ['#1170e4', '#d43f8d', '#45aaf2', '#ecb403', '#e86a91'],
            legend: {
                show: false
            }
        });
    });
    $("#example-6").on('click', function() {
        placeholder.unbind();
        $("#title").text("Label Styles #2");
        $("#description").text("Semi-transparent, black-colored label background placed at pie edge.");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    radius: 3 / 4,
                    label: {
                        show: true,
                        radius: 3 / 4,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.5,
                            color: "#000"
                        }
                    }
                }
            },
            colors: ['#1170e4', '#d43f8d', '#45aaf2', '#ecb403', '#e86a91'],
            legend: {
                show: false
            }
        });
    });
    $("#example-7").on('click', function() {
        placeholder.unbind();
        $("#title").text("Hidden Labels");
        $("#description").text("Labels can be hidden if the slice is less than a given percentage of the pie (10% in this case).");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 2 / 3,
                        formatter: labelFormatter,
                        threshold: 0.1
                    }
                }
            },
            colors: ['#1170e4', '#d43f8d', '#45aaf2', '#ecb403', '#e86a91'],
            legend: {
                show: false
            }
        });
    });
    $("#example-8").on('click', function() {
        placeholder.unbind();
        $("#title").text("Combined Slice");
        $("#description").text("Multiple slices less than a given percentage (5% in this case) of the pie can be combined into a single, larger slice.");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    combine: {
                        color: "#999",
                        threshold: 0.05
                    }
                }
            },
            colors: ['#1170e4', '#d43f8d', '#45aaf2', '#ecb403', '#e86a91'],
            legend: {
                show: false
            }
        });
    });
    $("#example-9").on('click', function() {
        placeholder.unbind();
        $("#title").text("Rectangular Pie");
        $("#description").text("The radius can also be set to a specific size (even larger than the container itself).");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    radius: 500,
                    label: {
                        show: true,
                        formatter: labelFormatter,
                        threshold: 0.1
                    }
                }
            },
            colors: ['#1170e4', '#d43f8d', '#45aaf2', '#ecb403', '#e86a91'],
            legend: {
                show: false
            }
        });
    });
    $("#example-10").on('click', function() {
        placeholder.unbind();
        $("#title").text("Tilted Pie");
        $("#description").text("The pie can be tilted at an angle.");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    tilt: 0.5,
                    label: {
                        show: true,
                        radius: 1,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.8
                        }
                    },
                    combine: {
                        color: "#999",
                        threshold: 0.1
                    }
                }
            },
            colors: ['#1170e4', '#d43f8d', '#45aaf2', '#ecb403', '#e86a91'],
            legend: {
                show: false
            }
        });
    });
    $("#example-11").on('click', function() {
        placeholder.unbind();
        $("#title").text("Donut Hole");
        $("#description").text("A donut hole can be added.");
        $.plot(placeholder, data, {
            series: {
                pie: {
                    innerRadius: 0.5,
                    show: true
                }
            }
        });
    });
    $("#example-1").click();
});

// A custom label formatter used by several of the plots
function labelFormatter(label, series) {
	'use strict'
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}
//
function setCode(lines) {
	'use strict'
    $("#code").text(lines.join("\n"));
}