function rsGoproShops_initYandexMaps() {

	var arShopsItem = $('#lovekids_shops').find('.shop_item'),
		arShopsLink = arShopsItem.children('input');
		arMapCoord = [0, 0];

	arShopsLink.each(function(){
		var arCoords = $(this).data('coords').split(',');
		arMapCoord[0] = arMapCoord[0] + parseFloat(arCoords[0]);
		arMapCoord[1] = arMapCoord[1] + parseFloat(arCoords[1]);
	});

	arMapCoord[0] = arMapCoord[0] / arShopsLink.length;
	arMapCoord[1] = arMapCoord[1] / arShopsLink.length;

	var rsPlacemark = {},
		rsYMapShops;

	ymaps.ready(function(){
			rsYMapShops = new ymaps.Map('rsGoproShops', {
			center: arMapCoord,
			zoom: 16,
			type:'yandex#publicMap',
			behaviors: ['default', 'scrollZoom']
		});
		
		arShopsLink.each(function(){
			var arCoords = $(this).data('coords').split(','),
				id = $(this).attr('id');
			arCoords[0] = parseFloat(arCoords[0]);
			arCoords[1] = parseFloat(arCoords[1]);
			rsPlacemark[id] = new ymaps.Placemark(
				arCoords, {
					balloonContentHeader: $(this).next().text(),
					balloonContentBody: $(this).siblings('.descr').html()
				}
			);
			rsYMapShops.geoObjects.add(rsPlacemark[id]);
			
		});
		rsYMapShops.setBounds(rsYMapShops.geoObjects.getBounds(), {checkZoomRange: true}).controls.add('mapTools').add('zoomControl').add('typeSelector');
	});

	arShopsLink.on('change', function(){
		var arShopsChecked = arShopsLink.filter(':checked');
		if (arShopsChecked.length == 0) {
			for (var id in rsPlacemark) {
				rsPlacemark[id].options.set('visible', true);
			}
		} else {
			arShopsLink.each(function(){
				if ($(this).is(':checked')) {
					rsPlacemark[$(this).attr('id')].options.set('visible', true);
				} else {
					rsPlacemark[$(this).attr('id')].options.set('visible', false);
				}
			});
		}
	});

	arShopsItem.children('label').on('mouseenter', function(){
		rsPlacemark[$(this).attr('for')].options.set('preset', 'twirl#redDotIcon');
	}).on('mouseleave', function(){
		rsPlacemark[$(this).attr('for')].options.set('preset', 'twirl#blueIcon');
	});
}

function rsGoproShops_initGoogleMaps() {
	
	var arShopsItem = $('#lovekids_shops').find('.shop_item'),
		arShopsLink = arShopsItem.children('input');
		arMapCoord = [0, 0],
		arGoogleCoord = {lat: 0, lng: 0};

	var pinImageDefault = new google.maps.MarkerImage('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|0b70ce',
		new google.maps.Size(21, 34),
		new google.maps.Point(0,0),
		new google.maps.Point(10, 34));
	var pinImageHover = new google.maps.MarkerImage('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|ed4443',
		new google.maps.Size(21, 34),
		new google.maps.Point(0,0),
		new google.maps.Point(10, 34));

	arShopsLink.each(function(){
		var arCoords = $(this).data('coords').split(',');
		arMapCoord[0] = arMapCoord[0] + parseFloat(arCoords[0]);
		arMapCoord[1] = arMapCoord[1] + parseFloat(arCoords[1]);
	});

	arMapCoord[0] = arMapCoord[0] / arShopsLink.length;
	arMapCoord[1] = arMapCoord[1] / arShopsLink.length;

	var rsPlacemark = {},
		map;

	map = new google.maps.Map(document.getElementById('rsGoproShops'), {
		zoom: 10,
		center: {lat: arMapCoord[0], lng: arMapCoord[1]}
	});

	arShopsLink.each(function(){
		var arCoords = $(this).data('coords').split(','),
			id = $(this).attr('id');
		arCoords[0] = parseFloat(arCoords[0]);
		arCoords[1] = parseFloat(arCoords[1]);
		rsPlacemark[id] = new google.maps.Marker({
			position: {lat: arCoords[0], lng: arCoords[1]},
			title: $(this).next().text(),
			icon: pinImageDefault,
			map: map
		});
	});

	arShopsLink.on('change', function(){
		var arShopsChecked = arShopsLink.filter(':checked');
		if (arShopsChecked.length == 0) {
			for (var id in rsPlacemark) {
				rsPlacemark[id].setVisible(true);
			}
		} else {
			arShopsLink.each(function(){
				if ($(this).is(':checked')) {
					rsPlacemark[$(this).attr('id')].setVisible(true);
				} else {
					rsPlacemark[$(this).attr('id')].setVisible(false);
				}
			});
		}
	});

	arShopsItem.children('label').on('mouseenter', function(){
		rsPlacemark[$(this).attr('for')].setIcon(pinImageHover);
	}).on('mouseleave', function(){
		rsPlacemark[$(this).attr('for')].setIcon(pinImageDefault);
	});
}

$(document).ready(function(){

	if ($('body').hasClass('js-off-yandex')) {
		rsGoproShops_initGoogleMaps();
	} else {
		rsGoproShops_initYandexMaps();
	}

});
