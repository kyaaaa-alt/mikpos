<?php foreach ($router as $row) {
    $routerid = $row->id;
    $userid = $row->user_id;
    $routername = $row->router_name;
    $routerdns = $row->router_dns;
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
    <main>
      <div class="container col-xl-10 col-xxl-8">
        <div class="row align-items-center g-lg-5 py-5">
          <div class="col-md-12 mx-auto col-lg-5">
          <h4 class="fw-bold text-center">Perpanjang Member<br><?= $routername ?></h4>
            <form name="formbayar" id="formbayar" action="<?= base_url('ppp_req_payment') ?>" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
              <small class="text-muted">Masukan kode member & pilih metode pembayaran</small>
              <hr class="my-4">
              <?php
              $session = session();
              $errors = $session->getFlashdata('error');
              if($errors != null): ?>
                  <div id="notif" class="alert alert-danger" role="alert">
                      <?php foreach($errors as $err){ echo $err; } ?>
                  </div>
              <?php endif ?>

              <?php
              $session = session();
              $success = $session->getFlashdata('success');
              if($success != null): ?>
                  <div id="notif" class="alert alert-success" role="alert">
                      <?php foreach($success as $suc){ echo $suc; } ?>
                  </div>
              <?php endif ?>
              <div class="form-floating mb-3">
                <input type="hidden" name="userid" value="<?= $userid ?>" required>
                <input type="hidden" name="routerid" value="<?= $routerid ?>" required>
                <input type="text" class="form-control" id="floatingInput" placeholder="Kode Member" name="kodepembayaran" required>
                <label class="text-muted" for="floatingInput">Kode Member</label>
              </div>
              <div class="form-floating mb-3">
                <select name="payment_method" id="floatingSelect" class="form-select" placeholder="Kode Pembayaran">
                    <?php foreach ($pmethod as $row) { ?>
                      <option value="<?= $row->kode?>"><?= $row->nama ?></option>
                    <?php } ?>
                </select>
                <label for="floatingSelect">Metode Pembayaran</label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" id="tombolbayar" type="submit">Bayar</button>
            </form>
          </div>
        </div>
      </div>
    </main>
    <script>
      function hideDiv() {
        setTimeout(function(){
          document.getElementById('notif').classList.add('d-none');
        },8000)
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
    </script>
  </body>
</html>
