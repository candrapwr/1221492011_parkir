<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah WIlayah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('admin/territory/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-right">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-right">Kota</label>
                        <div class="col-sm-6">
                            <select name="city" class="form-control" required>
                                <option value=""></option>
                                @foreach($modelCity as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-right"></label>
                        <div class="col-sm-9">
                            <div class="form-group pull-right btn-group">
                                <input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
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