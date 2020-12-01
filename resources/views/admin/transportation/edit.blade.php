@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ asset('admin/transportation/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="<?php echo $modelData->id ?>">
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Nama</label>
		<div class="col-sm-9">
			<input type="text" name="name" class="form-control" value="<?php echo $modelData->name ?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Diskripsi</label>
		<div class="col-sm-9">
			<textarea name="description" id="description"  class="form-control simple" required><?php echo $modelData->description ?></textarea>						
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Ikon</label>
		<div class="col-sm-9">
			<input type="text" name="image" class="form-control" value="<?php echo $modelData->image ?>">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Kode</label>
		<div class="col-sm-2">
			<input type="text" name="code" class="form-control" value="<?php echo $modelData->code ?>" required>
			<input type="hidden" name="fee" class="form-control" value="<?php echo $modelData->fee ?>" required>
		</div>
	</div>
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary " value="Simpan">
                <a href="{{ asset('admin/transportation') }}" class="btn btn-danger">Batal</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>