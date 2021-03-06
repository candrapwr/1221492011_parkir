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
	@include('admin/user/tambah')
</p>
<div class="btn-group">
	<button type="button" class="btn btn-success " data-toggle="modal" data-target="#Tambah">
		<i class="fa fa-plus"></i> Tambah User
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
					<th></th>
					<th>Username</th>
					<th>Nama</th>
					<th>ID</th>
					<th>ALamat</th>
					<th>Telepon</th>
					<th>Hak Akses</th>
					<th width="5%">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;
				foreach ($modelData as $value) { ?>
					<td class="text-center">
						<small class="text-center"><?php echo $i ?></small>
					</td>
					<td>
						<?php if (@getimagesize($value->image_profile)) { ?>
							<img src="<?php echo $value->image_profile ?>" width="50px">
						<?php } ?>
					</td>
					<td><?php echo $value->username ?></td>
					<td><?php echo $value->name ?></td>
					<td><?php echo $value->id_smartparkir ?></td>
					<td><?php echo $value->address ?></td>
					<td><?php echo $value->phone_number ?></td>
					<td><?php echo $value->role_name ?></td>
					<td>
						<div class="btn-group">
							<a href="{{ asset('admin/user/edit/'.Crypt::encrypt($value->id)) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
							<a href="{{ asset('admin/user/delete/'.Crypt::encrypt($value->id)) }}" class="btn btn-danger btn-sm  delete-link">
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