
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6>Device : <?= $dashboard['model'] ?></h6>
                                                        <h6>Ver : <?= $dashboard['ver'] ?></h6>
                                                        <span style="font-size: 90%;"><?= $dashboard['sysdate'] ?> <?= $dashboard['systime'] ?></span>
                                                        
                                                        
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-3">
                                                            <i style="font-size:3rem" class="fe fe-cpu"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Profit</h6>
                                                        <?php if ($total_profit >= 1000000) { ?>
                                                            <h4 class="mb-0 number-font"><?= rupiah($total_profit) ?></h4>
                                                        <?php } else { ?>
                                                            <h3 class="mb-0 number-font"><?= rupiah($total_profit) ?></h3>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-3">
                                                            <i style="font-size:3rem" class="fa fa-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-muted fs-12">
                                                    Total transaksi sukses
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Transaksi bulan ini</h6>
                                                        <?php if ($total_profit_bulanan >= 1000000) { ?>
                                                            <h4 class="mb-0 number-font"><?= rupiah($total_profit_bulanan) ?></h4>
                                                        <?php } else { ?>
                                                            <h3 class="mb-0 number-font"><?= rupiah($total_profit_bulanan) ?></h3>
                                                        <?php } ?>
                                                        
                                                    </div>
                                                    <?php if ($total_profit_harian > $last_month) { ?>
                                                        <div class="ms-auto">
                                                            <div class="chart-wrapper mt-1">
                                                                <i style="font-size:3rem" class="fe fe-trending-up"></i>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="ms-auto">
                                                            <div class="chart-wrapper mt-1">
                                                                <i style="font-size:3rem" class="fe fe-trending-down"></i>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <?php if ($total_profit_harian > $last_month) { ?>
                                                    <span class="text-muted fs-12">
                                                        <span class="text-green"><i class="fe fe-arrow-up-circle"></i></span>
                                                    Lebih besar dari bulan lalu
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="text-muted fs-12">
                                                        <span class="text-warning"><i class="fe fe-arrow-down-circle"></i></span>
                                                    Lebih kecil dari bulan lalu
                                                    </span>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Transaksi hari ini</h6>
                                                        <?php if ($total_profit_harian >= 1000000) { ?>
                                                            <h4 class="mb-0 number-font"><?= rupiah($total_profit_harian) ?></h4>
                                                        <?php } else { ?>
                                                            <h3 class="mb-0 number-font"><?= rupiah($total_profit_harian) ?></h3>
                                                        <?php } ?>
                                                    </div>
                                                    <?php if ($total_profit_harian > $last_month) { ?>
                                                        <div class="ms-auto">
                                                            <div class="chart-wrapper mt-1">
                                                                <i style="font-size:3rem" class="fe fe-trending-up"></i>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="ms-auto">
                                                            <div class="chart-wrapper mt-1">
                                                                <i style="font-size:3rem" class="fe fe-trending-down"></i>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <?php if ($total_profit_harian > $last_month) { ?>
                                                    <span class="text-muted fs-12">
                                                        <span class="text-green"><i class="fe fe-arrow-up-circle"></i></span>
                                                    Lebih besar dari kemarin
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="text-muted fs-12">
                                                        <span class="text-warning"><i class="fe fe-arrow-down-circle"></i></span>
                                                    Lebih kecil dari kemarin
                                                    </span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ROW-1 END -->

                        <!-- ROW-2 -->
                        <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title"><i class="fe fe-shield"></i> PPPoE User</h3>
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="card overflow-hidden">
                                            <div class="card-body border border-primary border-3 ">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Active</h6>
                                                        <h2 class="mb-0 number-font"> <?= $dashboard['ppp_active'] ?> <span style="font-size:1rem"> Users</span></h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-3">
                                                            <i style="font-size:3rem" class="fe fe-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card overflow-hidden">
                                            <div class="card-body border border-primary border-3 ">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total</h6>
                                                        <h2 class="mb-0 number-font"><?= $dashboard['ppp_secret'] ?> <span style="font-size:1rem"> Items</span></h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-3">
                                                            <i style="font-size:3rem" class="fe fe-users"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <a class="btn btn-primary" href="<?= base_url('u/pppsecrets') ?>">PPPoE Secret</a>
                                            <a class="btn btn-primary" href="<?= base_url('u/pppprofiles') ?>">PPPoE Profiles</a>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title"><i class="fe fe-wifi"></i> Hotspot User</h3>
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="card overflow-hidden">
                                            <div class="card-body border border-primary border-3 ">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Active</h6>
                                                        <h2 class="mb-0 number-font"> <?= $dashboard['hotspot_active'] ?> <span style="font-size:1rem"> Users</span></h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-3">
                                                            <i style="font-size:3rem" class="fe fe-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card overflow-hidden">
                                            <div class="card-body border border-primary border-3 ">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total</h6>
                                                        <h2 class="mb-0 number-font"><?= $dashboard['hotspot_user'] ?> <span style="font-size:1rem"> Items</span></h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-3">
                                                            <i style="font-size:3rem" class="fe fe-users"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex d-flex justify-content-between">
                                            <a class="btn btn-primary w-100 me-2" href="<?= base_url('u/adduser') ?>">Add</a>
                                            <a class="btn btn-primary w-100" href="<?= base_url('u/generateusers') ?>">Generate</a>
                                        </div>
                                        <div class="d-flex d-flex justify-content-between mt-2">
                                            <a class="btn btn-primary w-100 me-2" href="<?= base_url('u/extendexpire') ?>">Perpanjang</a>
                                            <a class="btn btn-primary w-100" href="<?= base_url('u/userlist') ?>">Users List</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            
                            <!-- COL END -->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                <div class="card" style="height:419px">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title"><i class="fe fe-monitor"></i> Traffic Monitor</h3>
                                        
                                    </div>
                                    <div class="card-body">
                                    <script type="text/javascript"> 
                                    var chart;
                                    var interface = "<?= $_SESSION['traffic_interface'] ?>";
                                    var n = 3000;
                                    function requestDatta() {
                                        $.ajax({
                                        url: '<?php echo base_url() ?>/u/traffic',
                                        datatype: "json",
                                        success: function(data) {
                                            var midata = JSON.parse(data);
                                            if( midata.length > 0 ) {
                                            var TX=parseInt(midata[0].data);
                                            var RX=parseInt(midata[1].data);
                                            var x = (new Date()).getTime(); 
                                            shift=chart.series[0].data.length > 19;
                                            chart.series[0].addPoint([x, TX], true, shift);
                                            chart.series[1].addPoint([x, RX], true, shift);
                                            }
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                            console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
                                        }       
                                        });
                                    }	

                                    $(document).ready(function() {
                                        Highcharts.setOptions({
                                            global: {
                                            useUTC: false
                                            }
                                        });
                                        Highcharts.addEvent(Highcharts.Series, 'afterInit', function () {
                                            this.symbolUnicode = {
                                            circle: '●',
                                            diamond: '♦',
                                            square: '■',
                                            triangle: '▲',
                                            'triangle-down': '▼'
                                            }[this.symbol] || '●';
                                        });
                                            chart = new Highcharts.Chart({
                                            chart: {
                                            renderTo: 'trafficMonitor',
                                            animation: Highcharts.svg,
                                            type: 'areaspline',
                                            events: {
                                            load: function () {
                                                setInterval(function () {
                                                requestDatta();
                                                }, 8000);
                                            }				
                                            }
                                        },
                                        title: {
                                            text: 'Interface: ' + interface
                                        },
                                        
                                        xAxis: {
                                            type: 'datetime',
                                            tickPixelInterval: 150,
                                            maxZoom: 20 * 1000,
                                        },
                                        yAxis: {
                                            minPadding: 0.2,
                                            maxPadding: 0.2,
                                            title: {
                                                text: null
                                            },
                                            labels: {
                                                formatter: function () {      
                                                var bytes = this.value;                          
                                                var sizes = ['bps', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
                                                if (bytes == 0) return '0 bps';
                                                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                                                return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];                    
                                                },
                                            },       
                                        },
                                        
                                        series: [{
                                            name: 'Tx',
                                            data: [],
                                            marker: {
                                            symbol: 'circle'
                                            }
                                        }, {
                                            name: 'Rx',
                                            data: [],
                                            marker: {
                                            symbol: 'circle'
                                            }
                                        }],
                                        credits: {
                                        enabled: false
                                        },
                                        tooltip: { 
                                            formatter: function() {
                                                var tdata = ["points", "y", "bps", "kbps", "Mbps", "Gbps", "Tbps", "<span style=\"color:", "color", "series", "; font-size: 1.5em;\">", "symbolUnicode", "</span><b>", "name", ":</b> 0 bps", "push", "log", "floor", ":</b> ", "toFixed", "pow", " ", "each", "", "%d %B %Y %H:%M:%S", "x", "dateFormat", "<br />", " <br/> ", "join"];
                                                var s = [];
                                                $[tdata[22]](this[tdata[0]], function (a, b) {
                                                var c = b[tdata[1]];
                                                var unit = [tdata[2], tdata[3], tdata[4], tdata[5], tdata[6]];
                                                if (c == 0) {
                                                    s[tdata[15]](tdata[7] + this[tdata[9]][tdata[8]] + tdata[10] + this[tdata[9]][tdata[11]] + tdata[12] + this[tdata[9]][tdata[13]] + tdata[14])
                                                };
                                                var a = parseInt(Math[tdata[17]](Math[tdata[16]](c) / Math[tdata[16]](1024)));
                                                s[tdata[15]](tdata[7] + this[tdata[9]][tdata[8]] + tdata[10] + this[tdata[9]][tdata[11]] + tdata[12] + this[tdata[9]][tdata[13]] + tdata[18] + parseFloat((c / Math[tdata[20]](1024, a))[tdata[19]](2)) + tdata[21] + unit[a])
                                                });
                                                return tdata[23] + Highcharts[tdata[26]](tdata[24], new Date(this[tdata[25]])) + tdata[27] + s[tdata[29]](tdata[28])
                                            },
                                            shared: true
                                        },
                                        });
                                    });
                                    </script>
                                    <div id="trafficMonitor"></div>
                                    <script src="<?php echo base_url() ?>/assets/js/highcharts.js"></script>
                                    <script src="<?php echo base_url() ?>/assets/js/highcharts-theme.js"></script>
                                    </div>
                                  
                                </div>
                            </div>
                            <!-- COL END -->
                        </div>
                        <!-- ROW-2 END -->
            

        