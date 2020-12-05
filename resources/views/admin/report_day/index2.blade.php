<div class="callout callout-info">
<h5 class="mt-4 mb-2">&nbsp;&nbsp;Rekap Transaksi Area Parkir</h5>
<div class="row col-6">
  <div class="col-lg-6">
	<div class="input-group">
	  <div class="input-group-prepend">
		<span class="input-group-text">
		  <i class="fas fa-calendar"></i>
		</span>
	  </div>
	  <input id="bulan_a" type="month" class="form-control">
	</div>
  </div>
  <br>&nbsp;
  <div class="col-lg-12">
	<div class="input-group">
		<button type="button" onClick="javascript:lap_area();" class="btn btn-info">PROSES</button>
	</div>
  </div>
</div>
</div>
<div class="callout callout-info">
<h5 class="mt-4 mb-2">&nbsp;&nbsp;Rekap Transaksi Wilayah</h5>
<div class="row col-6">
  <div class="col-lg-6">
	<div class="input-group">
	  <div class="input-group-prepend">
		<span class="input-group-text">
		  <i class="fas fa-calendar"></i>
		</span>
	  </div>
	  <input id="bulan_w" type="month" class="form-control">
	</div>
  </div>
  <br>&nbsp;
  <div class="col-lg-12">
	<div class="input-group">
		<button type="button" onClick="javascript:lap_wilayah();" class="btn btn-info">PROSES</button>
	</div>
  </div>
</div>
</div>
<div class="callout callout-info">
<h5 class="mt-4 mb-2">&nbsp;&nbsp;Rekap Total Transaksi</h5>
<div class="row col-6">
  <div class="col-lg-6">
	<div class="input-group">
	  <div class="input-group-prepend">
		<span class="input-group-text">
		  <i class="fas fa-calendar"></i>
		</span>
	  </div>
	  <input id="bulan" type="month" class="form-control">
	</div>
  </div>
  <br>&nbsp;
  <div class="col-lg-12">
	<div class="input-group">
		<button type="button" onClick="javascript:lap_periode();" class="btn btn-info">PROSES</button>
	</div>
  </div>
</div>
</div>
<script>
function lap_area() {
	console.log($("#bulan_a").val());
	if($("#bulan_a").val()!=''){
		openInNewTab('{{ asset('admin/report_day/r_report_rekap_a') }}?bulan='+$("#bulan_a").val());
	}
}
function lap_wilayah() {
	console.log($("#bulan_w").val());
	if($("#bulan_w").val()!=''){
		openInNewTab('{{ asset('admin/report_day/r_report_rekap_w') }}?bulan='+$("#bulan_w").val());
	}
}
function lap_periode() {
	console.log($("#bulan").val());
	if($("#bulan").val()!=''){
		openInNewTab('{{ asset('admin/report_day/r_report_rekap') }}?bulan='+$("#bulan").val());
	}
}
function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}
</script>
