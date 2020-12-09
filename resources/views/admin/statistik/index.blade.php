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
					<select class="form-control" required="" style="width: 100%" id="jenis" name="jenis" onchange="rubah(this.value)">
						<option value="hari">Harian</option>
						<option value="bulan">Bulanan</option>
						<option value="tahun" selected>Tahunan</option>
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
			<button type="button" class="btn btn-success btn-block rounded-0" onClick="proses()">
				<i class="fa fa-search"></i> Proses
			</button>
		</div>
		<div class="col-xl-12">
		&nbsp;
		</div>
		<div class="col-xl-12">
		  <div class="card shadow">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			  <h6 class="m-0 font-weight-bold text-primary">Grafik Statistik</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
			  <div class="chart-area">
				<canvas id="myAreaChart"></canvas>
			  </div>
			</div>
		  </div>
		</div>		
	</div>
</div>
<script src="{{ asset('public/admin/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('public/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
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
function proses() {
	var mode = document.getElementById('jenis').value;
	var date = document.getElementById('date').value;
	$.ajax({ 
		type: 'GET', 
		url: '{{ asset('admin/statistik/data?mode=') }}'+mode+'&date='+date, 
		dataType: 'json',
		success: function (data) { 
			var label_data = [];
			var nilai_data = [];
			$.each(data, function(index, element) {
				label_data.push(element.label);
				nilai_data.push(element.total);
			});
			var dataset1 = [{
							  label: "Total Transaksi",
							  lineTension: 0.3,
							  backgroundColor: "rgba(78, 115, 223, 0.05)",
							  borderColor: "rgba(78, 115, 223, 1)",
							  pointRadius: 3,
							  pointBackgroundColor: "rgba(78, 115, 223, 1)",
							  pointBorderColor: "rgba(78, 115, 223, 1)",
							  pointHoverRadius: 3,
							  pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
							  pointHoverBorderColor: "rgba(78, 115, 223, 1)",
							  pointHitRadius: 10,
							  pointBorderWidth: 2,
							  data: nilai_data,
							}]
			myLineChart.data.datasets = dataset1;
			myLineChart.data.labels = label_data;
			myLineChart.update()			
			//console.log(label)
		}
	});
	console.log(document.getElementById('jenis').value)
}

var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
	labels: null,
	datasets: null,
  },
  options: {
	maintainAspectRatio: false,
	scaleShowValues: true,
	layout: {
	  padding: {
		left: 10,
		right: 25,
		top: 25,
		bottom: 0
	  }
	},
	scales: {
	  xAxes: [{
		time: {
		  unit: 'date'
		},
		gridLines: {
		  display: false,
		  drawBorder: false
		},
		ticks: {
		  autoSkip: false
		}
	  }],
	  yAxes: [{
		ticks: {
		  maxTicksLimit: 5,
		  padding: 10,
		  // Include a dollar sign in the ticks
		  callback: function(value, index, values) {
			return 'Rp. ' + number_format(value);
		  }
		},
		gridLines: {
		  color: "rgb(234, 236, 244)",
		  zeroLineColor: "rgb(234, 236, 244)",
		  drawBorder: false,
		  borderDash: [2],
		  zeroLineBorderDash: [2]
		}
	  }],
	},
	legend: {
	  display: false
	},
	tooltips: {
	  backgroundColor: "rgb(255,255,255)",
	  bodyFontColor: "#858796",
	  titleMarginBottom: 10,
	  titleFontColor: '#6e707e',
	  titleFontSize: 14,
	  borderColor: '#dddfeb',
	  borderWidth: 1,
	  xPadding: 15,
	  yPadding: 15,
	  displayColors: false,
	  intersect: false,
	  mode: 'index',
	  caretPadding: 10,
	  callbacks: {
		label: function(tooltipItem, chart) {
		  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
		  return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
		}
	  }
	}
  }
});	
proses()
</script>