<?php foreach ($router as $row) {
    $userid = $row->user_id;
    $routerid = $row->id;
    $merchantcode = $row->tripay_merchant_code;
    $apikey = $row->tripay_api_key;
    $privatekey = $row->tripay_private_key;
}
?>
<div class="row">
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

    <div class="col-sm-6">
        <div class="card overflow-hidden">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fa fa-key"></i> Tripay Settings</h3>
            </div>
            <div class="card-body">
                
                <form autocomplete="off" name="formadd" method="post" action="<?php echo base_url('u/do_update_tripaydata'); ?>">
                    <div class="mb-3 row">
                        <label for="merchantcode" class="col-sm-2 col-form-label">Kode Merchant</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="merchantcode" name="merchantcode" value="<?= $merchantcode ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="apikey" class="col-sm-2 col-form-label">API Key</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="apikey" name="apikey" value="<?= $apikey ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="privatekey" class="col-sm-2 col-form-label">Private Key</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="privatekey" name="privatekey" value="<?= $privatekey ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="buttonadd" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button class="btn btn-primary" id="buttonadd" type="submit"><i class="fe fe-save"></i> Simpan</button>
                        </div>
                    </div>
        
                </form>
                <hr>
                <div class="mb-3 row">
                    <label for="urlcallback" class="col-sm-2 col-form-label">URL Callback</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="urlcallback" name="urlcallback" value="<?= base_url('callback') . '/' . $userid . '/' . $routerid ?>">
                            <button class="btn btn-outline-secondary" type="button" id="urlcallbackbtn" onclick="copyToClipboard()"><i class="fa fa-clone"></i> Salin</button>
                        </div>
                    </div>
                </div>
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
                    - Isi Kode Merchant, Api Key, dan Private Key sesuai merchant pada dashboard tripay.co.id<br/>
                    <br/>
                    - Masukan URL Callback kek dashboard merchant di tripay.co.id 
            </div>

        </div>

        <div class="card overflow-hidden">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fa fa-credit-card"></i> Payment Method</h3>
            </div>
            <div class="card-body">
                    <div class="form-group">
                        <?php  foreach($pmethod as $row) { ?>
                        <div class="custom-control custom-switch d-block">
                            <label class="custom-switch form-switch">
                                <input type="checkbox" class="custom-switch-input" id="set<?= $row->kode?>"
                                <?php if($row->status == '1') echo 'checked'; ?>>
                                <span class="custom-switch-indicator custom-switch-indicator-md"></span>
                                <span class="custom-switch-description"><?= $row->nama ?></span>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
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
    function copyToClipboard() {
        console.time('time2');
        var temp=document.createElement('input');
        var texttoCopy=document.getElementById('urlcallback').value;
        var buttontemp=document.getElementById('urlcallbackbtn').innerHTML;
        temp.type='input';
        temp.setAttribute('value',texttoCopy);
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        temp.remove();
        document.getElementById('urlcallbackbtn').innerHTML = 'Berhasil disalin!';
        document.getElementById("urlcallbackbtn").disabled = true;
        setTimeout(function() {
            document.getElementById('urlcallbackbtn').innerHTML = buttontemp;
        }, 3000);
        document.getElementById("urlcallbackbtn").disabled = false;
        console.timeEnd('time2');
    }
</script>

<?php 
foreach ($pmethod as $row) { ?>
<script>
$('#set<?= $row->kode?>').on('change', function (event) {
var status = $('#set<?= $row->kode?>').is(":checked") ? 1 : 0;
var kodepm = '<?= $row->kode?>';
  $.ajax({
    url: "<?= base_url('u/do_update_pm') ?>",
    method: "POST",
    data: {
      status: status,
      kodepm: kodepm
    },
    async: true,
    dataType: 'html',
    success: function ($hasil) {
      if ($hasil == 'success') {
        location.reload();
      }
    }
  });
});
</script>
<?php } ?>