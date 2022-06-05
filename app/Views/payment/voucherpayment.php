<?php foreach ($router as $row) {
    $routerid = $row->id;
    $userid = $row->user_id;
    $routername = $row->router_name;
    $routerdns = $row->router_dns;
}
function ratelimit($str) {
    $mainlimit = explode(" ",$str)[0];
    $upto = explode(" ",$str)[1];
    if (!empty($upto)) {
        $upto = explode("/",$upto)[1];
        $upto = preg_replace('/k|K|m|M/', '', $upto); 
        if ($upto >= 100)
        {
            $upto = number_format($upto / 1024, 1) . 'Mbps';
        } else if ($upto < 100) {
            $upto = 'UpTo ' . $upto . 'Mbps';
        }
        return $upto;
    } else {
        $mainlimit = explode("/",$mainlimit)[1];
        $mainlimit = preg_replace('/k|K|m|M/', '', $mainlimit); 
        if ($mainlimit >= 100)
        {
            $mainlimit = number_format($mainlimit / 1024, 1) . 'Mbps';
        } else if ($mainlimit < 100) {
            $mainlimit = $mainlimit . 'Mbps';
        }
        return $mainlimit;
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran</title>
    <link id="style" href="<?php echo base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body onload="hideDiv()">
  <input type="hidden" id="paymentmode" value="<?= $ref ?>"/>
    <?php
    $session = session();
    $hide = $session->getFlashdata('hide');
    if($hide != null) {
    foreach($hide as $row){ $dnone = $row; }
    } 
    $checked = $session->getFlashdata('checked');
    if($checked != null) {
    foreach($checked as $row){ $checked = $row; }
    } else {
        $checked = "d-none";
    }
    ?>
    <main>
      <div class="container col-xl-10 col-xxl-8">
        <div class="row align-items-center">
          <div class="col-md-12 mx-auto col-lg-5">
          <h4 class="fw-bold text-center"><br><?= $routername ?></h4>
            <div class="btn-group w-100 mt-3" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" onclick="handleClick(this);" value="1" checked>
                <label class="btn btn-outline-primary" for="btnradio1">Beli Voucher</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" onclick="handleClick(this);" value="2" <?= $checked ?>>
                <label class="btn btn-outline-primary" for="btnradio2">Perpanjang</label>
            </div>
            <?php
              $session = session();
              $errors = $session->getFlashdata('error');
              if($errors != null): ?>
                  <div id="notif" class="alert alert-danger mt-3" role="alert">
                      <?php foreach($errors as $err){ echo $err; } ?>
                  </div>
              <?php endif ?>

            <form name="formbayar" id="formbayar" action="<?= base_url('buy_voucher') ?>" method="post" class="p-4 mt-3 border rounded-3 bg-light <?= $dnone; ?>">
            <h5 class="text-center">Beli Voucher</h5>
            <small class="text-muted">Pilih paket voucher, masukan kode voucher yang anda inginkan, lalu pilih metode pembayaran</small>
              <hr class="my-4">
              
              <div class="form-floating mb-3">
                <select name="paket" id="floatingSelect" class="form-select" placeholder="Pilih Paket">
                    <?php 
                    foreach ($hotspot_profile as $row) {
                        $expmode = explode(",", $row['on-login'])[1];
                        if ($expmode == 'rem' || $expmode == 'remc') {
                            if (explode(",", $row['on-login'])[4] != '0' || explode(",", $row['on-login'])[2] != '0') {
                                $getvalid = explode(",", $row['on-login'])[3];
                                if (substr($getvalid, -1) == "d") {
                                    $getvalid = substr($getvalid, 0, -1) . " Hari";
                                } else if (substr($getvalid, -1) == "h") {
                                    $getvalid = substr($getvalid, 0, -1) . " Jam";
                                }
                                if (!empty(explode(",", $row['on-login'])[4])) {
                                    $getsprice = explode(",", $row['on-login'])[4];
                                } else {
                                    $getsprice = explode(",", $row['on-login'])[2];
                                }
                                $ratelimit = $row['rate-limit'];
                                echo '<option value="'.$row['name'].'" class="" >'. ratelimit($ratelimit) . ' | ' . $getvalid . ' | Rp ' . number_format((float)$getsprice,0,',','.') . '</option>';
                            }   
                        } 
                    }
                    ?>
                </select>
                <label for="floatingSelect">Pilih Paket</label>
              </div>
              <div class="form-floating mb-3">
                <input type="hidden" name="userid" value="<?= $userid ?>" required>
                <input type="hidden" name="routerid" value="<?= $routerid ?>" required>
                <input type="hidden" name="template" value="no" required>
                <input type="text" class="form-control" id="floatingInput" placeholder="Kode Voucher" name="kodevoucher" required>
                <label class="text-muted" for="floatingInput">Kode Voucher</label>
              </div>
              <div class="form-floating mb-3">
                <select name="payment_method" id="floatingSelect" class="form-select" placeholder="Kode Pembayaran">
                    <?php foreach ($pmethod as $row) { ?>
                      <option value="<?= $row->kode?>"><?= $row->nama ?></option>
                    <?php } ?>
                </select>
                <label for="floatingSelect">Metode Pembayaran</label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" id="tombolbayar" type="submit">Beli</button>
            </form>


            <form name="formperpanjang" id="formperpanjang" action="<?= base_url('perpanjang_voucher') ?>" method="post" class="p-4 mt-3 border rounded-3 bg-light <?= $checked ?>">
            <h5 class="text-center">Perpanjang Voucher</h5>
            <small class="text-muted">Masukan kode voucher kamu, dan pilih metode pembayaran</small>
              <hr class="my-4">
              
              <div class="form-floating mb-3">
                <input type="hidden" name="userid" value="<?= $userid ?>" required>
                <input type="hidden" name="routerid" value="<?= $routerid ?>" required>
                <input type="hidden" name="template" value="no" required>
                <input type="text" class="form-control" id="floatingInput" placeholder="Kode Voucher" name="kodevoucher" required>
                <label class="text-muted" for="floatingInput">Kode Voucher</label>
              </div>
              <div class="form-floating mb-3">
                <select name="payment_method" id="floatingSelect" class="form-select" placeholder="Kode Pembayaran">
                    <?php foreach ($pmethod as $row) { ?>
                      <option value="<?= $row->kode?>"><?= $row->nama ?></option>
                    <?php } ?>
                </select>
                <label for="floatingSelect">Metode Pembayaran</label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" id="tombolperpanjang" type="submit">Bayar</button>
            </form>
          </div>
        </div>
      </div>
    </main>
    <script>
        const paymentmode = document.getElementById('paymentmode').value;
        if (paymentmode == 'perpanjang') {
          document.getElementById("btnradio2").click();
        } 

        function hideDiv() {
        setTimeout(function(){
            document.getElementById('notif').classList.add('d-none');
        },3000)
        }
        const formElement = document.forms['formbayar'];
        formElement.addEventListener('submit', customHandler);
        function customHandler(e) {
            e.preventDefault();
            document.getElementById("tombolbayar").innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading';
            document.getElementById("tombolbayar").disabled = true;
            formElement.removeEventListener('submit', customHandler);
            formElement.submit();
        }
        const formElement2 = document.forms['formperpanjang'];
        formElement2.addEventListener('submit', customHandler2);
        function customHandler2(e) {
            e.preventDefault();
            document.getElementById("tombolperpanjang").innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading';
            document.getElementById("tombolperpanjang").disabled = true;
            formElement2.removeEventListener('submit', customHandler);
            formElement2.submit();
        }
        var currentValue = 0;
        function handleClick(btnradio) {
            currentValue = btnradio.value;
            if (currentValue == '2') {
                document.getElementById('formbayar').classList.add('d-none');
                document.getElementById('formperpanjang').classList.remove('d-none');
            } else {
                document.getElementById('formbayar').classList.remove('d-none');
                document.getElementById('formperpanjang').classList.add('d-none');
            }
        }
    </script>
  </body>
</html>
