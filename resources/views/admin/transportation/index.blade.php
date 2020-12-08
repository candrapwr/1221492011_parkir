@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<p>
	@include('admin/transportation/tambah')
</p>
<div class="btn-group">
	<button type="button" class="btn btn-success " data-toggle="modal" data-target="#Tambah">
		<i class="fa fa-plus"></i> Tambah Kategori
	</button>
</div>
<div class="clearfix">
	<hr>
</div>
<div class="table-responsive mailbox-messages">
	<div class="table-responsive">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th width="5%">No</th>
					<th>Nama</th>
					<th>Kode</th>
					<th>Ikon</th>
					<th width="5%"></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;
				foreach ($modelData as $value) { ?>
					<td class="text-center">
						<small class="text-center"><?php echo $i ?></small>
					</td>
					<td><?php echo $value->name ?></td>
					<td><?php echo $value->code ?></td>
					<td>
						<?php if (file_exists("public/upload/image/icon" . "/" . $value->image . ".png")) { ?>
							<img src="<?php echo asset('public/upload/image/icon') . "/" . $value->image . ".png" ?>">
						<?php } ?>
					</td>
					<td>
						<div class="btn-group">
							<a href="{{ asset('admin/transportation/edit/'.Crypt::encrypt($value->id)) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
							<a href="{{ asset('admin/transportation/delete/'.Crypt::encrypt($value->id)) }}" class="btn btn-danger btn-sm  delete-link">
								<i class="fa fa-trash"></i></a>
						</div>
					</td>
					</tr>
				<?php $i++;
				} ?>
			</tbody>
		</table>
	</div>
</div>