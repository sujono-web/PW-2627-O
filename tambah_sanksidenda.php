<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<h1>Tambah Sanksi Denda</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					<a href="index.php?hal=sanksidenda"
					class="btn btn-success">
					<i class="fas fa-arrow-left"></i>
					Kembali Sanksi Denda
				</a>
			</div>
			<form method="POST">
				<div class="card-body">
					<div class="form-group">
						<label>Nomor Sanksi Denda</label>
						<input
						type="text"
						name="nosanksi"
						class="form-control"
						value="Auto"
						readonly>
					</div>
					<div class="form-group">
						<label>Tanggal Sanksi</label>
						<input
						type="text"
						name="tglsanksi"
						class="form-control"
						value="Sysdate"
						readonly>
					</div>
					<div class="form-group">
						<label>Nomor Pengembalian</label>
						<select
						name="nokembali"
						class="form-control">
						<option value="">
							Pilih
						</option>
					</select>
				</div>
				<div class="form-group">
					<label>Nomor Peminjaman</label>
					<input
					type="text"
					class="form-control"
					value="Tampil"
					readonly>
				</div>
				<div class="form-group">
					<label>Tanggal Harus Kembali</label>
					<input
					type="text"
					class="form-control"
					value="Tampil"
					readonly>
				</div>
				<div class="form-group">
					<label>Nama Anggota</label>
					<input
					type="text"
					class="form-control"
					value="Tampil"
					readonly>
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="10%">
								No
							</th>
							<th width="25%">
								Nomor Denda
							</th>
							<th>
								Nama Denda
							</th>
							<th width="20%">
								Besar Denda
							</th>
							<th width="15%">
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center">
								Tampil
							</td>
							<td>
								<select
								name="nodenda[]"
								class="form-control">
								<option value="">
									Pilih
								</option>
							</select>
						</td>
						<td>
							Tampil
						</td>
						<td>
							<input
							type="text"
							name="jumlah[]"
							class="form-control">
						</td>
						<td align="center">
							<button
							type="button"
							class="btn btn-success">
							Tambah
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="card-footer">
		<button
		type="submit"
		class="btn btn-success">
		<i class="fas fa-save"></i>
		Simpan
	</button>
</div>
</form>
</div>
</div>
</section>
</div>