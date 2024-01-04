<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<!-- <?php echo $this->session->flashdata('notify'); ?>
				    <?php echo validation_errors(); ?> -->
			<!-- OVERVIEW -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">SISTEM INFORMASI EKSTRAKULIKULER SMKN 4 MALANG</h3>
					<p class="panel-subtitle">Hasil Pendaftaran & Nilai</p>
				</div>

				<div class="panel-body"><button class="btn btn-warning" data-toggle="modal" data-target="#myModal">+ Tambah</button>

					<?php echo anchor('admin/export_excel', '<button class="btn btn-info"> Export Excel</button>'); ?>

				</div>
				<?php if ($this->session->userdata('role') == 1) { ?>
					<div class="panel-body">
						<p class="panel-subtitle">Filter Hasil Pendaftaran Berdasarkan</p>
						<p class="panel-subtitle">

							<?php echo form_open('admin/search') ?>
							<select name="kategori" required="">
								<?php


								foreach ($dtbidang->result() as $row) {
								?>
									<option value="<?php echo $row->nama_ekskul; ?>"><?php echo $row->nama_ekskul; ?></option>


								<?php } ?>
							</select>
						</p>
					</div>
				<?php } ?>
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
							</thead>
							<tbody>

								<?php $no = $this->uri->segment('3') + 1;
								foreach ($set as $row) { ?>
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

						<?php if ($this->session->userdata('role') == 1) { ?>

							<button class="btn btn-warning">Filter</button>

							<?php echo form_close() ?>
						<?php } ?>

					</div>
				</div>
			</div>

			<!-- END MAIN CONTENT -->
		</div>
	</div>
</div>

<script>
	function edit_supplier(id) {
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo base_url('siswa/get') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_siswa"]').val(data.id_siswa);
				$('[name="nis"]').val(data.nis);
				$('[name="nama_siswa"]').val(data.nama_siswa);
				$('[name="tempat_lahir"]').val(data.tempat_lahir);
				$('[name="tanggal_lahir"]').val(data.tanggal_lahir);
				$('[name="alamat"]').val(data.alamat);
				$('[name="password"]').val(data.password);

				$('#myModal').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Siswa'); // Set title to Bootstrap modal title
				$('[name=submit]').val('Edit').show();
				$('.modal-footer').show();
				$('#form').attr('action', '<?php echo site_url('siswa/update'); ?>');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax' + jqXHR);
			}
		});
	}
</script>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Siswa</h4>
			</div>
			<div class="modal-body">
				<?php echo form_open('siswa/create', array('id' => 'form')); ?>
				<div class="row">
					<div class="col-md-6">
						<input type="hidden" name="id_siswa" />

						<div class="form-group" id="pengguna">
							<label>NIS</label>
							<input type="text" name="nis" class="form-control">
						</div>

						<div class="form-group" id="email">
							<label>Nama Siswa</label>
							<input type="text" name="nama_siswa" class="form-control">
						</div>

						<div class="form-group" id="email">
							<label>Tempat Lahir</label>
							<input type="text" name="tempat_lahir" class="form-control">
						</div>

						<div class="form-group" id="email">
							<label>Tanggal Lahir</label>
							<input type="date" name="tanggal_lahir" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group" id="email">
							<label>Username </label>
							<input type="text" name="alamat" class="form-control">
						</div>
						<div class="form-group" id="email">
							<label>Password</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Jurusan</label>
							<select name="kelas" id="" class="form-control">
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
						</div>
						<div class="form-group">
							<label for="">Kelas</label>
							<select name="kelas1" id="" class="form-control">
								<option value="X">X</option>
								<option value="XI">XI</option>
								<option value="XII">XII</option>


							</select>
						</div>

						<div class="form-group">
							<label for="">Jenis Kelamin</label>
							<select name="Jenis_kelamin" id="" class="form-control">
								<option value="Laki-Laki">Laki-Laki</option>
								<option value="Perempuan">Perempuan</option>

							</select>
						</div>
						<div class="form-group" id="email">
							<label for="">Nilai</label>
							<select name="nilai" id="" class="form-control">
								<option value="  "> </option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option>
								<option value="E">E</option>
							</select>
						</div>

						<div class="form-group">
							<?php
							$tgl = date('Y-m-d'); { ?>
								<input type="hidden" class="form-control" name="tanggal_daftar" required="" value="<?php echo $tgl; ?>">
							<?php } ?>
						</div>
						<div class="form-group">
							<label for="">Ekstrakulikuler</label>
							<select name="rombel" id="" class="form-control">
								<?php


								foreach ($dtbidang->result() as $row) {
								?>
									<option value="<?php echo $row->id_ekskul; ?>"><?php echo $row->nama_ekskul; ?></option>


								<?php } ?>
							</select>
						</div>
					</div>
				</div>


				<div class="modal-footer">
					<input type="submit" name="submit" value="Tambah" class="btn btn-success" id="button-disabled">
					<?php echo form_close(); ?>
				</div>
			</div>

		</div>

	</div>
</div>
