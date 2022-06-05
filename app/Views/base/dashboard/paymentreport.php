<!-- ROW-2 -->
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <?php
                $session = session();
                $hapuss = $session->getFlashdata('hapuss');
                if($hapuss != null): ?>
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-trash me-2" aria-hidden="true"></i>
                        <?php foreach($hapuss as $dell){ echo $dell; } ?>
                    </div>
                <?php endif ?>

                <?php
                $session = session();
                $errors = $session->getFlashdata('error');
                if($errors != null): ?>
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-frown-o me-2" aria-hidden="true"></i>
                        <?php foreach($errors as $err){ echo $err; } ?>
                    </div>
                <?php endif ?>

                <?php
                $session = session();
                $success = $session->getFlashdata('success');
                if($success != null): ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-smile-o me-2" aria-hidden="true"></i>
                        <?php foreach($success as $suc){ echo $suc; } ?>
                    </div>
                <?php endif ?>
                <div class="table-responsive">
                
                    <table id="responsive-datatable2" class="table table-bordered text-nowrap border-bottom w-100">
                        <thead>
                        <tr>
                            <th class="text-center" style="display:none;"></th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Service</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Query Status</th>
                            <th class="text-center">Invoice</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            foreach ($transaksi as $row) {
                            $paytype = explode("/",$row->merchant_ref)[0];  
                            $name = $row->customer_name;  
                            $tanggal = date("d/m/y H:i:s", strtotime($row->updated_at));
                            $amount = "Rp " . number_format($row->amount_received,0,',','.');            
                            ?>
                            <tr>
                                <td class="text-center d-none"><?= $num++ ?></td>
                                <td><?= $tanggal ?></td>
                                <td><?php 
                                if ($paytype == 'INVP') {
                                    echo 'Perpanjang: ' . $name;
                                } else if ($paytype == 'INVB'){
                                    echo 'Beli: ' . $name;
                                } else {
                                    echo 'Perpanjang: ' . $name;
                                }
                                ?></td>
                                <td><?= $row->service ?></td>
                                <td><?= $amount ?></td>
                                <td><?= $row->status ?></td>
                                <td><?= $row->query_status ?></td>
                                <td class="text-center"><a href="<?= $row->return_url ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Invoice</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- COL END -->
</div>
<!-- ROW-2 END -->