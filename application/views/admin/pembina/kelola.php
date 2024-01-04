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
					<p class="panel-subtitle">Data Pembina</p>

				</div>
				<div class="panel-body">
					<button class="btn btn-warning" data-toggle="modal" data-target="#myModal">+ Tambah</button>
				</div>

				<?php $no = 1 ?>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="display" id="data">
							<thead>
								<tr>
									<th width="10px">No</th>
									<th width="220px">Nama Pembina</th>
									<th width="450px">Username</th>
									<th width="450px">Ekstrakulikuler</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>

								<?php foreach ($set as $row) { ?>

									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $row->nama_pembina; ?></td>
										<td><?php echo $row->username; ?></td>
										<td><?php echo $row->nama_ekskul; ?></td>

										<td>
											<button class="btn btn-warning" data-toggle="modal" data-target="#modaledit<?= $no ?>"><i class="fa fa-edit"></i> Ubah</button>

											<?php echo anchor('pembina/destroy/' . $row->id_pembina, '<button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>');
											?>



										</td>
									</tr>
									<div id="modaledit<?= $no ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Pembina</h4>
												</div>
												<div class="modal-body">
													<form action="<?= base_url() ?>pembina/edit" method="post">
														<input type="hidden" name="id_pembina" value="<?= $row->id_pembina ?>" />

														<div class="form-group" id="pengguna">
															<label>Nama Pembina</label>
															<input type="text" name="nama_pembina" class="form-control" value="<?= $row->nama_pembina ?>">
														</div>

														<div class="form-group" id="email">
															<label>Username</label>
															<input type="text" name="username" class="form-control" value="<?= $row->username ?>">
														</div>
														<div class="form-group" id="email">
															<label>Password</label>
															<input type="text" name="password" class="form-control" value="<?= $row->password ?>">
														</div>
														<div class="form-group" id="email">
															<label>Ekstrakulikuler</label>
															<select class="form-control" name="id_ekskul" id="ekstrakulikuler">
																<?php foreach ($set_ekskul as $row1) { ?>
																	<option value="<?= $row1->id_ekskul ?>" <?= ($row->id_ekskul == $row1->id_ekskul) ? 'selected' : '' ?>>
																		<?= $row1->nama_ekskul ?>
																	</option>
																<?php } ?>
															</select>
														</div>
														<div class="modal-footer">
															<input type="submit" name="submit" value="Edit" class="btn btn-success" id="button-disabled">
													</form>
												</div>
											</div>

										</div>

									</div>
								<?php } ?>
					</div>

					</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- END MAIN CONTENT -->
	</div>
</div>
</div>

<!-- <script>
    
    function dokumentasi(id){
        $('#form')[0].reset();
        $("#dokumentasi").modal('show');
        $('#id_ekskul').val(id);
        $('[name=submit]').val('Tambah').show();
        $('.modal-footer').show();

    }   
   
    function edit_supplier(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('ekskul/get') ?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_ekskul"]').val(data.id_ekskul);
            $('[name="nama_ekskul"]').val(data.nama_ekskul);
            $('[name="penanggung_jawab"]').val(data.penanggung_jawab);
            $('[name="lokasi"]').val(data.lokasi);
            $('[name="hari"]').val(data.hari);
            $('[name="jam_mulai"]').val(data.jam_mulai);
            $('[name="jam_selesai"]').val(data.jam_selesai);
            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Ekskul'); // Set title to Bootstrap modal title
            $('[name=submit]').val('Edit').show();
            $('.modal-footer').show();
            $('#form').attr('action','<?php echo site_url('ekskul/update'); ?>');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax'+jqXHR);
        }
    });
    }
    
   
</script> -->
<div id="dokumentasi" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Dokumentasi</h4>
			</div>
			<div class="modal-body">
				<?php echo form_open_multipart('dokumentasi/create', array('id' => 'form', 'class' => 'dropzone')); ?>
				<input type="hidden" name="id_ekskul" id="id_ekskul">
			</div>
			<div class="modal-footer">
				<input type="submit" name="submit" value="Selesai" class="btn btn-success" id="button-disabled">
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

</div>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Pembina</h4>
			</div>
			<div class="modal-body">
				<?php echo form_open('pembina/create', array('id' => 'form')); ?>
				<input type="hidden" name="id_pembina" />

				<div class="form-group" id="pengguna">
					<label>Nama Pembina</label>
					<input type="text" name="nama_pembina" class="form-control">
				</div>

				<div class="form-group" id="email">
					<label>Username</label>
					<input type="text" name="username" class="form-control">
				</div>
				<div class="form-group" id="email">
					<label>Password</label>
					<input type="text" name="password" class="form-control">
				</div>
				<div class="form-group" id="email">
					<label>Ekstrakulikuler</label>
					<select class="form-control" name="id_ekskul" id="ekstrakulikuler">
						<?php foreach ($set_ekskul as $row) { ?>
							<option value="<?= $row->id_ekskul ?>"><?= $row->nama_ekskul ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="modal-footer">
					<input type="submit" name="submit" value="Tambah" class="btn btn-success" id="button-disabled">
					<?php echo form_close(); ?>
				</div>
			</div>

		</div>

	</div>
</div>
