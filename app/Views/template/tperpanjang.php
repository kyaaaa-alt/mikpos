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
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 mx-auto col-lg-5">
            <?php
              $session = session();
              $errors = $session->getFlashdata('error');
              if($errors != null): ?>
                  <div id="notif" class="alert alert-danger mt-3" role="alert">
                      <?php foreach($errors as $err){ echo $err; } ?>
                  </div>
              <?php endif ?>

            <form name="formperpanjang" id="formperpanjang" action="<?= base_url('perpanjang_voucher') ?>" method="post" class="mt-1">
            <small class="text-muted ml-2">Masukan kode voucher kamu, dan pilih metode pembayaran</small>
              
              <div class="form-floating mb-2 mt-2">
                <input type="hidden" name="userid" value="<?= $userid ?>" required>
                <input type="hidden" name="routerid" value="<?= $routerid ?>" required>
                <input type="hidden" name="template" value="yes" required>
                <input type="text" class="form-control" id="floatingInput" placeholder="Kode Voucher" name="kodevoucher" required>
                <label class="text-muted" for="floatingInput">Kode Voucher</label>
              </div>
              <div class="form-floating mb-2">
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
        const formElement = document.forms['formperpanjang'];
        formElement.addEventListener('submit', customHandler);
        function customHandler(e) {
            e.preventDefault();
            document.getElementById("tombolperpanjang").innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading';
            document.getElementById("tombolperpanjang").disabled = true;
            formElement.removeEventListener('submit', customHandler);
            formElement.submit();
        }
        function hideDiv() {
        setTimeout(function(){
            document.getElementById('notif').classList.add('d-none');
        },4000)
        }
    </script>
  </body>
</html>
