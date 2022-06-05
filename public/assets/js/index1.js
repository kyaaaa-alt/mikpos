$(function(e) {
    'use strict'

    // FLOAT CHART
    $.plot('#flotback-chart', [{
        data: dashData10,
        color: 'rgba(255,255,255, 0.2)',
        lines: {
            lineWidth: 1
        }
    }], {
        series: {
            stack: 0,
            shadowSize: 0,
            lines: {
                show: true,
                lineWidth: 1.8,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0
                    }, {
                        opacity: 0.3
                    }]
                }
            }
        },
        grid: {
            borderWidth: 0,
            labelMargin: 5,
            hoverable: true
        },
        yaxis: {
            show: false,
            color: 'rgba(72, 94, 144, .1)',
            min: 0,
            max: 130,
            font: {
                size: 10,
                color: '#8392a5'
            }
        },
        xaxis: {
            show: false,
            color: 'rgba(72, 94, 144, .1)',
            ticks: [
                [0, '10'],
                [10, '20'],
                [20, '30'],
                [30, '40'],
                [40, '50'],
                [50, '60'],
                [60, '70'],
                [70, '80'],
                [80, '90'],
                [90, '100'],
                [100, '110'],
                [120, '120'],
            ],
            font: {
                size: 10,
                color: '#8392a5'
            },
            reserveSpace: false
        }
    });

    // RECENT ORDERS
    var myCanvas = document.getElementById("recentorders");
    myCanvas.height = "225";
    var myChart = new Chart(myCanvas, {
        type: 'bar',
        data: {
            labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            datasets: [{
                label: 'This Month',
                data: [27, 50, 28, 50, 28, 30, 22],
                backgroundColor: '#61c9fc',
                borderWidth: 2,
                hoverBackgroundColor: '#61c9fc',
                hoverBorderWidth: 0,
                borderColor: '#61c9fc',
                hoverBorderColor: '#61c9fc',
                borderDash: [5, 2],
            }, {
                label: 'This Month',
                data: [32, 58, 68, 65, 40, 68, 58],
                backgroundColor: '#f38ff3',
                borderWidth: 2,
                hoverBackgroundColor: '#f38ff3',
                hoverBorderWidth: 0,
                borderColor: '#f38ff3',
                hoverBorderColor: '#f38ff3',
                borderDash: [5, 2],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            tooltips: {
                enabled: false,
            },
            scales: {
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false,
                        zeroLineColor: 'rgba(142, 156, 173,0.1)',
                        color: "rgba(142, 156, 173,0.1)",
                    },
                    scaleLabel: {
                        display: false,
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 25,
                        suggestedMin: 0,
                        suggestedMax: 100,
                        fontColor: "#8492a6",
                        userCallback: function(tick) {
                            return tick.toString() + '%';
                        }
                    },
                }],
                xAxes: [{
                    display: false,
                    barPercentage: 0.4,
                    barValueSpacing: 0,
                    barDatasetSpacing: 0,
                    barRadius: 0,
                    stacked: false,
                    ticks: {
                        beginAtZero: true,
                        fontColor: "#8492a6",
                    },
                    gridLines: {
                        color: "rgba(142, 156, 173,0.1)",
                        display: false
                    },

                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });

    // SALES CHART
    var ctx = document.getElementById('saleschart').getContext('2d');
    ctx.height = 10;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Total Sales',
                data: [19, 15, 17, 14, 13, 15, 16],
                backgroundColor: [
                    'rgba(5, 195, 251, 0.2)',
                    'rgba(5, 195, 251, 0.2)',
                    '#05c3fb',
                    'rgba(5, 195, 251, 0.2)',
                    'rgba(5, 195, 251, 0.2)',
                    '#05c3fb',
                    '#05c3fb'
                ],
                borderColor: [
                    'rgba(5, 195, 251, 0.5)',
                    'rgba(5, 195, 251, 0.5)',
                    '#05c3fb',
                    'rgba(5, 195, 251, 0.5)',
                    'rgba(5, 195, 251, 0.5)',
                    '#05c3fb',
                    '#05c3fb'
                ],
                pointBorderWidth: 2,
                pointRadius: 2,
                pointHoverRadius: 2,
                borderWidth: 1
            }, ]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            responsive: true,
            tooltips: {
                enabled: false,
            },
            scales: {
                xAxes: [{
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                    barRadius: 0,
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                }],
                yAxes: [{
                    display: false,
                    ticks: {
                        display: false,
                    }
                }]
            },
            title: {
                display: false,
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });

    // CHARTJS SALES CHART CLOSED

    // LEADS CHART
    var ctx = document.getElementById('leadschart').getContext('2d');
    ctx.height = 10;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8', 'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15'],
            datasets: [{
                label: 'Total Sales',
                data: [45, 23, 32, 67, 49, 72, 52, 55, 46, 54, 32, 74, 88, 36, 36, 32, 48, 54],
                backgroundColor: 'transparent',
                borderColor: '#f46ef4',
                borderWidth: '2.5',
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'transparent',
            }, ]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            responsive: true,
            tooltips: {
                enabled: false,
            },
            scales: {
                xAxes: [{
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                }],
                yAxes: [{
                    display: false,
                    ticks: {
                        display: false,
                    }
                }]
            },
            title: {
                display: false,
            },
        }
    });
    // CHARTJS LEADS CHART CLOSED

    // PROFIT CHART 
    var ctx = document.getElementById('profitchart').getContext('2d');
    ctx.height = 10;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Total Sales',
                barGap: 0,
                barSizeRatio: 1,
                data: [14, 17, 12, 13, 11, 15, 16],
                backgroundColor: '#4ecc48',
                borderColor: '#4ecc48',
                pointBackgroundColor: '#fff',
                pointHoverBackgroundColor: '#4ecc48',
                pointBorderColor: '#4ecc48',
                pointHoverBorderColor: '#4ecc48',
                pointBorderWidth: 2,
                pointRadius: 2,
                pointHoverRadius: 2,
                borderWidth: 1
            }, ]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            responsive: true,
            tooltips: {
                enabled: false,
            },
            scales: {
                xAxes: [{
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                }],
                yAxes: [{
                    display: false,
                    ticks: {
                        display: false,
                    }
                }]
            },
            title: {
                display: false,
            },
        }
    });
    // PROFIT CHART CLOSED

    // COST CHART 
    var ctx = document.getElementById('costchart').getContext('2d');
    ctx.height = 10;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8', 'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15', 'Date 16', 'Date 17'],
            datasets: [{
                label: 'Total Sales',
                data: [28, 56, 36, 32, 48, 54, 37, 58, 66, 53, 21, 24, 14, 45, 0, 32, 67, 49, 52, 55, 46, 54, 130],
                backgroundColor: 'transparent',
                borderColor: '#f7ba48',
                borderWidth: '2.5',
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'transparent',
            }, ]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            responsive: true,
            tooltips: {
                enabled: false,
            },
            scales: {
                xAxes: [{
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                }],
                yAxes: [{
                    display: false,
                    ticks: {
                        display: false,
                    }
                }]
            },
            title: {
                display: false,
            },
        }
    });
    // COST CHART CLOSED

    // DATA TABLE
    $('#data-table').DataTable({
        "order": [
            [0, "desc"]
        ],
        order: [],
        columnDefs: [{ orderable: false, targets: [0, 4, 5] }],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        }
    });

    // SELECT2
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });

    // WORLD MAP MARKER
    $('#world-map-markers1').vectorMap({
        map: 'world_mill_en',
        scaleColors: ['#6c5ffc', '#e82646', '#05c3fb'],

        normalizeFunction: 'polynomial',

        hoverOpacity: 0.7,

        hoverColor: false,

        regionStyle: {

            initial: {

                fill: '#edf0f5'
            }
        },
        markerStyle: {
            initial: {
                r: 6,
                'fill': '#6c5ffc',
                'fill-opacity': 0.9,
                'stroke': '#fff',
                'stroke-width': 9,
                'stroke-opacity': 0.2
            },

            hover: {
                'stroke': '#fff',
                'fill-opacity': 1,
                'stroke-width': 1.5
            }
        },
        backgroundColor: 'transparent',
        markers: [{
            latLng: [40.3, -101.38],
            name: 'USA',
        }, {
            latLng: [22.5, 1.51],
            name: 'India'
        }, {
            latLng: [50.02, 80.55],
            name: 'Bahrain'
        }, {
            latLng: [3.2, 73.22],
            name: 'Maldives'
        }, {
            latLng: [35.88, 14.5],
            name: 'Malta'
        }, ]
    });

});

