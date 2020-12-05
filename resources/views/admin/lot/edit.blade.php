@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ asset('admin/lot/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="<?php echo $modelData->id ?>">
	<input type="hidden" name="created_by" value="2">
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Nama</label>
		<div class="col-sm-9">
			<input type="text" name="name" class="form-control" value="<?php echo $modelData->name ?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Alamat</label>
		<div class="col-sm-9">
			<textarea name="address" id="address"  class="form-control"><?php echo $modelData->address ?></textarea>						
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Lat.</label>
		<div class="col-sm-4">
			<input type="text" name="lat" class="form-control" value="<?php echo $modelData->lat ?>" required>
		</div>
	</div>	
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Lng.</label>
		<div class="col-sm-4">
			<input type="text" name="lng" class="form-control" value="<?php echo $modelData->lng ?>" required>
		</div>
	</div>					
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Wilayah</label>					
		<div class="col-sm-6">
			<select name="territory" class="form-control" required>
				<option value=""></option>
				@foreach($modelTerritory as $territory)
				<option value="{{ $territory->id }}" @if($territory->id==$modelData->territory) selected @endif>{{ $territory->name }}</option>
				@endforeach
			</select>
		</div>	
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Target Harian</label>
		<div class="col-sm-4">
			<input type="number" name="target_daily_profit" class="form-control" value="<?php echo $modelData->target_daily_profit ?>" required>
		</div>
	</div>	
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Set Tampil Target</label>					
		<div class="col-sm-6">
			<select name="territory" class="form-control" required>
				<option value="HARIAN">HARIAN</option>
				<option value="BULANAN">BULANAN</option>
			</select>
		</div>	
	</div>
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary " value="Simpan">
                <a href="{{ asset('admin/lot') }}" class="btn btn-danger">Batal</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>