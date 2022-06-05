<?php 
$users = 0;
foreach ($user as $row){
    $totalusers = $users++;
}
?>
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
                    <table id="example3" class="table table-bordered text-nowrap border-bottom" data-delbyuids="<?= base_url('u/do_remove_user_by_uids') ?>"
                           data-delbycomment="<?= base_url('u/do_remove_user_by_comment') ?>"
                    data-selectkomentar="<?php $session = session(); $gcomm = $session->getFlashdata('comment'); if($gcomm != null) { print_r($gcomm); }  ?>"
                           data-urlpdf="<?= base_url('u/usersPDF') ?>"
                    >
                        <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    <input type="checkbox" class="ckbCheckAll" id="ckbCheckAll"></input>
                                </th>
                                <th class="border-bottom-0">Server</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Profile</th>
                                <!-- <th class="border-bottom-0">Mac Address</th> -->
                                <th class="border-bottom-0">Uptime</th>
                                <th class="border-bottom-0">Bytes In</th>
                                <th class="border-bottom-0">Bytes Out</th>
                                <th class="border-bottom-0">Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach (array_slice($user, 1) as $row){
                                $uid = $row['.id'];
                                $name = $row['name'];
                                $pass = $row['password'];
                                $server = $row['server'];
                                $disabled = $row['disabled'];
                                $profile = $row['profile'];
                                $mac = $row['mac-address'];
                                $uptime = formatDTM($row['uptime']);
                                $bytesin = formatBytes($row['bytes-in']);
                                $bytesout = formatBytes($row['bytes-out']);
                                $limitdata = $row['limit-bytes-total'];
                                $limittime = $row['limit-uptime'];
                                $comment = $row['comment'];
                            ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="checkBoxClass" value="<?= $uid ?>">
                                    <?php if ($disabled == 'false') { ?>
                                        <form style="display:inline !important;" id="" action="<?= base_url('u/do_disable_user') ?>" method="post">
                                            <input type="hidden" name="uid" value="<?= $uid ?>">
                                            <a href="#/" onclick="this.closest('form').submit();return false;">
                                                <i class="fa fa-unlock text-success"></i>
                                            </a>
                                        </form>
                                    <?php } else { ?>
                                        <form style="display:inline !important;" id="" action="<?= base_url('u/do_enable_user') ?>" method="post">
                                            <input type="hidden" name="uid" value="<?= $uid ?>">
                                            <a href="#/" onclick="this.closest('form').submit();return false;">
                                                <i class="fa fa-lock text-warning"></i>
                                            </a>
                                        </form>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php
                                    if(!empty($server)) {
                                        echo $server;
                                    } else {
                                        echo 'all';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="" class="text-white" data-bs-toggle="modal" data-bs-target="#modaledit"
                                    data-userver="<?= $server ?>"
                                    data-uname="<?= $name ?>"
                                    data-upass="<?= $pass ?>"
                                    data-uprofile="<?= $profile ?>"
                                    data-ulimittime="<?= $limittime ?>"
                                    data-ulimitdata="<?= $limitdata ?>"
                                    data-uid="<?= $uid ?>">
                                        <i class="fa fa-edit"></i>
                                        <?= $name ?>
                                    </a>
                                </td>
                                <td><?= $profile ?></td>
                                <!-- <td><?= $mac ?></td> -->
                                <td><?= $uptime ?></td>
                                <td><?= $bytesin ?></td>
                                <td><?= $bytesout ?></td>
                                <td><?= $comment ?></td>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit: <span id="edituname"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form autocomplete="off" method="post" name="formedit" action="<?= base_url('u/do_edit_user') ?>">
                    <div class="mb-3 row">
                        <label for="userver" class="col-sm-2 col-form-label">Server</label>
                        <div class="col-sm-10">
                            <select class="form-select " id="userver" name="userver">
                                <option>all</option>
                                <?php foreach($ser as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="uname" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="uid" name="uid">
                            <input type="text" class="form-control" id="uname" name="uname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="upass" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="upass" name="upass">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="uprofile" class="col-sm-2 col-form-label">Profile</label>
                        <div class="col-sm-10">
                            <select class="form-select " id="uprofile" name="uprofile">
                                <?php foreach($pro as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ulimittime" class="col-sm-2 col-form-label">Time Limit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ulimittime" name="ulimittime">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="p1" class="col-sm-2 col-form-label">Data Limit</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="number" id="p1" name="p1" class="form-control" value="0">
                                <select class="form-control" id="p2" name="p2">
                                    <option value="mb" selected>MB</option>
                                    <option value="gb">GB</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <p>
                        <?php
                        foreach ($pro as $row) {
                            $pname = $row['name'];
                            $ponlogin = $row['on-login'];
                            $getvalid = explode(",", $ponlogin)[3];
                            $getprice = explode(",", $ponlogin)[2];
                            $getsprice = explode(",", $ponlogin)[4];
                            $getl = explode(",", $ponlogin)[6];
                            if (!empty($getvalid)) { ?>
                                <span style="display: none;" class="pdata" id="<?= $pname ?>"><strong>
                                    Masa Aktif : <?= $getvalid ?>
                                        <?php if ($getprice != 0) { ?>
                                            | Price : <?= rupiah($getprice) ?>
                                        <?php } ?>
                                        <?php if ($getsprice != 0) { ?>
                                            | Selling Price : <?= rupiah($getsprice) ?>
                                        <?php } ?>
                                        | Lock User : <?= $getl ?>
                                </strong></span>
                            <?php } } ?>
                    </p>
                    <div class="float-start">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="simpanedituser" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <div class="float-start">
                    *kosongkan time limit jika ingin menghapus time limit<br/>
                    *ubah data limit ke 0 jika ingin menghapus data limit
                </div>

            </div>

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
        var uid = $(e.relatedTarget).data('uid');
        var uname = $(e.relatedTarget).data('uname');
        var upass = $(e.relatedTarget).data('upass');
        var uprofile = $(e.relatedTarget).data('uprofile');
        var userver = $(e.relatedTarget).data('userver');
        var ulimittime = $(e.relatedTarget).data('ulimittime');
        var ulimitdata = $(e.relatedTarget).data('ulimitdata');
        if (ulimitdata == null ) {
            ulimitdata = 0;
        } else {
            if (ulimitdata >= 1073741824) {
                ulimitdata = ulimitdata / 1073741824;
                $('#p2').val('gb').change();
            } else {
                ulimitdata = ulimitdata / 1048576;
                $('#p2').val('mb').change();
            }
        }
        $('#edituname').html(uname);
        $('#uname').val(uname);
        $('#upass').val(upass);
        $('#uprofile').val(uprofile).change();

        if (userver) {
            $('#userver').val(userver).change();
        } else {
            $('#userver').get(0).selectedIndex = 0;
        }
        $('#ulimittime').val(ulimittime);
        $('#p1').val(ulimitdata);
        $('#uid').val(uid);
    });




    $('.ckbCheckAll, .checkBoxClass').click(function() {
        if ($('.ckbCheckAll:checked').length > 0 || $('.checkBoxClass:checked').length > 0) {
            $('.checkbox-count-content').show(500);
        } else {
            $('.checkbox-count-content').hide(500);
        }
    })

    const countCheckedAll = function() {
        const counter = $(".checkBoxClass:checked").length;
        $(".checkbox-count").html(counter + " selected!");
        $("#countdelete").html(counter);
        // console.log(counter + ' selected!');
        if (counter  > 0) {
            $('#delselbutton').show();
        } else {
            $('#delselbutton').hide();
        }
    };

    $(".checkBoxClass").on("click", countCheckedAll);

    $('.ckbCheckAll').click(function() {
        if ($(this).is(":checked")) {
            $('tbody').find('tr:visible .checkBoxClass').prop('checked', true);
            countCheckedAll();
        } else {
            //remove checked
            $(".checkBoxClass").prop('checked', false);
            $('.checkbox-count-content').hide(500);
            $("#countdelete").html('0');
            $('#delselbutton').hide();
        }
    })

    $(".checkBoxClass").change(function() {
        if (!$(this).prop("checked")) {
            $(".ckbCheckAll").prop("checked", false);
        }
    });

    $("#uprofile").change(function() {
        var p1 = $('#uprofile').val();
        var p2 = '#' + $('#uprofile').val();
        var ids = $('.pdata').map(function(){
            return $(this).attr('id');
        }).get();
        $('.pdata').hide();
        if(jQuery.inArray(p1, ids) != -1) {
            $(p2).show();
        } else {
            $('.pdata').hide();
        }
    });


</script>
