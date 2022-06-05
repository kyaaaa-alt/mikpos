
                        <!-- ROW-2 -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">

                                    <div class="card-body">
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
                                            <table id="example2" class="table table-bordered text-nowrap border-bottom">
                                                <thead>
                                                    <tr>
                                                        <th>EXP DATE</th>
                                                        <th>NAMA</th>
                                                        <th>PROFILE</th>
                                                        <th>STATUS</th>
                                                        <th class="text-center">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    foreach ($result as $row) { 
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php if ($row->limituptime == '1s') { ?>
                                                                <span class="badge bg-dark text-warning">
                                                                    <span class="tgl"><?= $row->tanggal ?></span>
                                                                </span>
                                                            <?php } else { ?>
                                                                <span class="badge bg-dark">
                                                                    <span class="tgl"><?= $row->tanggal ?></span>
                                                                </span>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?= $row->name ?></td>
                                                        <td><?= $row->profile ?></td>
                                                        <td>
                                                            <?php if ($row->limituptime == '1s') { ?>
                                                                <span class="text-warning">
                                                                    KADALUARSA
                                                                </span>
                                                            <?php } else { echo '<span>AKTIF</span>'; }?>

                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle my-1" style="line-height: 0.8 !important;" data-bs-toggle="dropdown">
                                                                    Action <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <li><a href="" data-bs-toggle="modal" data-bs-target="#modalperpanjang"
                                                                           data-uid="<?= $row->uid ?>"
                                                                           data-uname="<?= $row->name ?>"
                                                                           data-ulimit="<?= $row->limituptime ?>">Perpanjang</a></li>
                                                                </ul>
                                                            </div>

                                                        </td>
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

<!-- Modal Perpanjang-->
<div class="modal fade" id="modalperpanjang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perpanjang user : <span id="uname"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="number" id="p1" class="form-control" value="1">
                    <select class="form-control" id="p2">
                        <option value="days" selected>Hari</option>
                        <option value="months">Bulan</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal
                </button>
                <button type="button" id="extendnow" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>

    $('#modalperpanjang').on('show.bs.modal', function(e) {
        var uid = $(e.relatedTarget).data('uid');
        var uname = $(e.relatedTarget).data('uname');
        var ulimit = $(e.relatedTarget).data('ulimit');
        $('#uname').html(uname);
        $('#extendnow').attr('data-uid', uid);
        $('#extendnow').attr('data-ulimit', ulimit);

    });
    $('#extendnow').on('click', function(event) {
        var uid = $(this).data('uid');
        var ulimit = $(this).data('ulimit');
        var p1 = $('#p1').val();
        var p2 = $('#p2').val();
        $.ajax({
            url : "<?= base_url('u/do_change_expire') ?>",
            method : "POST",
            data : {uid: uid, p1: p1, p2: p2, ulimit: ulimit},
            async : true,
            dataType : 'html',
            success: function($hasil){
                if($hasil == 'ok'){
                    location.reload();
                } else {
                    location.reload();
                }
            }
        });
    });

</script>
            
    