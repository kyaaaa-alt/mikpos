<?php foreach ($router as $row) {
    $userid = $row->user_id;
    $routerid = $row->id;
    $merchantcode = $row->tripay_merchant_code;
    $apikey = $row->tripay_api_key;
    $privatekey = $row->tripay_private_key;
}
?>
<div class="row">
    <!-- COL END -->
    <div class="col-sm-6">
        <div class="card overflow-hidden">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fa fa-bookmark-o"></i> Payment Page</h3>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="urlcallback" class="col-sm-4 col-form-label">Landing Page</label>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="landing" name="landing" value="<?= base_url('landing') . '/' . $userid . '/' . $routerid ?>">
                            <button class="btn btn-outline-secondary" type="button" id="landingbtn" onclick="copylanding()"><i class="fa fa-clone"></i> Salin</button>
                            <a target="_blank" class="btn btn-outline-secondary" href="<?= base_url('landing') . '/' . $userid . '/' . $routerid ?>">Open</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mb-3 row">
                    <label for="urlcallback" class="col-sm-4 col-form-label">RouterID & Template</label>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="routerid" name="routerid" value="<?= $userid . '/' . $routerid ?>">
                            <button class="btn btn-outline-secondary" type="button" id="routeridbtn" onclick="copyrouterid()"><i class="fa fa-clone"></i> Salin RouterID</button>
                            <a target="_blank" class="btn btn-outline-secondary" href="<?= base_url() . '/mikpos_template.zip' ?>">Download Template</a>
                        </div>
                    </div>
                </div>
                Tambahkan script berikut ke MikroTik Anda.<br/><br/>
                /ip hotspot walled-garden ip add action=accept comment="Mikpos" disabled=no dst-host=mikpos.space<br/>
                /ip hotspot walled-garden ip add action=accept comment="Mikpos" disabled=no dst-host=tripay.co.id
            </div>

        </div>
    </div>
    <!-- COL END -->

    <!-- COL END -->
    <div class="col-sm-6">
        <div class="card overflow-hidden">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fa fa-info-circle"></i> Informasi</h3>
            </div>
            <div class="card-body">
                <p>
                    <strong>> Landing page</strong><br/>
                    * Page Voucher :<br/>
                    - Beli Voucher : Paket yang ditampilkan hanya user profile dengan expired mode Remove / Remove & Record <br/>
                    - Perpanjang Voucher : Voucher yang bisa di perpanjang hanya voucher dengan user profile Notice / Notice & Record<br/>
                    - Kode Voucher = User Name Hotspot
                    <br/>
                    * Page Member PPPoE :<br/>
                    - Kode Member = PPP Secret Name<br/><br/>

                    <strong>> RouterID & Template</strong><br/>
                    - Download template hostpot mikrotik versi mikpos<br/>
                    - Extract terlebih dahulu<br/>
                    - Buka folder mikpos_template<br/>
                    - Edit config.js<br/>
                    - Sesuaikan router id yang dapat di salin dihalaman ini.<br/>
                    - Save lalu upload ke mikrotik.<br/>
                </p>
            </div>

        </div>
    </div>
    <!-- COL END -->
    
</div>
<!-- ROW END -->

<script>
    function copylanding() {
        console.time('time2');
        var temp=document.createElement('input');
        var texttoCopy=document.getElementById('landing').value;
        var buttontemp=document.getElementById('landingbtn').innerHTML;
        temp.type='input';
        temp.setAttribute('value',texttoCopy);
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        temp.remove();
        document.getElementById('landingbtn').innerHTML = 'Berhasil disalin!';
        document.getElementById("landingbtn").disabled = true;
        setTimeout(function() {
            document.getElementById('landingbtn').innerHTML = buttontemp;
        }, 3000);
        document.getElementById("landingbtn").disabled = false;
        console.timeEnd('time2');
    }

    function copystatusvoucher() {
        console.time('time2');
        var temp=document.createElement('input');
        var texttoCopy=document.getElementById('statusvoucher').value;
        var buttontemp=document.getElementById('statusvoucherbtn').innerHTML;
        temp.type='input';
        temp.setAttribute('value',texttoCopy);
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        temp.remove();
        document.getElementById('statusvoucherbtn').innerHTML = 'Berhasil disalin!';
        document.getElementById("statusvoucherbtn").disabled = true;
        setTimeout(function() {
            document.getElementById('statusvoucherbtn').innerHTML = buttontemp;
        }, 3000);
        document.getElementById("statusvoucherbtn").disabled = false;
        console.timeEnd('time2');
    }

    function copypayvoucher() {
        console.time('time2');
        var temp=document.createElement('input');
        var texttoCopy=document.getElementById('payvoucher').value;
        var buttontemp=document.getElementById('payvoucherbtn').innerHTML;
        temp.type='input';
        temp.setAttribute('value',texttoCopy);
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        temp.remove();
        document.getElementById('payvoucherbtn').innerHTML = 'Berhasil disalin!';
        document.getElementById("payvoucherbtn").disabled = true;
        setTimeout(function() {
            document.getElementById('payvoucherbtn').innerHTML = buttontemp;
        }, 3000);
        document.getElementById("payvoucherbtn").disabled = false;
        console.timeEnd('time2');
    }

    function copystatusppp() {
        console.time('time2');
        var temp=document.createElement('input');
        var texttoCopy=document.getElementById('statusppp').value;
        var buttontemp=document.getElementById('statuspppbtn').innerHTML;
        temp.type='input';
        temp.setAttribute('value',texttoCopy);
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        temp.remove();
        document.getElementById('statuspppbtn').innerHTML = 'Berhasil disalin!';
        document.getElementById("statuspppbtn").disabled = true;
        setTimeout(function() {
            document.getElementById('statuspppbtn').innerHTML = buttontemp;
        }, 3000);
        document.getElementById("statuspppbtn").disabled = false;
        console.timeEnd('time2');
    }

    function copypayppp() {
        console.time('time2');
        var temp=document.createElement('input');
        var texttoCopy=document.getElementById('payppp').value;
        var buttontemp=document.getElementById('paypppbtn').innerHTML;
        temp.type='input';
        temp.setAttribute('value',texttoCopy);
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        temp.remove();
        document.getElementById('paypppbtn').innerHTML = 'Berhasil disalin!';
        document.getElementById("paypppbtn").disabled = true;
        setTimeout(function() {
            document.getElementById('paypppbtn').innerHTML = buttontemp;
        }, 3000);
        document.getElementById("paypppbtn").disabled = false;
        console.timeEnd('time2');
    }

    function copyrouterid() {
        console.time('time2');
        var temp=document.createElement('input');
        var texttoCopy=document.getElementById('routerid').value;
        var buttontemp=document.getElementById('routeridbtn').innerHTML;
        temp.type='input';
        temp.setAttribute('value',texttoCopy);
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        temp.remove();
        document.getElementById('routeridbtn').innerHTML = 'Berhasil disalin!';
        document.getElementById("routeridbtn").disabled = true;
        setTimeout(function() {
            document.getElementById('routeridbtn').innerHTML = buttontemp;
        }, 3000);
        document.getElementById("routeridbtn").disabled = false;
        console.timeEnd('time2');
    }
</script>
