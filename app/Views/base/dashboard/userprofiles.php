<?php
$profiles = 0;
foreach ($profile as $row){
    $totalprofiles = $profiles++;
}
?>
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
                <a class="btn btn-primary btn-sm ms-2 mb-2" id="adduserprofile" href="adduserprofile"><i class="fa fa-plus-circle"></i> Add User Profile</a>
                    <table class="table table-bordered text-nowrap border-bottom tabelcustom">
                        <thead>
                        <tr>
                            <th class="text-center"><?= $totalprofiles ?></th>
                            <th>NAMA</th>
                            <th>SHARED USER</th>
                            <th>RATE LIMIT</th>
                            <th>EXPIRED MODE</th>
                            <th>MASA AKTIF</th>
                            <th>PRICE</th>
                            <th>SELLING PRICE</th>
                            <th>LOCK USER</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($profile as $row) {
                                $pid = $row['.id'];
                                $pname = $row['name'];
                                $pshared = $row['shared-users'];
                                $prlimit = $row['rate-limit'];
                                $ponlogin = $row['on-login'];
                                $getvalid = explode(",", $ponlogin)[3];
                                $getprice = explode(",", $ponlogin)[2];
                                $getsprice = explode(",", $ponlogin)[4];
                                $getl = explode(",", $ponlogin)[6];
                                $getexpmode = explode(",", $ponlogin);
                                $expmode = $getexpmode[1];
                                $parentqueue = $row['parent-queue'];
                                $addrpool = $row['address-pool'];

                                $arraykey = array_search($pname, array_column($sch, 'name'));
                                $monid = $sch[$arraykey]['.id'];
                                $pmon = $sch[$arraykey]["name"];
                                $chkpmon = $sch[$arraykey]['disabled'];
                                if ($pmon != $pname || $chkpmon == "true") {
                                    $moncolor = "text-warning";
                                } else {
                                    $moncolor = "text-green";
                                }

                            ?>
                            <tr>
                                <td class="text-center">
                                    <form style="display:inline !important;" action="<?= base_url('u/do_remove_userprofile') ?>" method="post">
                                        <input type="hidden" name="pid" value="<?= $pid ?>">
                                        <input type="hidden" name="pname" value="<?= $pname ?>">
                                        <input type="hidden" name="monstate" value="<?= $moncolor ?>">
                                        <a href="#/" onclick="Swal.fire({title: 'Are you sure?',text: 'You wont be able to revert this!',icon: 'warning',showCancelButton: true,cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) => {if (result.isConfirmed) {this.closest('form').submit();return false;}})">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </form>

                                </td>
                                <td>
                                    <i class="fa fa-circle <?= $moncolor ?> me-3"></i>
                                    <a href="" id="btnedit" class="text-white" data-bs-toggle="modal" data-bs-target="#modaledit"
                                       data-pid="<?= $pid ?>"
                                       data-pname="<?= $pname ?>"
                                       data-pshared="<?= $pshared ?>"
                                       data-prlimit="<?= $prlimit ?>"
                                       data-valid="<?= $getvalid ?>"
                                       data-price="<?= $getprice ?>"
                                       data-sprice="<?= $getsprice ?>"
                                       data-getl="<?= $getl ?>"
                                       data-parentq="<?= $parentqueue ?>"
                                       data-addrpool="<?= $addrpool ?>"
                                        data-expmode="<?= $expmode ?>">
                                        <i class="fa fa-edit"></i>
                                        <?= $pname ?>
                                    </a>
                                </td>
                                <td><?= $pshared ?></td>
                                <td><?= $prlimit ?></td>
                                <td>
                                    <?php
                                    if ($expmode == "rem") {
                                        echo "Remove";
                                    } elseif ($expmode == "ntf") {
                                        echo "Notice";
                                    } elseif ($expmode == "remc") {
                                        echo "Remove & Record";
                                    } elseif ($expmode == "ntfc") {
                                        echo "Notice & Record";
                                    } else {
                                    }
                                    ?>
                                </td>
                                <td><?= $getvalid ?></td>
                                <td>
                                    <?php if ($getprice != 0) { ?>
                                        <?= rupiah($getprice) ?>
                                    <?php } ?>
                                </td>
                                <td><?php if ($getsprice != 0) { ?>
                                        <?= rupiah($getsprice) ?>
                                    <?php } ?></td>
                                <td><?= $getl ?></td>
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

<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit: <span id="editpname"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form autocomplete="off" name="formedit" method="post" action="<?php echo base_url('u/do_edit_userprofile'); ?>">
            <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="pname" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="pid" name="pid" required>
                            <input type="text" class="form-control" id="pname" name="pname" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ppool" class="col-sm-2 col-form-label">Address Pool</label>
                        <div class="col-sm-10">
                            <select class="form-select " id="ppool" name="ppool">
                                <option value="none" selected>none</option>
                                <?php foreach($pool as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pshared" class="col-sm-2 col-form-label">Shared User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pshared" name="pshared">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="plimit" class="col-sm-2 col-form-label">Rate Limit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="plimit" name="plimit">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pexpmode" class="col-sm-2 col-form-label">Expired Mode</label>
                        <div class="col-sm-10">
                            <select class="form-select " id="pexpmode" name="pexpmode">
                                <option value="0" selected>none</option>
                                <option value="rem">Remove</option>
                                <option value="remc">Remove & Record</option>
                                <option value="ntf">Notice</option>
                                <option value="ntfc">Notice & Record</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row" id="dvalidity" style="display: none;">
                        <label for="pvalidity" class="col-sm-2 col-form-label">Masa Aktif</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pvalidity" name="pvalidity">
                            <input type="hidden" class="form-control" id="graceperiod" name="graceperiod" value="5m">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pprice" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pprice" name="pprice">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="psellingprice" class="col-sm-2 col-form-label">Selling Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="psellingprice" name="psellingprice">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="plock" class="col-sm-2 col-form-label">Lock User</label>
                        <div class="col-sm-10">
                            <select class="form-select " id="plock" name="plock">
                                <option value="Disable">Disable</option>
                                <option value="Enable">Enable</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pqueue" class="col-sm-2 col-form-label">Parent Queue</label>
                        <div class="col-sm-10">
                            <select class="form-select " id="pqueue" name="pqueue">
                                <option selected>none</option>
                                <?php foreach($pqueue as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <div class="float-start">

                </div>
                <div class="float-end">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="simpanedituser" class="btn btn-primary">Simpan</button>

                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("form[name='formedit']").submit(function(){
        $("#simpanedituser").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Process...');
        $("#simpanedituser").prop("disabled", true);
        $("form[name='formedit']")[0].submit();
    });
    $('#modaledit').on('show.bs.modal', function(e) {
        $('#pid').val($(e.relatedTarget).data('pid'));
        $('#editpname').html($(e.relatedTarget).data('pname'));
        $('#pname').val($(e.relatedTarget).data('pname'));
        if ($(e.relatedTarget).data('addrpool') == '') {
            $('#ppool').val('none').change();
        } else {
            $('#ppool').val($(e.relatedTarget).data('addrpool')).change();
        }
        $('#pshared').val($(e.relatedTarget).data('pshared'));
        $('#plimit').val($(e.relatedTarget).data('prlimit'));
        if ($(e.relatedTarget).data('expmode') == "rem") {
            $('#pexpmode').val('rem').change();
        } else if ($(e.relatedTarget).data('expmode') == "ntf") {
            $('#pexpmode').val('ntf').change();
        } else if ($(e.relatedTarget).data('expmode') == "remc") {
            $('#pexpmode').val('remc').change();
        } else if ($(e.relatedTarget).data('expmode') == "ntfc") {
            $('#pexpmode').val('ntfc').change();
        } else {
        }
        $('#pprice').val($(e.relatedTarget).data('price'));
        $('#psellingprice').val($(e.relatedTarget).data('sprice'));
        $('#plock').val($(e.relatedTarget).data('getl'));
        $('#pqueue').val($(e.relatedTarget).data('parentq'));
        $('#pvalidity').val($(e.relatedTarget).data('valid'));
    });
    $("#pexpmode").change(function() {
        if ($('#pexpmode').val() == '0') {
            $('#dvalidity').hide();
        } else {
            $('#dvalidity').show();
        }
    });
</script>