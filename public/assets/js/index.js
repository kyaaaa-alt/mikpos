(function ($) {
    "use strict";

    // CHART-AREA-SPARK LINE2
    var chart = c3.generate({
        bindto: '#chart-area-spline2', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 0, 8, 10, 12, 20, 18, 15, 10, 18, 10, 20, 10],
                ['data2', 0, 12, 8, 20, 10, 13, 10, 20, 10, 19, 8, 19]
            ],
            type: 'area-spline', // default type of chart
            colors: {
                data1: '#5797fc',
                data2: '#26eda2'
            },
            names: {
                // name of each serie
                'data1': 'Profit',
                'data2': 'Sales'
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        },
        legend: {
            position: 'inset',
            padding: 0,
            inset: {
                anchor: 'top-left',
                x: 20,
                y: 8,
                step: 10
            }
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        padding: {
            bottom: 0,
            left: -1,
            right: -1
        },
        point: {
            show: false
        }
    });

    // CHART-AREA-SPARK LINE1
    var chart = c3.generate({
        bindto: '#chart-area-spline1', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 0, 8, 10, 12, 20, 18, 15, 10, 18, 10, 20, 10],
                ['data2', 0, 12, 8, 20, 10, 13, 10, 20, 10, 19, 8, 19]
            ],
            type: 'area-spline', // default type of chart
            colors: {
                data1: '#4ecc48',
                data2: '#5797fc'
            },
            names: {
                // name of each serie
                'data1': 'data1',
                'data2': 'data2'
            }
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
        },
        legend: {
            show: false, //hide legend
        },
        padding: {
            bottom: 0,
            top: 0
        },
    });

    // CHART VISITORS
    var chart = c3.generate({
        bindto: '#chart-visitors',
        padding: {
            bottom: 24
        },
        data: {
            x: 'x',
            names: {
                data1: 'views',
                data2: 'Sales',
                data3: 'Users',
            },
            columns: [
                ['x', '2018-08-02', '2018-05-09', '2018-05-12', '2018-05-18', '2018-05-21', '2018-05-25', '2018-06-08', '2018-06-11', '2018-06-19', '2018-06-22', '2018-07-12'],
                ['data1', 22, 28, 21, 46, 48, 38, 48, 52, 28, 57, 32],
                ['data2', 50, 61, 75, 104, 110, 76, 74, 98, 78, 96, 144],
                ['data3', 155, 100, 96, 132, 154, 141, 158, 142, 132, 146, 186],
            ],
            types: {
                data1: 'area',
            }
        },
        point: {
            show: false
        },
        legend: {
            position: 'top',
            padding: 16
        },
        transition: {
            duration: 0
        },
        axis: {
            y: {
                tick: {
                    fit: true
                }
            },
            x: {
                type: 'timeseries',
                tick: {
                    format: '%d %b'
                },
                padding: {
                    top: 10,
                    bottom: 0
                }
            }
        },
        grid: {
            y: {
                show: true
            }
        },
        color: {
            pattern: ['#c21a1a', '#4ecc48', '#867efc',]
        }
    });

    // CHART TASKS
    var chart = c3.generate({
        bindto: '#chart-tasks', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 0, 0, 1, 2, 21, 9, 12, 10, 31, 13, 65, 10, 12, 6, 4, 3, 0],
                ['data2', 0, 0, 1, 2, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 2, 2, 0],
                ['data3', 0, 0, 1, 0, 2, 0, 1, 0, 2, 3, 0, 2, 3, 2, 1, 0, 0]
            ],
            classes: {
                data1: 'filled',
                data2: 'filled',
                data3: 'filled'
            },
            type: 'area-spline', // default type of chart
            groups: [
                ['data1', 'data2', 'data3']
            ],
            colors: {
                data1: '#6c5ffc',
                data2: '#05c3fb ',
                data3: '#09ad95'
            },
            names: {
                // name of each serie
                'data1': 'Profit',
                'data2': 'Sales',
                'data3': 'Gain'
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        },
        legend: {
            position: 'inset',
            padding: 0,
            inset: {
                anchor: 'top-left',
                x: 20,
                y: 8,
                step: 10
            }
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        padding: {
            bottom: 0,
            left: -1,
            right: -1
        },
        point: {
            show: false
        }
    });

    // CHART DONUT
    var chart = c3.generate({
        bindto: '#chart-donut', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 78],
                ['data2', 95],
                ['data3', 25],
            ],
            type: 'donut', // default type of chart
            colors: {
                data1: '#6574cd',
                data2: '#2bcbba',
                data3: '#f66d9b'
            },
            names: {
                // name of each serie
                'data1': 'sales1',
                'data2': 'sales2',
                'data3': 'sales3'
            }
        },
        axis: {},
        legend: {
            show: true,
        },
        padding: {
            bottom: 0,
            top: 0
        },
    });

    // CHART PIE
    var chart = c3.generate({
        bindto: '#chart-pie', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 98],
                ['data2', 76],
                ['data3', 45],
            ],
            type: 'pie', // default type of chart
            colors: {
                data1: '#ffcc29',
                data2: '#17a2b8',
                data3: '#ff7088'
            },
            names: {
                // name of each serie
                'data1': 'profit1',
                'data2': 'profit2',
                'data3': 'profit3'
            }
        },
        axis: {},
        legend: {
            show: true, //hide legend
        },
        padding: {
            bottom: 0,
            top: 0
        },
    });

    // CHART BG USERS 1
    var chart = c3.generate({
        bindto: '#chart-bg-users-1',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        size: {
            height: 64
        },
        data: {
            names: {
                data1: 'Visitors online'
            },
            columns: [
                ['data1', 10, 50, 100, 50, 40, 35, 70]
            ],
            type: 'area-spline'
        },
        legend: {
            show: false
        },
        transition: {
            duration: 0
        },
        point: {
            show: false
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        },
        color: {
            pattern: ['#8543f6']
        }
    });

    // CHART BG USERS 2
    var chart = c3.generate({
        bindto: '#chart-bg-users-2',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        size: {
            height: 64
        },
        data: {
            names: {
                data1: 'Total Sales'
            },
            columns: [
                ['data1', 10, 30, 20, 60, 70, 85, 75]
            ],
            type: 'area-spline'
        },
        legend: {
            show: false
        },
        transition: {
            duration: 0
        },
        point: {
            show: false
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        },
        color: {
            pattern: ['#ff7088']
        }
    });

    // CHART BG USERS 3
    var chart = c3.generate({
        bindto: '#chart-bg-users-3',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        size: {
            height: 64
        },
        data: {
            names: {
                data1: 'Total Projects'
            },
            columns: [
                ['data1', 40, 40, 50, 70, 100, 85, 80]
            ],
            type: 'area-spline'
        },
        legend: {
            show: false
        },
        transition: {
            duration: 0
        },
        point: {
            show: false
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        },
        color: {
            pattern: ['#fc7303']
        }
    });

    // CHART BG USERS 4
    var chart = c3.generate({
        bindto: '#chart-bg-users-4',
        padding: {
            bottom: -10,
            left: -1,
            right: -1
        },
        size: {
            height: 64
        },
        data: {
            names: {
                data1: 'Today Income'
            },
            columns: [
                ['data1', 300, 800, 300, 600, 300, 650, 1000]
            ],
            type: 'area-spline'
        },
        legend: {
            show: false
        },
        transition: {
            duration: 0
        },
        point: {
            show: false
        },
        tooltip: {
            format: {
                title: function (x) {
                    return '';
                }
            }
        },
        axis: {
            y: {
                padding: {
                    bottom: 0,
                },
                show: false,
                tick: {
                    outer: false
                }
            },
            x: {
                padding: {
                    left: 0,
                    right: 0
                },
                show: false
            }
        },
        color: {
            pattern: ['#4ecc48']
        }
    });

    // CHART BROWSERS
    var chart = c3.generate({
        bindto: '#chart-browsers',
        data: {
            columns: [
                ['Chrome', 36],
                ['Firefox', 15],
                ['Safari', 9],
                ['Edge', 10],
                ['Opera', 30],
            ],
            colors: {
                Chrome: '#17a2b8',
                Firefox: '#fc7303',
                Safari: '#7ea5dd',
                Edge: '#f999b9',
                Opera: '#c21a1a',
            },
            type: 'donut'
        },
        legend: {
            show: true
        }
    });
    
    // CHART EMAILS
    var chart = c3.generate({
        bindto: '#chart-emails',
        padding: {
            bottom: 24,
            top: 0
        },
        data: {
            type: 'donut',
            names: {
                data1: 'Open',
                data2: 'Bounce',
                data3: 'Unsubscribe',
            },
            columns: [
                ['data1', 30],
                ['data2', 50],
                ['data3', 25],
            ],
            colors: {
                data1: 'blue',
                data2: 'red',
                data3: 'yellow',
            }
        },
        donut: {
            label: {
                show: false
            }
        },
        legend: {
            show: true
        },
    });

    $('.resp-tabs-list .home-hogo').addClass('active');
    $('.second-sidemenu .home-hogo').addClass('resp-tab-content-active');

})(jQuery);