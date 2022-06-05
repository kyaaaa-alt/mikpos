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
<title>Status: <?= $membername ?></title>
<link id="style" href="<?php echo base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<style>
@media only screen and (max-width: 600px) {
    .memberdetail {
        margin-left:1px;
    }
    .mob1 {
        margin-top:5px !important;
    }
}
</style>
</head>
<body class="bg-dark">
<div class="container" style="max-width:500px;">
    <div class="row p-3 m-1 mt-4 rounded bg-light mob1">
        <div class="text-center" style="margin-left:1px;">
            <h4>Member Detail</h4>
        </div>
        <div class="col-md-7 col-lg-12">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Kode Member</h6>
                    </div>
                    <div>
                        <h6><?= $membername ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Masa Aktif</h6>
                    </div>
                    <div>
                        <h6><?= $validity ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Kadaluarsa</h6>
                    </div>
                    <div>
                        <h6><?= $expdate ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Status</h6>
                    </div>
                    <div>
                        <h6><?= $status ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Biaya Perpanjang</h6>
                    </div>
                    <div>
                        <h6><?= $price ?></h6>
                    </div>
                </li>
            </ul>
        </div>
        <hr class="my-4">
        <span class="text-center" > Klik tombol di bawah ini untuk perpanjang layanan anda.<span> 
        <div class="d-flex justify-content-center mt-3">
            <a href="<?= base_url('payment') . '/' . $userid . '/' . $routerid ?>" class="btn btn-primary me-2" type="button">Perpanjang</a>
            <button type="button" class="btn btn-primary" onclick='openModal()'>Riwayat</button>
            <br/> 
        </div>
    
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
role="dialog">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Riwayat Perpanjang</h5>
        </div>
        
        <div class="modal-body" style="padding:0 !important;">
        <table class="table table-striped">
            <thead>
                <tr>
                <th class="text-center" scope="col" style="display:none;">#</th>
                <th class="text-center" scope="col">Tanggal</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Invoice</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $num = 1;
                foreach ($riwayat as $row) {?>
                <tr>
                    <th class="text-center" scope="row" style="display:none;"><?= $num++ ?></th>
                    <td class="text-center"><?= date("d/m/y h:i", strtotime($row->updated_at)) ?></td>
                    <td class="text-center">
                        <?php 
                        if ($row->status == 'UNPAID') {
                            echo '<small class="text-danger">Menunggu Pembayaran</small>';
                        } else if ($row->status == 'PAID') {
                            echo '<small class="text-success">Sudah Lunas</small>';
                        } else if ($row->status == 'EXPIRED') {
                            echo '<small class="text-danger">Kadaluarsa</small>';
                        } else {
                            echo '<small class="text-danger">Gagal</small>';
                        }
                        ?>
                    </td>
                    <td class="text-center"><a target="_blank" href="<?= $row->return_url ?>" class="btn btn-primary btn-sm" type="button">Buka Invoice</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-secondary btn-sm" onclick="closeModal()">Tutup</button>
        </div>
    </div>
</div>
</div>
<div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>

<script>
    function openModal() {
        document.getElementById("backdrop").style.display = "block";
        document.getElementById("exampleModal").style.display = "block";
        document.getElementById("exampleModal").classList.add("show");
    }
    function closeModal() {
        document.getElementById("backdrop").style.display = "none";
        document.getElementById("exampleModal").style.display = "none";
        document.getElementById("exampleModal").classList.remove("show");
    }
</script>
</body>
</html>
