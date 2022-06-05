                    <!-- ROW -->
                    <div class="row">
                            <div class="col">
                                <div class="card overflow-hidden">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title"><i class="fe fe-cpu"></i> Add Router</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" name="formedit" action="<?php echo base_url('router/do_add_router'); ?>">
                                            <div class="form-group">
                                                <div class="wrap-input100 input-group">
                                                    <a class="input-group-text bg-white">
                                                        <i class="fe fe-home text-muted"></i>
                                                    </a>
                                                    <input class="input100 form-control " type="text" name="router_name" placeholder="Nama Penyedia. Cth : Biznet" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="wrap-input100 input-group">
                                                    <a class="input-group-text bg-white">
                                                        <i class="fe fe-cloud text-muted"></i>
                                                    </a>
                                                    <input class="input100 form-control " type="text" name="router_dns" placeholder="DNS Name. Cth : biznet.net" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="wrap-input100 input-group">
                                                    <a class="input-group-text bg-white">
                                                        <span class="text-muted">IP</span>
                                                    </a>
                                                    <input class="input100 form-control " type="text" name="router_host" placeholder="IP / Host Mikrotik" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="wrap-input100 input-group">
                                                    <a class="input-group-text bg-white">
                                                        <i class="fe fe-user text-muted"></i>
                                                    </a>
                                                    <input class="input100 form-control " type="text" name="router_user" placeholder="Username" required>
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
                                                        <i class="fa fa-slack text-muted"></i>
                                                    </a>
                                                    <input class="input100 form-control " type="text" name="traffic_interface" placeholder="Traffic Interface. Cth : ether1-isp">
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
                            <!-- COL END -->
                        </div>
                        <!-- ROW END -->