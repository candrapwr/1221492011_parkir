@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ asset('admin/quota/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="<?php echo $modelData->id ?>">
	<input type="hidden" name="created_by" value="2">
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Wilayah</label>					
		<div class="col-sm-6">
			<select name="territory" class="form-control sel2" required>
				<option value=""></option>
				@foreach($modelLot as $parking_lot)
				<option value="{{ $parking_lot->id }}" @if($parking_lot->id==$modelData->parking_lot) selected @endif>{{ $parking_lot->name }}</option>
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
				<option value="{{ $transportation->id }}" @if($transportation->id==$modelData->transportation) selected @endif>{{ $transportation->name }}</option>
				@endforeach
			</select>
		</div>	
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Kuota</label>
		<div class="col-sm-4">
			<input type="number" name="quota" class="form-control" value="<?php echo $modelData->quota ?>" required>
		</div>
	</div>	
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary " value="Simpan">
                <a href="{{ asset('admin/quota') }}" class="btn btn-danger">Batal</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>