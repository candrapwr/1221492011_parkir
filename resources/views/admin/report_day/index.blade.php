<div class="callout callout-info">
<h5 class="mt-4 mb-2">&nbsp;&nbsp;Tentukan Periode</h5>
<div class="row col-6">
  <div class="col-lg-6">
	<div class="input-group">
	  <div class="input-group-prepend">
		<span class="input-group-text">
		  <i class="fas fa-calendar"></i>
		</span>
	  </div>
	  <input id="tgl1" type="date" class="form-control">
	</div>
  </div>
  <div class="col-lg-6">
	<div class="input-group">
	  <div class="input-group-prepend">
		<span class="input-group-text"><i class="fas fa-calendar"></i></span>
	  </div>
	  <input id="tgl2" type="date" class="form-control">
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
function lap_periode() {
	console.log($("#tgl2").val());
	if($("#tgl1").val()!='' && $("#tgl2").val()!=''){
		openInNewTab('{{ asset('admin/report_day/r_report_day') }}?tgl1='+$("#tgl1").val()+'&tgl2='+$("#tgl2").val());
	}
}
function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}
</script>
