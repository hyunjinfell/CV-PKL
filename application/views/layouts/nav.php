<!-- WRAPPER -->
<div id="wrapper">
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
			<?php } else if($this->session->userdata('role') == 2) { ?>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> Pembina</i>
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
	<div id="sidebar-nav" class="sidebar">
		<div class="sidebar-scroll">
			<ul class="nav">
				<?php if ($this->session->userdata('role') == 1) { ?>
					<center>
						<img src="<?php echo base_url(); ?>assets/img/1.png" alt="Logo SMAN 1 Tempuran" height="100">
					</center>
					<li><a href="<?php echo site_url('admin'); ?>" class="<?= ($this->uri->segment(2) == '') ? 'active' : '' ?>"> <span>Dashboard</span></a></li>
					<li><a href="<?php echo site_url('admin/ekskul'); ?>" class="<?= ($this->uri->segment(2) == 'ekskul') ? 'active' : '' ?>"><span>Data Ekstrakulikuler</span></a></li>
					<li><a href="<?php echo site_url('admin/siswa'); ?>" class="<?= ($this->uri->segment(2) == 'siswa') ? 'active' : '' ?>"><span>Data Siswa</span></a></li>

					<li><a href="<?php echo site_url('admin/pengguna'); ?>" class="<?= ($this->uri->segment(2) == 'pengguna') ? 'active' : '' ?>"> <span>Data Pendaftar</span></a></li>
					<!--<li><a href="<?php echo site_url('admin/penjadwalan'); ?>" ><span>Penjadwalan</span></a></li>-->

					<li><a href="<?php echo site_url('admin/laporan'); ?>" class="<?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>"><span>Hasil Pendaftaran & Nilai</span></a></li>
					<li class="nav-item">
						<a class="nav-link <?= ($this->uri->segment(2) == 'pembina') || ($this->uri->segment(2) == 'pembinaEkskul') ? 'active' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
							<span>Data Pembina</span> <span class="caret"></span>
						</a>
						<div id="collapseOne" class="collapse nav <?= ($this->uri->segment(2) == 'pembina') || ($this->uri->segment(2) == 'pembinaEkskul') ? 'in' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
							<ul class="nav py-2 collapse-inner rounded">
								<li class="nav-item <?= ($this->uri->segment(2) == 'pembina') || ($this->uri->segment(2) == 'pembinaEkskul') ? 'active' : '' ?>"><a href="<?php echo site_url('admin/pembina'); ?>" ><span>Tambah Pembina</span></a></li>
								<li class="nav-item">
									<a class="nav-link <?= ($this->uri->segment(2) == 'pembinaEkskul') ? 'active' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										<span>Pembina</span> <span class="caret"></span>
									</a>
									<div id="collapseTwo" class="collapse nav <?= ($this->uri->segment(2) == 'pembinaEkskul') ? 'in' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
										<ul class="nav py-2 collapse-inner rounded">
											<?php $this->load->model('GlobalCrud', 'crud');
											$ekskul = $this->crud->all('ekskul')->result();
											foreach ($ekskul as $row) { ?>
												<li class="nav-item"><a href="<?php echo site_url('admin/pembinaEkskul/' . $row->id_ekskul); ?>"><span><?= $row->nama_ekskul ?></span></a></li>
											<?php } ?>
										</ul>
									</div>
								</li>
							</ul>
						</div>
					</li>

					<li><a href="<?php echo base_url('login/signout'); ?>"><span>Logout</span></a></li>
				<?php } else if ($this->session->userdata('role') == 2) { ?>
					<center>
						<img src="<?php echo base_url(); ?>assets/img/1.png" alt="Logo SMAN 1 Tempuran" height="100">
					</center>
					<li><a href="<?php echo site_url('admin'); ?>" class="<?= ($this->uri->segment(2) == '') ? 'active' : '' ?>"> <span>Dashboard</span></a></li>
					<li><a href="<?php echo site_url('admin/siswa'); ?>" class="<?= ($this->uri->segment(2) == 'siswa') ? 'active' : '' ?>"><span>Data Siswa</span></a></li>

					<li><a href="<?php echo site_url('admin/laporan'); ?>" class="<?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>"><span>Hasil Pendaftaran & Nilai</span></a></li>

					<li><a href="<?php echo base_url('login/signout'); ?>"><span>Logout</span></a></li>
				<?php } else { ?>

					<li><a href="<?php echo site_url('user/register'); ?>"class="<?= ($this->uri->segment(2) == 'register') ? 'active' : '' ?>"><span>Registrasi Ekskul</span></a></li>
					<li><a href="<?php echo site_url('user/galeri'); ?>" class="<?= ($this->uri->segment(2) == 'galeri') ? 'active' : '' ?>"><span>Galeri Ekstrakulikuler</span></a></li>

					<li><a href="<?php echo base_url('login/signout'); ?>"><span>Logout</span></a></li>

				<?php } ?>
			</ul>
		</div>
	</div>
	<!-- END LEFT SIDEBAR -->
