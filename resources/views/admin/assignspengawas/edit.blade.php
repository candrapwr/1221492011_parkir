@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<form action="{{ asset('admin/assignspengawas/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	{{ csrf_field() }}
	<input type="hidden" name="id" value="<?php echo $modelData->id ?>">
	<input type="hidden" name="created_by" value="2">
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Pengawas</label>
		<div class="col-sm-6">
			<select name="pengawas" class="form-control sel2" required>
				<option value=""></option>
				@foreach($modelUser as $user)
				<option value="{{ $user->id }}" @if($user->id==$modelData->pengawas) selected @endif>{{ $user->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Wilayah</label>
		<div class="col-sm-6">
			<select name="territory" class="form-control sel2" required>
				<option value=""></option>
				@foreach($modelT as $wil)
				<option value="{{ $wil->id }}" @if($wil->id==$modelData->territory) selected @endif>{{ $wil->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right"></label>
		<div class="col-sm-9">
			<div class="form-group pull-right btn-group">
				<input type="submit" name="submit" class="btn btn-primary " value="Simpan">
				<a href="{{ asset('admin/assignspengawas') }}" class="btn btn-danger">Batal</a>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</form>