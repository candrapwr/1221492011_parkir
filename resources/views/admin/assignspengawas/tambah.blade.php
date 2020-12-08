<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Jukir</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('admin/assignspengawas/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <input type="hidden" name="created_by" value="2">
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-right">Pengawas</label>
                        <div class="col-sm-6">
                            <select name="pengawas" class="form-control sel2" required>
                                <option value=""></option>
                                @foreach($modelUser as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                <option value="{{ $wil->id }}">{{ $wil->name }}</option>
                                @endforeach
                            </select>
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