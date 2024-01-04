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
                <?php echo form_open('user/create'); ?>
                <div class="panel panel-headline">

                    <div class="panel-heading">
                        <div class="panel-title">Pendaftaran</div>
                        <div class="panel-body">


                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>

                                        <th>: <input type="text" name="nama_siswa"></th>
                                        <th>Nis Siswa</th>
                                        <th>: <input type="number" name="nis"></th>

                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>

                                        <th>: <input type="text" name="tempat_lahir"></th>
                                        <th>Tanggal Lahir</th>
                                        <th>: <input type="date" name="tanggal_lahir"></th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <th>Jurusan</th>
                                        <th> :
                                            <select name="kelas" id="" class="">
                                                <option value="ANIMASI A">ANIMASI A</option>
                                                <option value="ANIMASI B">ANIMASI B</option>
                                                <option value="ANIMASI C">ANIMASI C</option>


                                                <option value="RPL A">RPL A</option>
                                                <option value="RPL B">RPL B</option>
                                                <option value="RPL C">RPL C</option>

                                                <option value="DKV A">DKV A</option>
                                                <option value="DKV B">DKV B</option>
                                                <option value="DKV C">DKV C</option>

                                                <option value="TKJ A">TKJ A</option>
                                                <option value="TKJ B">TKJ B</option>

                                                <option value="LOGISTIK A">LOGISTIK A</option>
                                                <option value="LOGISTIK B">LOGISTIK B</option>

                                                <option value="MEKATRONIKA A">MEKATRONIKA A</option>
                                                <option value="MEKATRONIKA B">MEKATRONIKA B</option>

                                                <option value="PERHOTELAN A">PERHOTELAN A</option>
                                                <option value="PERHOTELAN B">PERHOTELAN B</option>

                                                <option value="TEKNIK GRAFIKA A">TEKNIK GRAFIKA A</option>
                                                <option value="TEKNIK GRAFIKA B">TEKNIK GRAFIKA B</option>
                                                <option value="TEKNIK GRAFIKA C">TEKNIK GRAFIKA C</option>
                                                <option value="TEKNIK GRAFIKA D">TEKNIK GRAFIKA D</option>
                                                <option value="TEKNIK GRAFIKA E">TEKNIK GRAFIKA E</option>
                                                <option value="TEKNIK GRAFIKA F">TEKNIK GRAFIKA F</option>
                                                <option value="TEKNIK GRAFIKA G">TEKNIK GRAFIKA G</option>
                                                <option value="TEKNIK GRAFIKA H">TEKNIK GRAFIKA H</option>
                                            </select>
                                        </th>




                                        <th>Jenis Kelamin</th>
                                        <th>:
                                            <select name="Jenis_kelamin" id="Jenis_kelamin">
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </th>

                                    </tr>

                                    <th>Kelas</th>
                                    <th>:
                                        <select name="kelas1" id="" class="">
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </select>
                                    </th>

                                </tbody>
                            </table>

                            <?php
                            $tgl = date('Y-m-d'); { ?>
                                <input type="hidden" name="tanggal_daftar" required="" value="<?php echo $tgl; ?>">
                            <?php } ?>

                        </div>
                    </div>
                    <div class="panel-heading">*)Dilarang Memilih Ekstrakulikuler dengan Jadwal yang Sama</div>
                </div>

                <!-- <?php echo $this->session->flashdata('notify'); ?>
                <?php echo validation_errors(); ?> -->
                <!-- OVERVIEW -->
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ekstrakulikuler</h3>
                        <p class="panel-subtitle">Pilihan Ekstrakulikuler</p>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="display" id="data">
                                <thead>
                                    <tr>
                                        <th>Nama Ekstrakurikuler</th>
                                        <th>Deskripsi</th>
                                        <th>Jadwal Ekstrakulikuler</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $total = 0;
                                    foreach ($set as $row) {

                                    ?>

                                        <tr>
                                            <td><?php echo $row->nama_ekskul; ?></td>
                                            <td><?php echo $row->lokasi; ?></td>
                                            <td><?php echo $row->hari; ?>, <?php echo $row->jam_mulai; ?> - <?php echo $row->jam_selesai; ?></td>
                                            <td>
                                                <input type="checkbox" name="rombel" aria-label="Checkbox for following text input" value="<?php echo $row->id_ekskul; ?>">
                                                <?php echo anchor('user/registered/' . $row->id_ekskul, 'Pilih', array('onclick' => 'return confirm("Anda yakin ingin mengikuti ekskul ini?")')); ?>

                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                            <button class="btn btn-warning"><i class="fa fa-check"></i> Daftar</button>
                        </div>
                    </div>
                </div>

                <!-- END MAIN CONTENT -->
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>