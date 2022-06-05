<!-- ROW -->
<div class="row">
    <div class="col-sm-6">
        <div class="card overflow-hidden">

            <div class="card-body">
                <form autocomplete="off" name="formadd" method="post" action="<?php echo base_url('u/do_add_userprofile'); ?>">
                    <div class="mb-3 row">
                        <label for="pname" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
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
                    Expired Mode is the control for the hotspot user.<br>
                    Options : Remove, Notice, Remove & Record, Notice & Record.
                    <ul>
                        <li>- Remove: User will be deleted when expires.</li>
                        <li>- Notice: User will not deleted and get notification after user expiration.</li>
                        <li>- Record: Save the price of each user login. To calculate total sales of hotspot users.</li>
                    </ul>

                <p>
                    Lock User : Username can only be used on 1 device only.
                </p>
                <p>
                    Format Masa Aktif = wdhm<br>
                    * Contoh : 30d = 30 hari, 12h = 12jam, 4w3d = 31 hari.<br/>
                    5h30m = 5 jam 30 menit
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
    $("#pexpmode").change(function() {
        if ($('#pexpmode').val() == '0') {
            $('#dvalidity').hide();
        } else {
            $('#dvalidity').show();
        }
    });


</script>
