<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Transportation Cat.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('admin/transportation/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Name</label>
						<div class="col-sm-9">
							<input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Description</label>
						<div class="col-sm-9">
							<textarea name="description" id="description"  class="form-control simple">{{ old('description') }}</textarea>						
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Icon/Image</label>
						<div class="col-sm-9">
							<input type="text" name="image" class="form-control" value="{{ old('image') }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Code</label>
						<div class="col-sm-2">
							<input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Fee</label>
						<div class="col-sm-4">
							<input type="number" name="fee" class="form-control" value="{{ old('fee') }}" required>
						</div>
					</div>	
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-right"></label>
                        <div class="col-sm-9">
                            <div class="form-group pull-right btn-group">
                                <input type="submit" name="submit" class="btn btn-primary " value="Save Add Data">
                                <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>