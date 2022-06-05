<?php 
foreach ($router as $key) {
    $router_name = $key->router_name;
    $router_dns = $key->router_dns;
}
?>
<html>
<head>
    <title><?php echo 'Voucher-' . $router_dns . '-' . $koment ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>/assets/images/brand/logo-1.png" />
    <style>
        body {
            color: #000000;
            background-color: #FFFFFF;
            font-size: 14px;
            font-family:  'Helvetica', arial, sans-serif;
            margin: 0px;
            -webkit-print-color-adjust: exact;
        }
        table.voucher {
            display: inline-block;
            border: 2px solid black;
            margin: 2px;
        }
        #num {
            float:right;
            display:inline-block;
        }
        .qrc {
            width:30px;
            height:30px;
            margin-top:1px;
        }
        @page
        {
            size: auto;
            margin-left: 7mm;
            margin-right: 3mm;
            margin-top: 9mm;
            margin-bottom: 3mm;
        }
        @media print
        {
            table { page-break-after:auto }
            tr    { page-break-inside:avoid; page-break-after:auto }
            td    { page-break-inside:avoid; page-break-after:auto }
            thead { display:table-header-group }
            tfoot { display:table-footer-group }
        }
        .rotate {
            vertical-align: bottom;
            text-align: center;
        }
        .rotate span {
            -ms-writing-mode: tb-rl;
            -webkit-writing-mode: vertical-rl;
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            white-space: nowrap;
        }
        .qrcode{
            height:60px;
            width:60px;
        }
    </style>
</head>
<body onload="print()">
<?php
function formatBytes($size, $precision = 2)
{
    if ($size == '0') {
        return $size;
    } else {
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }
}
function rupiah($angka) {
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
}
$count = 1;
foreach ($user as $row) {
    $num = $count++;
    $username = $row['name'];
    $password = $row['password'];
    $getdatalimit = $row['limit-bytes-total'];
    $timelimit = $row['limit-uptime'];
    if (!empty($getdatalimit)) {
        $datalimit = ' | ' .  formatBytes($getdatalimit);
    }

    if (substr($validity, -1) == "d") {
        $validity = "Aktif: " . substr($validity, 0, -1) . " Hari";
    } else if (substr($validity, -1) == "h") {
        $validity = "Aktif: " . substr($validity, 0, -1) . " Jam";
    }
    if (substr($timelimit, -1) == "d" & strlen($timelimit) > 3) {
        $timelimit = " | " . ((substr($timelimit, 0, -1) * 7) + substr($timelimit, 2, 1)) . " Hari";
    } else if (substr($timelimit, -1) == "d") {
        $timelimit = " | " . substr($timelimit, 0, -1) . " Hari";
    } else if (substr($timelimit, -1) == "h") {
        $timelimit = " | " . substr($timelimit, 0, -1) . " Jam";
    } else if (substr($timelimit, -1) == "w") {
        $timelimit = " | " . (substr($timelimit, 0, -1) * 7) . " Hari";
    }

    $qrcodedata = 'http://' . $router_dns . '/login?username=' . $username . '&password=' . $password;

?>
    <table class="voucher" style="width: 230px;">
        <tbody>
            <tr>
                <td style="font-weight: bold; border-right: 1px solid black;" class="rotate" rowspan="4">
                    <span>
                        <?php
                        if ($seller_price != 0) {
                            echo rupiah($seller_price);
                        } else {
                            echo rupiah($price);
                        }
                        ?>
                    </span>
                </td>
                <td style="font-weight: bold" colspan="2"><?= $router_name ?></td>
                <td style="" rowspan="3">
                    <canvas class='qrcode' id='Rand<?= $num ?>'></canvas>
                </td>

            </tr>
            <tr>
                <?php if ($usermode == "vc") { ?>
                    <td style="width: 100%; font-weight: bold; font-size: 16px; text-align: center;"><?= $username; ?></td>
                    <?php
                } elseif ($usermode == "up") { ?>
                    <td style="width: 100%; font-weight: bold; font-size: 13px; text-align: left;"><?= "User: " . $username . "<br>Pass: " . $password; ?></td>
                    <?php
                } ?>
            </tr>
            <tr>
                <td style="font-size: 10px;"><?= $validity; ?>  <?= $timelimit; ?>   <?= $datalimit; ?></td>
            </tr>
            <tr>
                <td colspan="3" style="font-size: 10px;">Login: http://<?= $router_dns ?> <span id="num"> <?= " [$num]"; ?></span></td>
            </tr>
        </tbody>
    </table>
    <script src="<?php echo base_url() ?>/assets/js/qrious.min.js"></script>

    <script>
        (function() {
            var Rand<?= $num ?> = new QRious({
                element: document.getElementById('Rand<?= $num ?>'),
                value: '<?= $qrcodedata ?>',
                foreground: 'black',
                size:'256'
            });
        })();
    </script>
<?php } ?>

