<!-- ROW -->
<div class="row">
    <div class="col-sm-6">
        <div class="card overflow-hidden">

            <div class="card-body">

                <form autocomplete="off" name="generateuser" method="post" action="<?php echo base_url('u/do_generate_users'); ?>">
                    <div class="mb-3 row">
                        <label for="qty" class="col-sm-2 col-form-label">Qty</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="qty" type="number" name="qty" min="3" max="500" value="3" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="server" class="col-sm-2 col-form-label">Server</label>
                        <div class="col-sm-10">
                            <select class="form-select " id="server" name="server">
                                <option selected>all</option>
                                <?php foreach($server as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="user" class="col-sm-2 col-form-label">Usermode</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="user" name="user" required>
                                <option value="up">username & password</option>
                                <option value="vc">username = password</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="userl" class="col-sm-2 col-form-label">User Length</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="userl" name="userl" required>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="prefix" class="col-sm-2 col-form-label">Prefix</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prefix" name="prefix">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="char" class="col-sm-2 col-form-label">Character</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="char" name="char" required>
                                <option id="lower" style="display:block;" value="lower">Random abcd</option>
                                <option id="upper" style="display:block;" value="upper">Random ABCD</option>
                                <option id="upplow" style="display:block;" value="upplow">Random aBcD</option>
                                <option id="lower1" style="display:none;" value="lower">Random abcd2345</option>
                                <option id="upper1" style="display:none;" value="upper">Random ABCD2345</option>
                                <option id="upplow1" style="display:none;" value="upplow">Random aBcD2345</option>
                                <option id="mix" style="display:block;" value="mix">Random 5ab2c34d</option>
                                <option id="mix1" style="display:block;" value="mix1">Random 5AB2C34D</option>
                                <option id="mix2" style="display:block;" value="mix2">Random 5aB2c34D</option>
                                <option id="num" style="display:none;" value="num">Random 1234</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="profile" class="col-sm-2 col-form-label">Profile</label>
                        <div class="col-sm-10">
                            <select class="form-select " id="uprofile" name="profile">
                                <?php foreach($profile as $row) { ?>
                                    <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="timelimit" class="col-sm-2 col-form-label">Time Limit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="timelimit" name="timelimit">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="datalimit" class="col-sm-2 col-form-label">Data Limit</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="number" id="datalimit" name="datalimit" class="form-control" value="0">
                                <select class="form-control" id="mbgb" name="mbgb">
                                    <option value="1048576" selected>MB</option>
                                    <option value="1073741824">GB</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="adcomment" class="col-sm-2 col-form-label">Comment</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="comment" name="adcomment">
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
                            <button class="btn btn-primary" id="bgenerate" type="submit"><i class="fe fe-save"></i> Generate</button>
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
    $("form[name='generateuser']").submit(function(){
        $("#bgenerate").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generating...');
        $("#bgenerate").prop("disabled", true);
        $("form[name='generateuser']")[0].submit();
    });
    $("#uprofile").change(function(){
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
    $("#user").change(function(){
        if ($("#user").val() == 'up') {
            $("#char").val('upper').change();
            $("#upper").show();
            $("#upplow").show();
            $("#lower1").hide();
            $("#upper1").hide();
            $("#upplow1").hide();
            $("#num").hide();
        } else {
            $("#char").val('num').change();
            $("#upper").hide();
            $("#lower").hide();
            $("#upplow").hide();
            $("#lower1").show();
            $("#upper1").show();
            $("#upplow1").show();
            $("#num").show();
        }
    });
</script>
