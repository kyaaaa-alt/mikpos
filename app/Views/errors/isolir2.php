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
    <h2 class="fw-bold">Halo kak, <span class="text-primary">"<?= $username ?>"</span> 🙏</h2>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Kami informasikan bahwa layanan internet anda saat ini terisolir dan sementara tidak dapat digunakan, agar tidak terkena isolir otomatis, diharap untuk melakukan pembayaran sebelum tanggal kadaluarsa akun anda. Agar dapat digunakan kembali, silahkan klik tombol dibawah untuk perpanjang akun anda.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="<?= base_url('voucher') . '/' . $userid . '/' . $routerid  . '/perpanjang'?>" class="btn btn-primary">Perpanjang ></a>
      </div>
    </div>
  </div>

</main>
      
  </body>
</html>
