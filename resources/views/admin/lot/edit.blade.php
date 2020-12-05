@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ asset('admin/lot/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="<?php echo $modelData->id ?>">
	<input type="hidden" name="created_by" value="2">
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Nama</label>
		<div class="col-sm-9">
			<input type="text" name="name" class="form-control" value="<?php echo $modelData->name ?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Alamat</label>
		<div class="col-sm-9">
			<textarea name="address" id="address"  class="form-control"><?php echo $modelData->address ?></textarea>						
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right"></label>
		<div class="col-sm-4">
			<div id="map" style="border:1px solid #0b0;height:450px;width:780px;"></div>
				<input id="pac-input" class="form-control" style="margin-top:12px;width:60%;" type="text" placeholder="Search Place" size="10">
			</div>
	</div>	
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Lat.</label>
		<div class="col-sm-4">
			<input type="text" name="lat" id="lat" class="form-control" value="<?php echo $modelData->lat ?>" required>
		</div>
	</div>	
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Lng.</label>
		<div class="col-sm-4">
			<input type="text" name="lng" id="lng" class="form-control" value="<?php echo $modelData->lng ?>" required>
		</div>
	</div>					
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Wilayah</label>					
		<div class="col-sm-6">
			<select name="territory" class="form-control" required>
				<option value=""></option>
				@foreach($modelTerritory as $territory)
				<option value="{{ $territory->id }}" @if($territory->id==$modelData->territory) selected @endif>{{ $territory->name }}</option>
				@endforeach
			</select>
		</div>	
	</div>
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Target Harian</label>
		<div class="col-sm-4">
			<input type="number" name="target_daily_profit" class="form-control" value="<?php echo $modelData->target_daily_profit ?>" required>
		</div>
	</div>	
	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Set Tampil Target</label>					
		<div class="col-sm-6">
			<select name="target_view" class="form-control" required>
				<option value=""></option>
				<option value="HARIAN" @if('HARIAN'==$modelData->target_view) selected @endif>HARIAN</option>
				<option value="BULANAN" @if('BULANAN'==$modelData->target_view) selected @endif>BULANAN</option>
			</select>
		</div>	
	</div>
    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary " value="Simpan">
                <a href="{{ asset('admin/lot') }}" class="btn btn-danger">Batal</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjbMgc2ARiMViRzHeI6W9pFzLfY8HVdT0&libraries=places&callback=initAutocomplete&hl=id" async defer></script>
<script>
	var marker;
	var map;
	var myLatLng;
	var mapDiv;
	var myPos;
	var latval;
	var lngval;

	function initAutocomplete()
	{
		var geocoder 	= new google.maps.Geocoder;
		var infowindow 	= new google.maps.InfoWindow;
		var zoomset		= 13;
		
		// Stayle map
		var styledMapType = new google.maps.StyledMapType(
		[
		{
			"featureType": "poi.business",
			"stylers": [
			{
				"visibility": "off"
			}
			]
		}
		],
		{name: 'Styled Map'});
		
		mapDiv = document.getElementById('map');
		latval = document.getElementById('lat').value;
		lngval = document.getElementById('lng').value;
		
		if (latval == "" && lngval == "") {
				myLatLng    = {lat: -7.79898677945525, lng: 110.39026800776367};
				myPos       = null;
			zoomset		= 13;
		} else {
				myLatLng    = {lat: Number(latval), lng: Number(lngval)};
				myPos       = {lat: Number(latval), lng: Number(lngval)};
			zoomset		= 17;
		};

		map = new google.maps.Map(mapDiv,
		{
				center: myLatLng,
				zoom: zoomset,
				mapTypeId: google.maps.MapTypeId.ROADMAP,

		});
		
		map.mapTypes.set('styled_map', styledMapType);
		map.setMapTypeId('styled_map');	
		
		var input = document.getElementById('pac-input');

		var searchBox = new google.maps.places.SearchBox(input);
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		input.style.display = 'block';

		//event if place changed
		searchBox.addListener('places_changed', function()
		{
			var places = searchBox.getPlaces();

			if (places.length == 0) {
				return;
			}

				marker.setMap(null);
				marker.setPosition(null);

				// For each place, get the icon, name and location.
				var bounds = new google.maps.LatLngBounds();
			places.forEach(function(place)
			{
					marker.setMap(map);
					marker.setTitle(place.name);

					if (place.geometry.viewport) {
					// Only geocodes have viewport.
					bounds.union(place.geometry.viewport);
					} else {
					bounds.extend(place.geometry.location);
					}
				});

				map.fitBounds(bounds);
				//map.setZoom();
		});

		// default marker
		marker = new google.maps.Marker({
				position	: myPos,
				map			: map,
				draggable	: true,
				animation	: google.maps.Animation.DROP,
				title		: 'Set Position'
		});

		// add map even listener click
		google.maps.event.addListener(map, 'click', function(event) {
				setMarker(event.latLng);
				var latitude    = event.latLng.lat();
				var longitude   = event.latLng.lng();
				setInput(latitude, longitude);
				
				geocodeLatLng(geocoder, map, infowindow, latitude, longitude, "#lokasi");
		});

		// add map even listener dragend marker
		google.maps.event.addListener(marker, 'dragend', function(event) {
				setMarker(event.latLng);
				var latitude    = event.latLng.lat();
				var longitude   = event.latLng.lng();
				setInput(latitude, longitude);

				geocodeLatLng(geocoder, map, infowindow, latitude, longitude, "#lokasi");
		});
	}

	function setMarker(location) {
		marker.setPosition(location);
	}

	function setInput(lat, lng) {
		var inlat 	= document.getElementById('lat');
		var inlng 	= document.getElementById('lng');
		
		inlat.value = lat;
		inlng.value = lng;
	}

	function geocodeLatLng(geocoder, map, infowindow, lat, lng, alamat) {
		var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
		geocoder.geocode({'location': latlng}, function(results, status) {
			if (status === 'OK') {
					if (results[0]) {
						$(alamat).val(results[0].formatted_address);
					} else {
						window.alert('No results found');
					}
			} else {
					window.alert('Geocoder failed due to: ' + status);
			}
		});
	}
	
</script>