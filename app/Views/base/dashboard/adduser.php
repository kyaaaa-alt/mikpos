<!-- ROW -->
<div class="row">
    <div class="col-sm-6">
        <div class="card overflow-hidden">

            <div class="card-body">
                <form autocomplete="off" name="formadd" method="post" action="<?php echo base_url('u/do_add_user'); ?>">
                    <div class="mb-3 row">
                        <label for="userver" class="col-sm-2 col-form-label">Server</label>
                        <div class="col-sm-10">
                            <select class="form-select " id="userver" name="userver">
                                <option selected>all</option>
                                <?php foreach($server as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="uname" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="uname" name="uname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="upass" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="upass" name="upass">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="uprofile" class="col-sm-2 col-form-label">Profile</label>
                        <div class="col-sm-10">
                            <select class="form-select " id="uprofile" name="uprofile">
                                <?php foreach($profile as $row) { ?>
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
                        foreach ($profile as $row) {
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

                    <div class="form-group">
                        <div class="wrap-input100 input-group">
                            <button class="btn btn-primary" id="buttonadd" type="submit"><i class="fe fe-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- COL END -->
    <div class="col-sm-6">
        <div class="card overflow-hidden">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fa fa-info-circle"></i> Informasi</h3>
            </div>
            <div class="card-body">
                <p>
                    - Format Time Limit = wdhm<br/>
                    * Contoh : 30d = 30 hari, 12h = 12jam, 4w3d = 31 hari.<br/><br/>

                    - Time Limit harus lebih kecil dari Masa Aktif Profile <br/>
                    * kosongkan time limit bisa di kosongkan jika hanya ingin menggunakan masa aktif hotspot profile<br/><br/>

                    - Data Limit <br/>
                    * biarkan data limit '0' jika tidak ingin menggunakan data limit
                </p>
            </div>

        </div>
    </div>
    <!-- COL END -->
</div>
<!-- ROW END -->

<script>
    $("form[name='formadd']").submit(function(){
        $("#buttonadd").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Process...');
        $("#buttonadd").prop("disabled", true);
        $("form[name='formadd']")[0].submit();
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
