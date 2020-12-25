<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Kuota Parkir</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('admin/quota/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
					<input type="hidden" name="created_by" value="2">
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Area Parkir</label>					
						<div class="col-sm-6">
							<select name="parking_lot" class="form-control sel2" required>
								<option value=""></option>
								@foreach($modelLot as $parking_lot)
								<option value="{{ $parking_lot->id }}">{{ $parking_lot->name }}</option>
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
						<label class="col-sm-3 control-label text-right">Kuota</label>
						<div class="col-sm-4">
							<input type="number" name="quota" class="form-control" value="{{ old('quota') }}" required>
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