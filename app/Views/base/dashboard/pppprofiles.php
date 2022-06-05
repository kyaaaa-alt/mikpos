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
                <button class="btn btn-primary btn-sm ms-2 mb-2" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus-circle"></i> Add PPPoE Profile</button>
                    <table class="table table-bordered text-nowrap border-bottom tabelcustom">
                        <thead>
                        <tr>
                            <th class="text-center"><?= $totalprofiles ?></th>
                            <th>Nama</th>
                            <th>Local Address</th>
                            <th>Remote Address</th>
                            <th>Rate Limit</th>
                            <th>Only One</th>
                            <th>Parent Queue</th>
                            <th>Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($profile as $row) {
                                $pid = $row['.id'];
                                $pname = $row['name'];
                                $plocal = $row['local-address'];
                                $premote = $row['remote-address'];
                                $prlimit = $row['rate-limit'];
                                $parentqueue = $row['parent-queue'];
                                $onlyone = $row['only-one'];
                                $pcomment = $row['comment'];
                            ?>
                            <tr>
                                <td class="text-center">
                                    <form style="display:inline !important;" action="<?= base_url('u/do_remove_pppprofile') ?>" method="post">
                                        <input type="hidden" name="pid" value="<?= $pid ?>">
                                        <a href="#/" onclick="Swal.fire({title: 'Are you sure?',text: 'You wont be able to revert this!',icon: 'warning',showCancelButton: true,cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) => {if (result.isConfirmed) {this.closest('form').submit();return false;}})">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </form>

                                </td>
                                <td>
                                    <a href="" id="btnedit" class="text-white" data-bs-toggle="modal" data-bs-target="#modaledit"
                                       data-pid="<?= $pid ?>"
                                       data-pname="<?= $pname ?>"
                                       data-prlimit="<?= $prlimit ?>"
                                       data-parentq="<?= $parentqueue ?>"
                                       data-plocal="<?= $plocal ?>"
                                       data-premote="<?= $premote ?>"
                                       data-pcomment="<?= $pcomment ?>">
                                        <i class="fa fa-edit"></i>
                                        <?= $pname ?>
                                    </a>
                                </td>
                                <td><?= $plocal ?></td>
                                <td><?= $premote ?></td>
                                <td><?= $prlimit ?></td>
                                <td><?= $onlyone ?></td>
                                <td><?= $parentqueue ?></td>
                                <td><?= $pcomment ?></td>
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
            <form autocomplete="off" name="formedit" method="post" action="<?php echo base_url('u/do_edit_pppprofile'); ?>">
            <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="pname" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="pid" name="pid" required>
                            <input type="text" class="form-control" id="pname" name="pname" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ppool" class="col-sm-2 col-form-label">Local Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mt-1" autocomplete="off" id="plocal" name="plocal" list="pool">
                            <datalist id="pool">
                                <option value="none" selected>none</option>
                                <?php foreach($pool as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ppool" class="col-sm-2 col-form-label">Remote Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mt-1" autocomplete="off" id="premote" name="premote" list="pool">
                            <datalist id="pool">
                                <option value="none" selected>none</option>
                                <?php foreach($pool as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="prlimit" class="col-sm-2 col-form-label">Rate Limit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prlimit" name="prlimit" required>
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
                    <div class="mb-3 row">
                        <label for="pcomment" class="col-sm-2 col-form-label">Comment</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pcomment" name="pcomment">
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

<!-- modal add -->
<div class="modal fade" id="modaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add PPP Profile<span id="editpname"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form autocomplete="off" name="formadd" method="post" action="<?php echo base_url('u/do_add_pppprofile'); ?>">
            <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="pname" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pname" name="pname" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ppool" class="col-sm-2 col-form-label">Local Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mt-1" autocomplete="off" id="plocal" name="plocal" list="pool">
                            <datalist id="pool">
                                <option value="none" selected>none</option>
                                <?php foreach($pool as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ppool" class="col-sm-2 col-form-label">Remote Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mt-1" autocomplete="off" id="premote" name="premote" list="pool">
                            <datalist id="pool">
                                <option value="none" selected>none</option>
                                <?php foreach($pool as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="prlimit" class="col-sm-2 col-form-label">Rate Limit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prlimit" name="prlimit" required>
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
                    <div class="mb-3 row">
                        <label for="pcomment" class="col-sm-2 col-form-label">Comment</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pcomment" name="pcomment">
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <div class="float-start">

                </div>
                <div class="float-end">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="simpanadduser" class="btn btn-primary">Simpan</button>

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
    $("form[name='formadd']").submit(function(){
        $("#simpanadduser").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Process...');
        $("#simpanadduser").prop("disabled", true);
        $("form[name='formadd']")[0].submit();
    });
    $('#modaledit').on('show.bs.modal', function(e) {
        $('#pname').val($(e.relatedTarget).data('pname'));
        $('#pid').val($(e.relatedTarget).data('pid'));
        $('#editpname').html($(e.relatedTarget).data('pname'));
        $('#premote').val($(e.relatedTarget).data('premote'));
        $('#plocal').val($(e.relatedTarget).data('plocal'));
        $('#pcomment').val($(e.relatedTarget).data('pcomment'));
        $('#prlimit').val($(e.relatedTarget).data('prlimit'));
        $('#pqueue').val($(e.relatedTarget).data('parentq'));
    });
   
</script>