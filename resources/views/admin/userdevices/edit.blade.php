@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ asset('admin/assigns/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="<?php echo $modelData->id ?>">
	<input type="hidden" name="created_by" value="2">
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Parking Lot</label>					
		<div class="col-sm-6">
			<select name="parking_lot" class="form-control" required>
				<option value=""></option>
				@foreach($modelLot as $lot)
				<option value="{{ $lot->id }}" @if($lot->id==$modelData->parking_lot) selected @endif>{{ $lot->name }}</option>
				@endforeach
			</select>
		</div>	
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Jukir</label>					
		<div class="col-sm-6">
			<select name="jukir" class="form-control" required>
				<option value=""></option>
				@foreach($modelJukir as $jukir)
				<option value="{{ $jukir->id }}" @if($jukir->id==$modelData->jukir) selected @endif>{{ $jukir->name }}</option>
				@endforeach
			</select>
		</div>	
	</div>		
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary " value="Save">
                <a href="{{ asset('admin/assigns') }}" class="btn btn-danger">Back</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>