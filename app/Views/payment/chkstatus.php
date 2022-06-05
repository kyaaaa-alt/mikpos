<?php foreach ($router as $row) {
    $routerid = $row->id;
    $userid = $row->user_id;
    $routername = $row->router_name;
    $routerdns = $row->router_dns;
}
if(isset($_POST['kodemember'])){
    header('Location: ' . base_url('status') . '/' . $userid . '/' . $routerid . '/' . $_POST['kodemember']);
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Status Voucher</title>
    <link id="style" href="<?php echo base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body onload="hideDiv()">   
    <main>
      <div class="container col-xl-10 col-xxl-8">
        <div class="row align-items-center g-lg-4 py-4">
          <div class="col-md-12 mx-auto col-lg-5">
          <h4 class="fw-bold text-center">Cek Status Voucher<br><?= $routername ?></h4>
            <form method="post" class="p-4 p-md-5 border rounded-3 bg-light">
              <small class="text-muted">Masukan kode Voucher :</small>
              <hr class="my-4">
              <?php
              $session = session();
              $errors = $session->getFlashdata('error');
              if($errors != null): ?>
                  <div id="notif" class="alert alert-danger" role="alert">
                      <i class="fa fa-frown-o me-2" aria-hidden="true"></i>
                      <?php foreach($errors as $err){ echo $err; } ?>
                  </div>
              <?php endif ?>

              <?php
              $session = session();
              $success = $session->getFlashdata('success');
              if($success != null): ?>
                  <div id="notif" class="alert alert-success" role="alert">
                      <i class="fa fa-smile-o me-2" aria-hidden="true"></i>
                      <?php foreach($success as $suc){ echo $suc; } ?>
                  </div>
              <?php endif ?>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Kode Voucher" name="kodemember" required>
                <label class="text-muted" for="floatingInput">Kode Voucher</label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" id="cek" name="cek" type="submit">Cek Status</button>
            </form>
          </div>
        </div>
      </div>
    </main>
    <script>
    function hideDiv() {
    setTimeout(function(){
        document.getElementById('notif').classList.add('d-none');
    },3000)
    }
    function redirect(){       
        window.location.href="<?= base_url('validity') . '/' . $userid . '/' . $routerid . '/' ?>" + document.getElementById("kodemember").value;              
    }
    </script>
  </body>
</html>
