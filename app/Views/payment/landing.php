<?php foreach ($router as $row) {
    $routerid = $row->id;
    $userid = $row->user_id;
    $routername = $row->router_name;
    $routerdns = $row->router_dns;
}
?>
<!DOCTYPE html>
<html lang="en" >

<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    
    <title><?= $routername ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link id="style" href="<?php echo base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            width: 100wh;
            height: 90vh;
            color: #fff;
            background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
            background-size: 400% 400%;
            -webkit-animation: Gradient 15s ease infinite;
            -moz-animation: Gradient 15s ease infinite;
            animation: Gradient 15s ease infinite;
        }

        @-webkit-keyframes Gradient {
            0% {
                background-position: 0% 50%
            }
            50% {
                background-position: 100% 50%
            }
            100% {
                background-position: 0% 50%
            }
        }

        @-moz-keyframes Gradient {
            0% {
                background-position: 0% 50%
            }
            50% {
                background-position: 100% 50%
            }
            100% {
                background-position: 0% 50%
            }
        }

        @keyframes Gradient {
            0% {
                background-position: 0% 50%
            }
            50% {
                background-position: 100% 50%
            }
            100% {
                background-position: 0% 50%
            }
        }

        h1,
        h6 {
            font-family: 'Open Sans';
            font-weight: 300;
            text-align: center;
            position: absolute;
            top: 45%;
            right: 0;
            left: 0;
        }

        .shake {
            animation: shake-animation 4.72s ease infinite;
            transform-origin: 50% 50%;
        }
        .element {
            margin: 0 auto;
            width: 150px;
            height: 150px;
            background: red;
        }
        @keyframes shake-animation {
            0% { transform:translate(0,0) }
            1.78571% { transform:translate(5px,0) }
            3.57143% { transform:translate(0,0) }
            5.35714% { transform:translate(5px,0) }
            7.14286% { transform:translate(0,0) }
            8.92857% { transform:translate(5px,0) }
            10.71429% { transform:translate(0,0) }
            100% { transform:translate(0,0) }
        }

        .backdrop {
            -moz-box-shadow: 0px 6px 5px #111; 
            -webkit-box-shadow: 0px 6px 5px #111; 
            box-shadow: 0px 2px 10px #111; 
            -moz-border-radius:190px; 
            -webkit-border-radius:190px; 
            border-radius:190px;
        }
    </style>
</head>

<body>
    <div class="container">
    <div class="col-xs-12">
            <div class="text-center" style="padding-top: 30px; padding-bottom: 30px;">
                <h2 style="color: #ffffff; padding-top: 20px;"><?= $routername ?></h2>
            </div>
    </div>
    </div>


    <div class="container" style="max-width:500px;">
    <div class="col-xs-12">
            <div class="text-center">
                <h4>VOUCHER</h4>
                <div style="padding-bottom: 15px;">
                    <a target="_blank" href="<?= base_url('voucher') . '/' . $userid . '/' . $routerid . '/' ?>" class="btn btn-outline-light shake" style="width: 80%; padding-top:10px; padding-bottom:10px; font-weight: 600;">Beli / Perpanjang Voucher</a>
                </div>
                <div style="padding-bottom: 15px;">
                    <a target="_blank" href="<?= base_url('chkstatus') . '/' . $userid . '/' . $routerid . '/' ?>" class="btn btn-outline-light" style="width: 80%; padding-top:10px; padding-bottom:10px; font-weight: 600;">Cek Status Voucher</a>
                </div>
                <h4 class="mt-3">MEMBER PPPoE</h4>
                <div style="padding-bottom: 15px;">
                    <a target="_blank" href="<?= base_url('payment') . '/' . $userid . '/' . $routerid . '/' ?>" class="btn btn-outline-light shake" style="width: 80%; padding-top:10px; padding-bottom:10px; font-weight: 600;">Perpanjang Masa Aktif</a>
                </div>
                <div style="padding-bottom: 15px;">
                    <a target="_blank" href="<?= base_url('chkvalidity') . '/' . $userid . '/' . $routerid . '/' ?>" class="btn btn-outline-light" style="width: 80%; padding-top:10px; padding-bottom:10px; font-weight: 600;">Cek Status Member</a>
                </div>
            </div>
    </div>
    </div>

</body>

</html>