<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Perangkat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('admin/devices/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Serial Number</label>
						<div class="col-sm-9">
							<input type="text" name="serial_number" class="form-control" value="{{ old('serial_number') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Serial No</label>
						<div class="col-sm-9">
							<input type="text" name="printer_serial_no" class="form-control" value="{{ old('printer_serial_no') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Service Version</label>
						<div class="col-sm-9">
							<input type="text" name="printer_service_version" class="form-control" value="{{ old('printer_service_version') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Firmware Version</label>
						<div class="col-sm-9">
							<input type="text" name="printer_firmware_version" class="form-control" value="{{ old('printer_firmware_version') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Model</label>
						<div class="col-sm-9">
							<input type="text" name="printer_model" class="form-control" value="{{ old('printer_model') }}" required>
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