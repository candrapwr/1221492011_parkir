@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ asset('admin/fee/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="<?php echo $modelData->id ?>">
	<input type="hidden" name="created_by" value="2">
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Wilayah</label>					
		<div class="col-sm-6">
			<select name="territory" class="form-control sel2" required>
				<option value=""></option>
				@foreach($modelTerritory as $territory)
				<option value="{{ $territory->id }}" @if($territory->id==$modelData->territory) selected @endif>{{ $territory->name }}</option>
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
		<label class="col-sm-3 control-label text-right">Tarif</label>
		<div class="col-sm-4">
			<input type="number" name="fee" class="form-control" value="<?php echo $modelData->fee ?>" required>
		</div>
	</div>	
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary " value="Simpan">
                <a href="{{ asset('admin/fee') }}" class="btn btn-danger">Batal</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>