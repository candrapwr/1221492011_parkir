<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Tambah Tarif Parkir</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ asset('admin/fee/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					<input type="hidden" name="created_by" value="2">
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Wilayah</label>
						<div class="col-sm-6">
							<select name="territory" class="form-control sel2" required>
								<option value=""></option>
								@foreach($modelTerritory as $territory)
								<option value="{{ $territory->id }}">{{ $territory->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Kendaraan</label>
						<div class="col-sm-6">
							<select name="transportation" class="form-control sel2" required>
								<option value=""></option>
								@foreach($modelTransportation as $transportation)
								<option value="{{ $transportation->id }}">{{ $transportation->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Tarif</label>
						<div class="col-sm-4">
							<input type="number" name="fee" class="form-control" value="{{ old('fee') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right"></label>
						<div class="col-sm-9">
							<div class="form-group pull-right btn-group">
								<input type="submit" name="submit" class="btn btn-primary " value="Simpan data">
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