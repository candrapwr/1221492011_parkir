@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ asset('admin/devices/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="<?php echo $modelData->id ?>">
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Serial Number</label>
        <div class="col-sm-9">
            <input type="text" name="serial_number" class="form-control" value="<?php echo $modelData->serial_number ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Serial No</label>
        <div class="col-sm-9">
            <input type="text" name="printer_serial_no" class="form-control" value="<?php echo $modelData->printer_serial_no ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Service Version</label>
        <div class="col-sm-9">
            <input type="text" name="printer_service_version" class="form-control" value="<?php echo $modelData->printer_service_version ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Firmware Version</label>
        <div class="col-sm-9">
            <input type="text" name="printer_firmware_version" class="form-control" value="<?php echo $modelData->printer_firmware_version ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Model</label>
        <div class="col-sm-9">
            <input type="text" name="printer_model" class="form-control" value="<?php echo $modelData->printer_model ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary " value="Simpan">
                <a href="{{ asset('admin/devices') }}" class="btn btn-danger">Batal</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>