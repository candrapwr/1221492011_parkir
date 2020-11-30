<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Parking Lot</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('admin/lot/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
					<input type="hidden" name="created_by" value="2">
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Name</label>
						<div class="col-sm-9">
							<input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Address</label>
						<div class="col-sm-9">
							<textarea name="address" id="address"  class="form-control">{{ old('address') }}</textarea>						
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Lat.</label>
						<div class="col-sm-4">
							<input type="text" name="lat" class="form-control" value="{{ old('lat') }}" required>
						</div>
					</div>	
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Lng.</label>
						<div class="col-sm-4">
							<input type="text" name="lng" class="form-control" value="{{ old('lng') }}" required>
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Territory</label>					
						<div class="col-sm-6">
							<select name="territory" class="form-control" required>
								<option value=""></option>
								@foreach($modelTerritory as $territory)
								<option value="{{ $territory->id }}">{{ $territory->name }}</option>
								@endforeach
							</select>
						</div>	
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Target Daily Profit</label>
						<div class="col-sm-4">
							<input type="number" name="target_daily_profit" class="form-control" value="{{ old('target_daily_profit') }}" required>
						</div>
					</div>						
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-right"></label>
                        <div class="col-sm-9">
                            <div class="form-group pull-right btn-group">
                                <input type="submit" name="submit" class="btn btn-primary " value="Save Add Data">
                                <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>