function getCssValuePrefix() {
    'use strict'

    var retuenValue = ''; //default to standard syntax
    var prefixes = ['-o-', '-ms-', '-moz-', '-webkit-'];

    // Create a temporary DOM object for testing
    var dom = document.createElement('div');

    for (var i = 0; i < prefixes.length; i++) {
        // Attempt to set the style
        dom.style.background = prefixes[i] + 'linear-gradient(#ffffff, #000000)';

        // Detect if the style was successfully set
        if (dom.style.background) {
            retuenValue = prefixes[i];
        }
    }

    dom = null;
    dom.remove();

    return retuenValue;
}

function index() {
    'use strict'

    // TRANSACTIONS
    var myCanvas = document.getElementById("transactions");
    myCanvas.height = "330";

    var myCanvasContext = myCanvas.getContext("2d");
    var gradientStroke1 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
    gradientStroke1.addColorStop(0, hexToRgba(myVarVal, 0.8) || 'rgba(108, 95, 252, 0.8)');
    gradientStroke1.addColorStop(1, hexToRgba(myVarVal, 0.2) || 'rgba(108, 95, 252, 0.2) ');

    var gradientStroke2 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
    gradientStroke2.addColorStop(0, hexToRgba(myVarVal1, 0.8) || 'rgba(5, 195, 251, 0.8)');
    gradientStroke2.addColorStop(1, hexToRgba(myVarVal1, 0.8) || 'rgba(5, 195, 251, 0.2) ');
    document.getElementById('transactions').innerHTML = ''; 
    var myChart;
    myChart = new Chart(myCanvas, {

        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
            type: 'line',
            datasets: [{
                label: 'Total Sales',
                data: [100, 210, 180, 454, 454, 230, 230, 656, 656, 350, 350, 210],
                backgroundColor: gradientStroke1,
                borderColor: myVarVal,
                pointBackgroundColor: '#fff',
                pointHoverBackgroundColor: gradientStroke1,
                pointBorderColor: myVarVal,
                pointHoverBorderColor: gradientStroke1,
                pointBorderWidth: 0,
                pointRadius: 0,
                pointHoverRadius: 0,
                borderWidth: 3,
                fill: 'origin'
            }, {
                label: 'Total Orders',
                data: [200, 530, 110, 110, 480, 520, 780, 435, 475, 738, 454, 454],
                backgroundColor: 'transparent',
                borderColor: '#05c3fb',
                pointBackgroundColor: '#fff',
                pointHoverBackgroundColor: gradientStroke2,
                pointBorderColor: '#05c3fb',
                pointHoverBorderColor: gradientStroke2,
                pointBorderWidth: 0,
                pointRadius: 0,
                pointHoverRadius: 0,
                borderWidth: 3,
                fill: 'origin',

            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                enabled: false,
            },
            legend: {
                display: false,
                labels: {
                    usePointStyle: false,
                },
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false,
                        color: 'rgba(119, 119, 142, 0.08)'
                    },
                    ticks: {
                        fontColor: '#b0bac9',
                        autoSkip: true,
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month',
                        fontColor: 'transparent'
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 1050,
                        stepSize: 150,
                        fontColor: "#b0bac9",
                    },
                    display: true,
                    gridLines: {
                        display: true,
                        drawBorder: false,
                        zeroLineColor: 'rgba(142, 156, 173,0.1)',
                        color: "rgba(142, 156, 173,0.1)",
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'sales',
                        fontColor: 'transparent'
                    }
                }]
            },
            title: {
                display: false,
                text: 'Normal Legend'
            }
        }
    });
}