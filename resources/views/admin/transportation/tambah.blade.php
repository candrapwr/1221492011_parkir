<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Tambah Kategori</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ asset('admin/transportation/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Nama</label>
						<div class="col-sm-9">
							<input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Diskripsi</label>
						<div class="col-sm-9">
							<textarea name="description" id="description" class="form-control simple">{{ old('description') }}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Ikon</label>
						<div class="col-sm-9">
							<input type="text" name="image" class="form-control" value="{{ old('image') }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Kode</label>
						<div class="col-sm-2">
							<input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
							<input type="hidden" name="fee" class="form-control" value="{{ old('fee') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Ikon Kendaraan</label>
						<div class="col-sm-9">
							<input type="file" name="gambar" class="form-control" placeholder="Upload Foto" value="" required>
							<em>File harus bertipe .png, untuk mencari ikon <a target="_blank" href="https://www.iconsdb.com/blue-icons/">klik disini</a></em>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right"></label>
						<div class="col-sm-9">
							<div class="form-group pull-right btn-group">
								<input type="submit" name="submit" class="btn btn-primary " value="Simpan">
								<button type="button" class="btn btn-danger " data-dismiss="modal">Batal</button>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>