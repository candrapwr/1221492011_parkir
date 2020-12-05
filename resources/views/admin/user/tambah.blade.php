<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('admin/user/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
                    {{ csrf_field() }}
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Username</label>
						<div class="col-sm-9">
							<input type="text" name="username" class="form-control" value="{{ old('username') }}" required autocomplete="off">
						</div>
					</div>					

							<input type="hidden" name="id_smartparkir" class="form-control" value="-" required>
					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">NPP</label>
						<div class="col-sm-4">
							<input type="text" name="npp" class="form-control" value="{{ old('npp') }}" required>
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Nama</label>
						<div class="col-sm-9">
							<input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Alamat</label>
						<div class="col-sm-9">
							<input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Telpon</label>
						<div class="col-sm-4">
							<input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Hak Akses</label>					
						<div class="col-sm-6">
							<select name="role" class="form-control" required>
								<option value=""></option>
								@foreach($modelRole as $role)
								<option value="{{ $role->id }}">{{ $role->name }}</option>
								@endforeach
							</select>
						</div>	
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Password</label>
						<div class="col-sm-9">
							<input type="password" name="password" class="form-control" value="" required autocomplete="off">
						</div>
					</div>						
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-right"></label>
                        <div class="col-sm-9">
                            <div class="form-group pull-right btn-group">
                                <input type="submit" name="submit" class="btn btn-primary " value="Simpan">
                                <button type="button" class="btn btn-danger " data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>