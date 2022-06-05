                    <!-- ROW -->  
                    <div class="row">
                            <div class="col-sm-6">
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

                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title"><i class="fe fe-cpu"></i> Router List</h3>
                                        <a href="addrouter" class="btn btn-sm btn-primary">Add Router</a>
                                    </div>
                                    <div class="card-body">
                                        <?php foreach ($router as $row) { ?>
                                        <div class="card overflow-hidden">
                                            <div class="card-body border border-primary border-3 ">
                                                <div class="user-pro-1 mt-3">
                                                    <div class="media media-xs overflow-visible">
                                                        <form style="display:inline !important;" class="me-4 mt-2" id="" action="do_auth_router" method="post">
                                                            <input type="hidden" value="<?= $row->id ?>" name="router_id"/>
                                                            <a class="text-white" href="#/" onclick="Swal.fire({text: 'Login to <?= $row->router_name ?> ',allowOutsideClick: false,showConfirmButton: false,didOpen: () => {Swal.showLoading();this.closest('form').submit();return false;},})">
                                                            <i style="font-size:2rem" class="fe fe-cpu"></i> 
                                                            </a>
                                                        </form>
                                                        
                                                        <div class="media-body valign-middle">
                                                            <form style="display:inline !important;" class="me-3" id="" action="do_auth_router" method="post">
                                                            <input type="hidden" value="<?= $row->id ?>" name="router_id"/>
                                                            <a class="text-white" href="#/" onclick="Swal.fire({text: 'Login to <?= $row->router_name ?> ',allowOutsideClick: false,showConfirmButton: false,didOpen: () => {Swal.showLoading();this.closest('form').submit();return false;},})">
                                                            <?= $row->router_name ?> 
                                                            </a>
                                                            </form>
                                                            <p class="text-muted mb-0"><?= $row->router_dns ?></p>

                                                            <form style="display:inline !important;" class="me-3" id="" action="do_auth_router" method="post">
                                                            <input type="hidden" value="<?= $row->id ?>" name="router_id"/>
                                                            <a class="text-white" href="#/" onclick="Swal.fire({text: 'Login to <?= $row->router_name ?> ',allowOutsideClick: false,showConfirmButton: false,didOpen: () => {Swal.showLoading();this.closest('form').submit();return false;},})">
                                                                <i class="fa fa-external-link"></i> Open
                                                            </a>
                                                            </form>

                                                            <a class="text-white me-3" href="#/" data-bs-toggle="modal" data-bs-target="#editModal"
                                                            data-router_id="<?= $row->id ?>"
                                                            data-router_name="<?= $row->router_name ?>"
                                                            data-router_host="<?= $row->router_host ?>"
                                                            data-router_user="<?= $row->router_user ?>"
                                                            data-router_dns="<?= $row->router_dns ?>"
                                                            data-traffic_interface="<?= $row->traffic_interface ?>">
                                                                <i class="fa fa-pencil-square-o"></i> Edit
                                                            </a>
                                                            

                                                            <form style="display:inline !important;" class="me-3" id="" action="do_delete_router" method="post">
                                                            <input type="hidden" value="<?= $row->id ?>" name="router_id"/>
                                                            <a class="text-white me-3" href="#/" onclick="Swal.fire({title: 'Delete <?= $row->router_name ?>?',text: 'Semua data transaksi pada router ini akan terhapus!',icon: 'warning',showCancelButton: true,cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) => {if (result.isConfirmed) {this.closest('form').submit();return false;}})">
                                                            <i class="fa fa-times"></i> Delete
                                                            </a>
                                                            </form>

                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php } ?>
                                    </div>
                                  
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-6">
                                <div class="card overflow-hidden">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title"><i class="fe fe-user"></i> Admin</h3>
                                        <a href="" class="btn btn-sm" style="background:#2a2a4a !important;color:#2a2a4a !important;">_</a>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo base_url('router/do_update_user'); ?>">
                                            <div class="form-group">
                                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                    <a href="javascript:void(0)" class="input-group-text bg-white">
                                                        <i class="zmdi zmdi-face text-muted"></i>
                                                    </a>
                                                    <input class="input100 form-control " type="text" name="username" value="<?= $_SESSION['uname']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                                    <a href="javascript:void(0)" class="input-group-text bg-white">
                                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input class="input100 form-control " type="password" name="password" placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                                    <button type="submit" class="btn btn-primary" id="btnsave"><i class="fa fa-save"></i> Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->

                        </div>
                        <!-- ROW END -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit: <span id="rname"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" name="formedit" action="<?php echo base_url('router/do_edit_router'); ?>">
            <div class="form-group">
                <div class="wrap-input100 input-group">
                    <a class="input-group-text bg-white">
                        <i class="fe fe-home text-muted"></i>
                    </a>
                    <input type="hidden" name="router_id" id="router_id" placeholder="Nama Penyedia. Cth : Biznet" required>
                    <input class="input100 form-control " type="text" name="router_name" id="router_name" placeholder="Nama Penyedia. Cth : Biznet" required>
                </div>
            </div>
            <div class="form-group">
                <div class="wrap-input100 input-group">
                    <a class="input-group-text bg-white">
                        <i class="fe fe-cloud text-muted"></i>
                    </a>
                    <input class="input100 form-control " type="text" name="router_dns" id="router_dns" placeholder="DNS Name. Cth : biznet.net" required>
                </div>
            </div>
            <div class="form-group">
                <div class="wrap-input100 input-group">
                    <a class="input-group-text bg-white">
                        <span class="text-muted">IP</span>
                    </a>
                    <input class="input100 form-control " type="text" name="router_host" id="router_host" placeholder="IP / Host Mikrotik" required>
                </div>
            </div>
            <div class="form-group">
                <div class="wrap-input100 input-group">
                    <a class="input-group-text bg-white">
                        <i class="fe fe-user text-muted"></i>
                    </a>
                    <input class="input100 form-control " type="text" name="router_user" id="router_user" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group">
                <div class="wrap-input100 input-group">
                    <a class="input-group-text bg-white">
                        <i class="fa fa-key text-muted"></i>
                    </a>
                    <input class="input100 form-control " type="password" name="router_pass" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="wrap-input100 input-group">
                    <a class="input-group-text bg-white">
                        <i class="fe fe-slack text-muted"></i>
                    </a>
                    <input class="input100 form-control " type="text" name="traffic_interface" id="traffic_interface" placeholder="Traffic Interface. Cth : ether1-isp" required>
                </div>
            </div>
            <div class="form-group">
                <div class="wrap-input100 input-group">
                    <button class="btn btn-primary" id="simpanedit" type="submit"><i class="fe fe-save"></i> Simpan</button>
                </div>
            </div>
        </form>
      </div>    
    </div>
  </div>
</div>
