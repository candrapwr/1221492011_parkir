@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ asset('admin/user/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="<?php echo $modelData->id ?>">
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Username</label>
						<div class="col-sm-9">
							<input type="text" name="username" class="form-control" value="<?php echo $modelData->username ?>" readonly autocomplete="off">
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">ID</label>
						<div class="col-sm-4">
							<input type="text" name="id_smartparkir" class="form-control" value="<?php echo $modelData->id_smartparkir ?>" readonly>
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">NPP</label>
						<div class="col-sm-4">
							<input type="text" name="npp" class="form-control" value="<?php echo $modelData->npp ?>" required>
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Nama</label>
						<div class="col-sm-9">
							<input type="text" name="name" class="form-control" value="<?php echo $modelData->name ?>" required>
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Alamat</label>
						<div class="col-sm-9">
							<input type="text" name="address" class="form-control" value="<?php echo $modelData->address ?>" required>
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Telpon</label>
						<div class="col-sm-4">
							<input type="text" name="phone_number" class="form-control" value="<?php echo $modelData->phone_number ?>" required>
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Hak Akses</label>					
						<div class="col-sm-6">
							<select name="role" class="form-control" required>
								<option value=""></option>
								@foreach($modelRole as $role)
								<option value="{{ $role->id }}" @if($role->id==$modelData->role) selected @endif>{{ $role->name }}</option>
								@endforeach
							</select>
						</div>	
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Password</label>
						<div class="col-sm-9">
							<input type="password" name="password" class="form-control" value="" autocomplete="off">
							<em>Kosongkan jika tidak ingin menggati password</em>
						</div>
					</div>		

    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary " value="Simpan">
                <a href="{{ asset('admin/user') }}" class="btn btn-danger">Batal</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>