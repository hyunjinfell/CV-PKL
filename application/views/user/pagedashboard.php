<!-- WRAPPER -->


<div class="container" style="margin-top: 70px;">
    <!-- NAVBAR -->

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="brand">
            <a href="#"><b>SIE-SMKN 4 Malang</b></a>
        </div>
        <div class="container-fluid">

            <div class="navbar-btn">
                <!--<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>-->
            </div>

            <?php if ($this->session->userdata('role') == 1) { ?>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> Admin</i>

                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('login/signout'); ?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>

                    </ul>
                </div>

            <?php } else { ?>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> Siswa</i>

                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('login/signout'); ?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            <?php } ?>
        </div>
    </nav>

    <!-- LEFT SIDEBAR -->

    <!-- END LEFT SIDEBAR -->


    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="panel-heading">


                    <?php include 'menu.php'; ?>
                </div>
                <div class="panel panel-headline">

                    <div class="panel-heading">
                        <div class="panel-title">Dashboard</div>
                        <div class="panel-title">Ekstrakulikuler : </div>
                        <div class="panel-title">1. Basket</div>
                        <div class="panel-title">2. Voli</div>
                        <div class="panel-title">3. Birama</div>
                        <div class="panel-title">4. Futsal</div>
                        <div class="panel-title">5. GVED</div>
                        <div class="panel-title">6. Seni Tari</div>
                        <div class="panel-title">7. Bulutangkis</div>
                        <div class="panel-title">8. Rohis</div>
                        <div class="panel-title">9. Broadcasting</div>
                        <div class="panel-title">10. Pramuka</div>

                        <div class="panel-body">
                            <div class="metric">
                                <div class="left">
                                    <h3 class="panel-title">Data Pendaftar Per-Ekstrakulikuler</h3>
                                    <hr>
                                </div>
                                <div class="table-responsive">
                                    <table class="col-md-6" width="1000px">
                                        <thead>
                                            <tr>
                                                <th>Nama Ekstrakulikuler</th>
                                                <th>Jumlah Pendaftar</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $total = 0;
                                            foreach ($total_asset as $row) {

                                            ?>
                                                <tr>

                                                    <td><?php echo $row->nama_ekskul; ?></td>
                                                    <th><?php echo $row->total; ?> Siswa</th>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <?php echo $this->session->flashdata('notify'); ?>
                <?php echo validation_errors(); ?>
                <!-- OVERVIEW -->


                <!-- END MAIN CONTENT -->
            </div>
        </div>
    </div>