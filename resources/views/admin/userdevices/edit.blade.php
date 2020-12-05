@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ asset('admin/userdevices/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="<?php echo $modelData->id ?>">
	<input type="hidden" name="created_by" value="2">
					<input type="hidden" name="created_by" value="2">
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Jukir</label>					
						<div class="col-sm-6">
							<select name="user" class="form-control sel2" required>
								<option value=""></option>
								@foreach($modelJukir as $jukir)
								<option value="{{ $jukir->id }}" @if($jukir->id==$modelData->user) selected @endif>{{ $jukir->name }}</option>
								@endforeach
							</select>
						</div>	
					</div>	
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Device</label>					
						<div class="col-sm-6">
							<select name="device" class="form-control sel2" required>
								<option value=""></option>
								@foreach($modelDevice as $device)
								<option value="{{ $device->id }}" @if($device->id==$modelData->device) selected @endif>{{ $device->serial_number }}</option>
								@endforeach
							</select>
						</div>	
					</div>		
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary " value="Save">
                <a href="{{ asset('admin/userdevices') }}" class="btn btn-danger">Back</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>