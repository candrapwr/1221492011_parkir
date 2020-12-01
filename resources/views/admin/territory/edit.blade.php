@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ asset('admin/territory/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="<?php echo $modelData->id ?>">
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Nama</label>
        <div class="col-sm-9">
            <input type="text" name="name" class="form-control" value="<?php echo $modelData->name ?>" required>
        </div>
    </div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Kota</label>					
		<div class="col-sm-6">
			<select name="city" class="form-control" required>
				<option value=""></option>
				@foreach($modelCity as $city)
				<option value="{{ $city->id }}" @if($city->id==$modelData->city) selected @endif >{{ $city->name }}</option>
				@endforeach
			</select>
		</div>	
	</div>
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary " value="Save">
                <a href="{{ asset('admin/territory') }}" class="btn btn-danger">Back</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>