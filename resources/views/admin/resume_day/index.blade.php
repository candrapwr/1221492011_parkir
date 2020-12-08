<style>
	#exTab2 h3 {
		color: white;
		background-color: #428bca;
		padding: 5px 15px;
	}
</style>
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

</p>
<div class="btn-group">
	<input type="date" value="{{Session()->get('date_filter')}}">
</div>
<div class="clearfix">
	<hr>
</div>
<div class="table-responsive mailbox-messages">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link" href="#tab1" role="tab" data-toggle="tab">Transaksi Jukir</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#tab2" role="tab" data-toggle="tab">Transaksi Area Parkir</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#tab3" role="tab" data-toggle="tab">Transaksi Tpe Kendaraan</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#tab4" role="tab" data-toggle="tab">Detail Transaksi</a>
		</li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane fade" id="tab1">
			<div class="">
				<br>
				Transaksi Jukir
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" id="tbl2" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10px">No</th>
							<th>Tanggal</th>
							<th>Jukir</th>
							<th>Transaksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;
						foreach ($modelDataJ as $value) { ?>
							<td class="text-center">
								<small class="text-center"><?php echo $i ?></small>
							</td>
							<td><?php echo date('d/m/Y', strtotime($value->dates)) ?></td>
							<td><?php echo $value->jukir_name ?></td>
							<td>Rp. <?php echo number_format($value->fee, 2, ',', '.') ?></td>
							</tr>
						<?php $i++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="tab2">
			<div class="">
				<br>
				Transaksi Area Parkir
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" id="tbl3" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10px">No</th>
							<th>Tanggal</th>
							<th>Area Parkir</th>
							<th>Transaksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;
						foreach ($modelDataAP as $value) { ?>
							<td class="text-center">
								<small class="text-center"><?php echo $i ?></small>
							</td>
							<td><?php echo date('d/m/Y', strtotime($value->dates)) ?></td>
							<td><?php echo $value->parking_lot_name ?></td>
							<td>Rp. <?php echo number_format($value->fee, 2, ',', '.') ?></td>
							</tr>
						<?php $i++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="tab3">
			<div class="">
				<br>
				Transaksi Tpe Kendaraan
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" id="tbl4" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10px">No</th>
							<th>Tanggal</th>
							<th>Kendaraan</th>
							<th>Transaksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;
						foreach ($modelDataTK as $value) { ?>
							<td class="text-center">
								<small class="text-center"><?php echo $i ?></small>
							</td>
							<td><?php echo date('d/m/Y', strtotime($value->dates)) ?></td>
							<td><?php echo $value->transportation_name ?></td>
							<td>Rp. <?php echo number_format($value->fee, 2, ',', '.') ?></td>
							</tr>
						<?php $i++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="tab4">
			<div class="">
				<br>
				Detail Transaksi
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" id="tbl1" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10px">No</th>
							<th>Tanggal</th>
							<th>Jukir</th>
							<th>Area Parkir</th>
							<th>Wilayah</th>
							<th>Kendaraan</th>
							<th>Transaksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;
						foreach ($modelData as $value) { ?>
							<td class="text-center">
								<small class="text-center"><?php echo $i ?></small>
							</td>
							<td><?php echo date('d/m/Y', strtotime($value->dates)) ?></td>
							<td><?php echo $value->jukir_name ?></td>
							<td><?php echo $value->parking_lot_name ?></td>
							<td><?php echo $value->territory_name ?></td>
							<td><?php echo $value->transportation_name ?></td>
							<td>Rp. <?php echo number_format($value->fee, 2, ',', '.') ?></td>
							</tr>
						<?php $i++;
						} ?>
					</tbody>
					<tbody>
						<td class="text-center"></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('public/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	$('#tbl1').DataTable({
		searching: true,
		paging: true,
		dom: 'Bfrtip',
		info: false
	});
	$('#tbl2').DataTable({
		searching: true,
		paging: true,
		dom: 'Bfrtip',
		info: false
	});
	$('#tbl3').DataTable({
		searching: true,
		paging: true,
		dom: 'Bfrtip',
		info: false
	});
	$('#tbl4').DataTable({
		searching: true,
		paging: true,
		dom: 'Bfrtip',
		info: false
	});
</script>