<?php
$countsecret = 1;
foreach ($secrets as $row){
    $totalsecrets = $countsecret++;
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
                
                    <table id="basic-datatable2" class="table table-bordered text-nowrap border-bottom">
                        <thead>
                        <tr>
                            <th class="text-center"><?= $totalsecrets ?></th>
                            <th>Nama</th>
                            <th>Active Profile</th>
                            <th>Local Address</th>
                            <th>Remote Address</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $countresponse = count($secrets);
                            for ($i = 0; $i < $countresponse; $i++) {
                                $row = $secrets[$i];
                                $sid = $row['.id'];
                                $sname = $row['name'];
                                $spass = $row['password'];
                                $sprofile = $row['profile'];
                                $slocal = $row['local-address'];
                                $sremote = $row['remote-address'];
                                $scomment = $row['comment'];
                                $disabled = $row['disabled'];     
                                if ($scomment == 'EXPIRED') {
                                    $status = '<span class="text-warning">Isolir/Expired</span>';
                                } else {
                                    $status = '';
                                }           
                            ?>
                            <tr>
                                <td class="text-center">
                                    <form style="display:inline !important;" action="<?= base_url('u/do_remove_pppsecret') ?>" method="post">
                                        <input type="hidden" name="sid" value="<?= $sid ?>">
                                        <input type="hidden" name="schid" value="schid">
                                        <a href="#/" class="me-1" onclick="Swal.fire({title: 'Delete <?= $sname ?>?',text: 'You wont be able to revert this!',icon: 'warning',showCancelButton: true,cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) => {if (result.isConfirmed) {this.closest('form').submit();return false;}})">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </form>

                                    <a href="" id="btnedit" class="text-white me-1" data-bs-toggle="modal" data-bs-target="#modalinfo"
                                       data-secretid="<?= $sid ?>"
                                       data-secretname="<?= $sname ?>">
                                        <i class="fa fa-th-list"></i>
                                    </a>

                                    <?php if ($disabled == 'false') { ?>
                                        <form style="display:inline !important;" id="" action="<?= base_url('u/do_disable_pppsecret') ?>" method="post">
                                            <input type="hidden" name="sid" value="<?= $sid ?>">
                                            <a href="#/" onclick="this.closest('form').submit();return false;">
                                                <i class="fa fa-unlock text-success"></i>
                                            </a>
                                        </form>
                                    <?php } else { ?>
                                        <form style="display:inline !important;" id="" action="<?= base_url('u/do_enable_pppsecret') ?>" method="post">
                                            <input type="hidden" name="sid" value="<?= $sid ?>">
                                            <a href="#/" onclick="this.closest('form').submit();return false;">
                                                <i class="fa fa-lock text-warning"></i>
                                            </a>
                                        </form>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="" id="btnedit" class="text-white" data-bs-toggle="modal" data-bs-target="#modaledit"
                                       data-sid="<?= $sid ?>"
                                       data-ename="<?= $sname ?>"
                                       data-epass="<?= $spass ?>"
                                       data-elocaladdress="<?= $slocal ?>"
                                       data-eremoteaddress="<?= $sremote ?>">
                                        <i class="fa fa-edit"></i>
                                        <?= $sname ?>
                                    </a>
                                </td>
                                <td><?= $sprofile ?></td>
                                <td><?= $slocal ?></td>
                                <td><?= $sremote ?></td>
                                <td><?= $status ?></td>
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



<!-- modal edit -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit: <span id="enametitle"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form autocomplete="off" name="formedit" method="post" action="<?php echo base_url('u/do_edit_pppsecret'); ?>">
            <div class="modal-body">
            <div class="mb-3 row">
                    <label for="ename" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="eid" name="eid" required>                      
                        <input type="text" class="form-control" id="ename" name="ename" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="epass" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="epass" name="epass" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="elocaladdress" class="col-sm-2 col-form-label">Local Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control mt-1"  id="elocaladdress" name="elocaladdress">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="eremoteaddress" class="col-sm-2 col-form-label">Remote Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control mt-1" id="eremoteaddress" name="eremoteaddress">
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
                <h5 class="modal-title" id="exampleModalLabel">Add PPP Secret<span id="editpname"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form autocomplete="off" name="formadd" method="post" action="<?php echo base_url('u/do_add_pppsecret'); ?>">
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="sname" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sname" name="sname" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="spass" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="spass" name="spass" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="mainprofile" class="col-sm-2 col-form-label">Main Profile</label>
                    <div class="col-sm-10">
                        <select class="form-select " id="mainprofile" name="mainprofile" required>
                            <?php foreach($profile as $row) { ?>
                                <option value="<?= $row['name']?>"><?= $row['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="fupprofile" class="col-sm-2 col-form-label">FUP Profile</label>
                    <div class="col-sm-10">
                        <select class="form-select " id="fupprofile" name="fupprofile" required>
                            <?php foreach($profile as $row) { ?>
                                <option value="<?= $row['name']?>"><?= $row['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="localaddress" class="col-sm-2 col-form-label">Local Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control mt-1"  id="localaddress" name="localaddress">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="remoteadress" class="col-sm-2 col-form-label">Remote Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control mt-1" id="remoteadress" name="remoteadress">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="validity" class="col-sm-2 col-form-label">Masa Aktif</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control mt-1" id="validity" name="validity" placeholder="Contoh : 30d" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="graceperiod" class="col-sm-2 col-form-label">Masa Tenggang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control mt-1" id="graceperiod" name="graceperiod" placeholder="Contoh : 5d" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control mt-1" id="harga" name="harga" placeholder="Contoh : 150000" value="" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="startdate" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control mt-1" id="startdate" name="startdate" value="<?= $today ?>" required>
                    </div>
                </div>
                <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="simpanadduser" class="btn btn-primary">Simpan</button>
                    </div>
                </div> 
            </div>
            <div class="modal-footer justify-content-between">
                <div class="float-start">
                * Format masa aktif & masa tenggang : 30d = 30 hari, 12h = 12jam, 4w3d = 31 hari.
                <br/>* Format start date : bulan/tanggal/tahun | jan/01/2018 
                <br/>*Penulisan format bulan : jan,feb,mar,apr,may,jun,jul,aug,sep,oct,nov,dec
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- modal info -->
<div class="modal fade" id="modalinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="infoheader" class="modal-header">
                <button type="button" id="btnconvert" class="btn btn-sm btn-primary me-1">Convert</button>
                
                <form id="btnperpanjang" style="display:inline !important;" action="<?= base_url('u/do_extend_pppsecret') ?>" method="post">
                    <input type="hidden" id="secret_id" name="sid" value="">
                    <input type="hidden" id="sch_id" name="schid" value="">
                    <input type="hidden" id="sch_name" name="sname" value="">
                    <input type="hidden" id="sch_startdate" name="startdate" value="">
                    <input type="hidden" id="sch_enddate" name="enddate" value="">
                    <input type="hidden" id="sch_mainprofile" name="mainprofile" value="">
                    <input type="hidden" id="sch_fupprofile" name="fupprofile" value="">
                    <input type="hidden" id="sch_masaktif"  name="masaktif" value="">
                    <input type="hidden" id="sch_graceperiod" name="graceperiod" value="">
                    <input type="hidden" id="sch_pppactiveid" name="pppactiveid" value="">
                    <input type="hidden" id="sch_exharga" name="exharga" value="">
                    <a href="#/"class="btn btn-sm btn-primary me-1" onclick="document.getElementById('btnclosemodal').click();Swal.fire({text: 'Perpanjang ' + document.getElementById('sch_name').value + ' selama ' + document.getElementById('sch_masaktif').value + ' ?',icon: 'question',reverseButtons: true,showCancelButton: true,cancelButtonColor: '#d33',confirmButtonText: 'Ya, Perpanjang!'}).then((result) => {if (result.isConfirmed) {Swal.fire({allowOutsideClick: false,showConfirmButton: false,didOpen: () => {Swal.showLoading();this.closest('form').submit();return false;},})}})">
                        Perpanjang
                    </a>
                </form>

                <button type="button" id="btnharga" class="btn btn-sm btn-primary">Ubah Harga</button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnclosemodal" aria-label="Close"><i class="fa fa-times text-white"></i></button>
            </div>
            <div class="modal-body">

                <div id="infospinner" class="text-center">
                    <div class="spinner-grow text-light">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div id="notmikpaysecret" class="text-center">
                    <div class="text-center text-white">
                        User (<span id="infoname2" class="text-white"></span>) ini tidak dibuat di aplikasi mikpos, anda dapat meng-convert dengan meng-klik tombol convert di atas.
                    </div>
                </div>

                <div id="divharga">
                    <form style="display:inline !important;" name="formharga" action="<?= base_url('u/do_changeprice_pppsecret') ?>" method="post">
                        <input type="hidden" id="sch_uid" name="uschid" value="">
                        <input type="hidden" id="sch_uname" name="uname" value="">
                        <input type="hidden" id="sch_ustartdate" name="ustartdate" value="">
                        <input type="hidden" id="sch_uenddate" name="uenddate" value="">
                        <input type="hidden" id="sch_umainprofile" name="umainprofile" value="">
                        <input type="hidden" id="sch_ufupprofile" name="ufupprofile" value="">
                        <input type="hidden" id="sch_umasaktif"  name="umasaktif" value="">
                        <input type="hidden" id="sch_ugraceperiod" name="ugraceperiod" value="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control text-white" id="sch_uharga" name="uharga" placeholder="Harga">
                            <button class="btn btn-outline-secondary" id="submitharga" type="submit">Ubah!</button>
                        </div>
                    </form>
                    <hr>
                </div>

                <div id="divconvert">
                    <form style="display:inline !important;" name="formconvert" action="<?= base_url('u/do_convert_ppp_secret') ?>" method="post">
                        <div class="mb-3 row">
                            <label for="convert_name" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="convert_name" name="convert_name" readonly required>
                                <input type="hidden" class="form-control" id="convert_secretid" name="convert_secretid" required>
                                <input type="hidden" class="form-control" id="convert_pppactiveid" name="convert_pppactiveid">
                                <input type="hidden" class="form-control" id="convert_schid" name="convert_schid">
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="spass" name="spass" required>  
                        <div class="mb-3 row">
                            <label for="convert_mainprofile" class="col-sm-4 col-form-label">Main Profile</label>
                            <div class="col-sm-8">
                                <select class="form-select " id="convert_mainprofile" name="convert_mainprofile" required>
                                    <?php foreach($profile as $row) { ?>
                                        <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="convert_fupprofile" class="col-sm-4 col-form-label">FUP Profile</label>
                            <div class="col-sm-8">
                                <select class="form-select " id="convert_fupprofile" name="convert_fupprofile" required>
                                    <?php foreach($profile as $row) { ?>
                                        <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="convert_validity" class="col-sm-4 col-form-label">Masa Aktif</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control mt-1" id="convert_validity" name="convert_validity" placeholder="Contoh : 30d" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="convert_gperiod" class="col-sm-4 col-form-label">Masa Tenggang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control mt-1" id="convert_gperiod" name="convert_gperiod" placeholder="Contoh : 5d" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="convert_harga" class="col-sm-4 col-form-label">Harga</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control mt-1" id="convert_harga" name="convert_harga" placeholder="Contoh : 150000" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="convert_startdate" class="col-sm-4 col-form-label">Start Date</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control mt-1" id="convert_startdate" name="convert_startdate" value="<?= $today ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" id="submitconvert" class="btn btn-primary">Simpan!</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div style="display:none" id="rowdata" class="row">
                    <div class="col-md-7 col-lg-12">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-white">Nama</span>
                                </div>
                                <div>
                                    <span id="infoname" class="text-white"></span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-white">Main Profile</span>
                                </div>
                                <div>
                                    <span id="infomain" class="text-white"></span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-white">FUP Profile</span>
                                </div>
                                <div>
                                    <span id="infofup" class="text-white"></span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-white">Masa Aktif</span>
                                </div>
                                <div>
                                    <span id="infovalidity" class="text-white"></span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-white">Kadaluarsa</span>
                                </div>
                                <div>
                                    <span id="infoexp" class="text-white"></span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-white">Masa Tenggang</span>
                                </div>
                                <div>
                                    <span id="infoperiod" class="text-white"></span>
                                </div>
                            </li><li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-white">Harga</span>
                                </div>
                                <div>
                                    <span id="infoprice" class="text-white"></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <span id="testdata"></span>
            </div>
            
            </form>
        </div>
    </div>
</div>

<script>

    $('#modalinfo').on('show.bs.modal', function(e) {
        const secretid = $(e.relatedTarget).data('secretid');
        const secretname = $(e.relatedTarget).data('secretname');
        $('#infospinner').show();
        $('#infoheader').hide();
        $('#btnconvert').hide();
        $('#rowdata').hide();
        $('#btnharga').hide();
        $('#btnperpanjang').hide();
        $('#btnconvert').hide();
        $('#notmikpaysecret').hide();
        $('#divharga').hide();
        $('#divconvert').hide();
        setTimeout(function() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url() ?>/u/data/get_scheduler_by_name/' + secretname,
                success: function(response){
                    const data = JSON.parse(response)[0];
                    if (response != '[]'){
                        if (data["on-event"].split(",")[7] == data.name) {
                            $('#infoheader').show();
                            $('#infospinner').hide();
                            $('#btnharga').show();
                            $('#btnperpanjang').show();
                            $('#rowdata').show();
                            $('#infoname').html(data["on-event"].split(",")[7]);
                            $('#infomain').html(data["on-event"].split(",")[1]);
                            $('#infofup').html(data["on-event"].split(",")[2]);
                            $('#infovalidity').html(data["on-event"].split(",")[4]);
                            $('#infoexp').html(data["on-event"].split(",")[6]);
                            $('#infoperiod').html(data["on-event"].split(",")[3]);
                            $('#infoprice').html(data["on-event"].split(",")[8]);
                            $('#secret_id').val(secretid);
                            $('#sch_id').val(data[".id"]);
                            $('#sch_name').val(data["on-event"].split(",")[7]);
                            $('#sch_startdate').val(data["on-event"].split(",")[5]);
                            $('#sch_enddate').val(data["on-event"].split(",")[6]);
                            $('#sch_mainprofile').val(data["on-event"].split(",")[1]);
                            $('#sch_fupprofile').val(data["on-event"].split(",")[2]);
                            $('#sch_masaktif').val(data["on-event"].split(",")[4]);
                            $('#sch_graceperiod').val(data["on-event"].split(",")[3]);
                            $('#sch_exharga').val(data["on-event"].split(",")[8]);
                            setTimeout(function() {
                                $.ajax({
                                    type: 'GET',
                                    url: '<?= base_url() ?>/u/data/get_ppp_active_by_name/' + secretname,
                                    success: function(result){
                                        const active = JSON.parse(result)[0];
                                        if (result != '[]'){
                                            $('#sch_pppactiveid').val(active[".id"]);
                                        }
                                    }
                                });
                            }, 500);
                            $('#btnharga').on('click', function() {
                                // $('#rowdata').hide();
                                $('#divharga').show();
                                $('#sch_uid').val(data[".id"]);
                                $('#sch_uname').val(data["on-event"].split(",")[7]);
                                $('#sch_ustartdate').val(data["on-event"].split(",")[5]);
                                $('#sch_uenddate').val(data["on-event"].split(",")[6]);
                                $('#sch_umainprofile').val(data["on-event"].split(",")[1]);
                                $('#sch_ufupprofile').val(data["on-event"].split(",")[2]);
                                $('#sch_umasaktif').val(data["on-event"].split(",")[4]);
                                $('#sch_ugraceperiod').val(data["on-event"].split(",")[3]);
                                $('#sch_uharga').val(data["on-event"].split(",")[8]);
                            });
                        } else {
                            $('#infoname2').html(secretname);
                            $('#btnconvert').show();
                            $('#rowdata').hide();
                            $('#infospinner').hide();
                            $('#infoheader').show();
                            $('#notmikpaysecret').show();
                            $('#btnconvert').on('click', function() {
                                $('#notmikpaysecret').hide();
                                $('#divconvert').show();
                                $('#convert_secretid').val(secretid);
                                $('#convert_schid').val(data[".id"]);
                                $('#convert_name').val(secretname);
                                setTimeout(function() {
                                    $.ajax({
                                        type: 'GET',
                                        url: '<?= base_url() ?>/u/data/get_ppp_active_by_name/' + secretname,
                                        success: function(result){
                                            const active = JSON.parse(result)[0];
                                            if (result != '[]'){
                                                $('#convert_pppactiveid').val(active[".id"]);
                                            }
                                        }
                                    });
                                }, 500); 
                            });
                        }
                    } else {
                        $('#infoname2').html(secretname);
                        $('#btnconvert').show();
                        $('#rowdata').hide();
                        $('#infospinner').hide();
                        $('#infoheader').show();
                        $('#notmikpaysecret').show();
                        $('#btnconvert').on('click', function() {
                            $('#notmikpaysecret').hide();
                            $('#divconvert').show();
                            $('#convert_secretid').val(secretid);
                            $('#convert_schid').val('');
                            $('#convert_name').val(secretname);
                            setTimeout(function() {
                                $.ajax({
                                    type: 'GET',
                                    url: '<?= base_url() ?>/u/data/get_ppp_active_by_name/' + secretname,
                                    success: function(result){
                                        const active = JSON.parse(result)[0];
                                        if (result != '[]'){
                                            $('#convert_pppactiveid').val(active[".id"]);
                                        }
                                    }
                                });
                            }, 500);
                        });
                    }
                }
            });
        }, 1000);
    });

    $("form[name='formedit']").submit(function(){
        $("#simpanedituser").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Process...');
        $("#simpanedituser").prop("disabled", true);
        $("form[name='formedit']")[0].submit();
    });
    $("form[name='formharga']").submit(function(){
        $("#submitharga").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Process...');
        $("#submitharga").prop("disabled", true);
        $("form[name='formharga']")[0].submit();
    });
    $("form[name='formconvert']").submit(function(){
        $("#submitconvert").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Process...');
        $("#submitconvert").prop("disabled", true);
        $("form[name='formconvert']")[0].submit();
    });
    $("form[name='formadd']").submit(function(){
        $("#simpanadduser").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Process...');
        $("#simpanadduser").prop("disabled", true);
        $("form[name='formadd']")[0].submit();
    });
    $('#modaledit').on('show.bs.modal', function(e) {
        $('#enametitle').html($(e.relatedTarget).data('ename'));
        $('#eid').val($(e.relatedTarget).data('sid'));
        $('#ename').val($(e.relatedTarget).data('ename'));
        $('#epass').val($(e.relatedTarget).data('epass'));
        $('#elocaladdress').val($(e.relatedTarget).data('elocaladdress'));
        $('#eremoteaddress').val($(e.relatedTarget).data('eremoteaddress'));
        $('#chksch').val($(e.relatedTarget).data('chksch'));
        $('#emain').val($(e.relatedTarget).data('emain'));
        $('#cmain').val($(e.relatedTarget).data('eprofile')).change();
        $('#efup').val($(e.relatedTarget).data('efup'));
        $('#eschid').val($(e.relatedTarget).data('eschid'));
        $('#eperiod').val($(e.relatedTarget).data('eperiod'));
        $('#evalidity').val($(e.relatedTarget).data('evalidity'));
        $('#estart').val($(e.relatedTarget).data('estart'));
        $('#eend').val($(e.relatedTarget).data('eend'));
        $('#eharga').val($(e.relatedTarget).data('harga'));

    });
    $("#convert").change(function() {
        if ($('#convert').val() == 'yes') {
            $('#convertsection').show();
        } else {
            $('#convertsection').hide();
        }
    });
   
</script>