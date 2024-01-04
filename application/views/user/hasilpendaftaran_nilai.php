<!-- WRAPPER -->
<style>
	.dataTables_filter {
		display: none;
	}

	.dataTables_length {
		display: none;
	}

	.dataTables_paginate {
		display: none;
	}
</style>

<div class="container" style="margin-top: 70px;">
	<!-- NAVBAR -->

	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="brand">
			<a href="#"><b>SIE-SMKN 4 Malang</b></a>
		</div>
		<div class="container-fluid">

			<div class="navbar-btn"> <!--<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>-->
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
				<form action="<?php echo base_url(); ?>user/edit" method="POST" enctype="multipart/form-data">
					<div class="panel panel-headline">

						<div class="panel-heading">
							<div class="panel-body">
								<div class="table-responsive">
									<table class="display" id="data">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Siswa</th>
												<th>NIS</th>
												<th>Jurusan</th>
												<th>Kelas</th>
												<th>Jenis Kelamin</th>
												<th>Tanggal Daftar</th>
												<th>Ektrakulikuler</th>
												<th>Keterangan</th>
												<th>Nilai</th>

											</tr>
										<tbody>

											<?php $no = $this->uri->segment('3') + 1;
											foreach ($set_ekskuluser as $row) { ?>
												<?php $date = date_create($row->tanggal_daftar);
												$new_date = date_format($date, "d-F-Y"); ?>
												<tr>

													<td><?php echo $no; ?></td>
													<td><?php echo $row->nama_siswa; ?></td>
													<td><?php echo $row->nis; ?></td>
													<th><?php echo $row->kelas; ?></th>
													<th><?php echo $row->kelas1; ?></th>
													<th><?php echo $row->Jenis_kelamin; ?></th>
													<th><?php echo date($row->tanggal_daftar); ?></th>
													<th><?php echo $row->nama_ekskul; ?></th>
													<th><?php echo $row->keterangan; ?></th>
													<th><?php echo $row->nilai; ?></th>


												</tr>
											<?php $no++;
											} ?>

										</tbody>
									</table>
								</div>

							</div>
						</div>


					</div>
				</form>
				<!--                    
                 <?php echo $this->session->flashdata('notify'); ?>
				    <?php echo validation_errors(); ?> -->
				<!-- OVERVIEW -->

				<!-- END MAIN CONTENT -->
			</div>
		</div>
	</div>
