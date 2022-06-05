<?php foreach ($router as $row) {
    $routername = $row->router_name;
    $routerdns = $row->router_dns;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ISOLIR</title>
    <link id="style" href="<?php echo base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    
<main>
  <div class="px-4 py-5 my-5 text-center">
    <h5 class="display-5 fw-bold">Pelanggan <?= $routername ?> yang terhormat 🙏</h5>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Kami informasikan bahwa layanan internet anda saat ini terisolir, Mohon maaf atas ketidak nyamanannya. Agar dapat digunakan kembali, dimohon untuk melakukan pembayaran. Silahkan klik tombol "Pembayaran" di bawah ini untuk melakukan pembayaran, terima kasih.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="<?= base_url('payment') . '/' . $userid . '/' . $routerid ?>" class="btn btn-primary">Pembayaran ></a>
      </div>
    </div>
  </div>

</main>
      
  </body>
</html>
