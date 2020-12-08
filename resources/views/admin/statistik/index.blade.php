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
<p></p>
<div class="clearfix">
	<hr>
</div>
<div class="mailbox-messages">
	<div class="row">
		<div class="col-lg-5 col-md-4 pickers" data-select2-id="7">
			<div class="form-group row" data-select2-id="6">
				<label class="col-sm-2 col-xs-12 col-form-label font-weight-bold">Status</label>
				<div class="col-sm-10 col-xs-12">
					<select class="form-control" required="" style="width: 100%" name="jenis" onchange="rubah(this.value)">
						<option value="hari">Harian</option>
						<option value="bulan">Bulanan</option>
						<option value="tahun">Tahunan</option>
						<option value="semua">Semua</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-lg-5 col-md-4">
			<div class="form-group row"><label class="col-sm-2 col-xs-12 col-form-label font-weight-bold">Bulan</label>
				<div class="col-sm-10 col-xs-12 dates">
					<div class="input-group date">
						<span class="input-group-addon"></span>
						<input type="number" autocomplete="off" id="date" name="date" class="form-control" value="2020">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-4">
			<button type="submit" class="btn btn-success btn-block rounded-0">
				<i class="fa fa-search"></i> Filter
			</button>
		</div>
	</div>
</div>
<script src="{{ asset('public/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	function rubah(jenis) {
		console.log(jenis)
		if (jenis == 'hari') {
			document.getElementById('date').type = 'date';
		} else if (jenis == 'bulan') {
			document.getElementById('date').type = 'month';
		} else if (jenis == 'tahun') {
			document.getElementById('date').type = 'number';
		} else if (jenis == 'semua') {
			document.getElementById('date').type = 'text';
		}
	}
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