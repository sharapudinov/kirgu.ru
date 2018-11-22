function drawPlacemark(arShopsItem, rsPlacemark) {
    if ($('body').hasClass('js-off-yandex')) {
        arShopsItem.each(function() {
            if (!$(this).is(':visible')) {
                rsPlacemark[$(this).data('id')].setVisible(false);
            } else {
                rsPlacemark[$(this).data('id')].setVisible(true);
            }
        });
    } else {
        arShopsItem.each(function() {
            if (!$(this).is(':visible')) {
                rsPlacemark[$(this).data('id')].options.set('visible', false);
            } else {
                rsPlacemark[$(this).data('id')].options.set('visible', true);
            }
        });
    }
}

function rsGoproShops_initYandexMaps() {
    
    var arShopsItem = $('.js-shops_list').find('.js-item'),
        arMapCoord = [0, 0],
        rsPlacemark = {},
        rsYMapShops,
        classActive = 'active';

    arShopsItem.each(function() {
        var arCoords = $(this).data('coords').split(',');
        arMapCoord[0] = arMapCoord[0] + parseFloat(arCoords[0]);
        arMapCoord[1] = arMapCoord[1] + parseFloat(arCoords[1]);
    });

    arMapCoord[0] = arMapCoord[0] / arShopsItem.length;
    arMapCoord[1] = arMapCoord[1] / arShopsItem.length;

    var rsPlacemark = {},
        rsYMapShops;

    ymaps.ready(function() {
        rsYMapShops = new ymaps.Map('rsGoproShops2', {
            center: arMapCoord,
            zoom: 14,
            type: 'yandex#publicMap',
            behaviors: ['default', 'scrollZoom']
        });

        arShopsItem.each(function() {
            var arCoords = $(this).data('coords').split(','),
                id = $(this).data('id');
            arCoords[0] = parseFloat(arCoords[0]);
            arCoords[1] = parseFloat(arCoords[1]);
            rsPlacemark[id] = new ymaps.Placemark(
                arCoords, {
                    balloonContentHeader: $(this).find('.js-item__name').html(),
                    balloonContentBody: $(this).find('.js-item__descr').html()
                }
            );
            rsYMapShops.geoObjects.add(rsPlacemark[id]);
        });
        rsYMapShops.setBounds(rsYMapShops.geoObjects.getBounds(), {
            checkZoomRange: true
        });
        $('#rsGoproShops2').data('mapObj', rsYMapShops);
    });

    arShopsItem.on('mouseenter', function() {
        rsPlacemark[$(this).data('id')].options.set('preset', 'twirl#redDotIcon');
    }).on('mouseleave', function() {
        rsPlacemark[$(this).data('id')].options.set('preset', 'twirl#blueIcon');
    });

    return rsPlacemark;
}

function rsGoproShops_initGoogleMaps() {
    
    var arShopsItem = $('.js-shops_list').find('.js-item'),
        arMapCoord = [0, 0],
        rsPlacemark = {},
        rsYMapShops,
        classActive = "active";

    var pinImageDefault = new google.maps.MarkerImage('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|0b70ce',
        new google.maps.Size(21, 34),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34));
    var pinImageHover = new google.maps.MarkerImage('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|ed4443',
        new google.maps.Size(21, 34),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34));

    arShopsItem.each(function() {
        var arCoords = $(this).data('coords').split(',');
        arMapCoord[0] = arMapCoord[0] + parseFloat(arCoords[0]);
        arMapCoord[1] = arMapCoord[1] + parseFloat(arCoords[1]);
    });

    arMapCoord[0] = arMapCoord[0] / arShopsItem.length;
    arMapCoord[1] = arMapCoord[1] / arShopsItem.length;

    var rsPlacemark = {},
        map;

    map = new google.maps.Map(document.getElementById('rsGoproShops2'), {
        zoom: 10,
        center: {lat: arMapCoord[0], lng: arMapCoord[1]}
    });
    $('#rsGoproShops2').data('mapObj', map);

    arShopsItem.each(function(){
        var arCoords = $(this).data('coords').split(','),
            id = $(this).data('id');
        arCoords[0] = parseFloat(arCoords[0]);
        arCoords[1] = parseFloat(arCoords[1]);
        rsPlacemark[id] = new google.maps.Marker({
            position: {lat: arCoords[0], lng: arCoords[1]},
            title: $(this).find('.js-item__name').html(),
            icon: pinImageDefault,
            map: map
        });
    });

    arShopsItem.on('mouseenter', function() {
        rsPlacemark[$(this).data('id')].setIcon(pinImageHover);
    }).on('mouseleave', function(){
        rsPlacemark[$(this).data('id')].setIcon(pinImageDefault);
    });

    return rsPlacemark;
}

$(document).ready(function() {

    var arShopsItem = $('#lovekids_shops').find('.shop_item'),
        rsPlacemark = {},
        classActive = "active";

    if ($('body').hasClass('js-off-yandex')) {
		rsPlacemark = rsGoproShops_initGoogleMaps();
	} else {
		rsPlacemark = rsGoproShops_initYandexMaps();
    }

    // city search
    $(document).on('keyup', '.js-search_city input', function() {
        var $element = $(this),
            searchValue = $element.val(),
			filter = $(".js-filter .js-btn.active").data('filter'),
            $shops,
            $foundShops = $([]),
            $shop,
            shopName,
            shopDescr;

		$shops = filter ? $(".js-shops_list .js-item[data-type=" + filter + "]") : $(".js-shops_list .js-item");

        if (!searchValue || searchValue.trim() == '') {
            $foundShops = $shops;
            $(".js-clear-shops-input").removeClass('active');
        } else {

            $(".js-clear-shops-input").addClass('active');

            $.each($shops, function(index, item) {
                $shop = $(item);
                shopName = $shop.find(".js-item__name").text();
                shopDescr = $shop.find(".js-item__descr").text();

                if (
                    (shopName && shopName.toLowerCase().indexOf(searchValue.toLowerCase()) !== -1) ||
                    (shopDescr && shopDescr.toLowerCase().indexOf(searchValue.toLowerCase()) !== -1)
                ) {
                    $foundShops = $foundShops.add($shop);
                }
            });
        }


        $shops.addClass("hidden");
        if ($foundShops.length > 0) {
            $foundShops.removeClass('hidden');
			$(".js-not-found:visible").hide();
        } else {
			$(".js-not-found:hidden").show();
        }

        highlightFoundText($foundShops, searchValue);
    });

	$(document).on('click', ".js-shops_list .js-item", function() {
        var coords = $(this).data('coords'),
            map;

        if (!coords)
            return;

		coords = coords.split(',');
        coords = $.map(coords, function(coord) { return parseFloat(coord, 10); });
        map = $('#rsGoproShops2').data('mapObj');
        if ($('body').hasClass('js-off-yandex')) {
           map.setCenter({lat: coords[0], lng: coords[1]});
           map.setZoom(14);
        } else {
            map.setCenter(coords, 18);
        }
	});

    $(document).on('blur', '.js-search_city input', function() {
        var value = $(this).val();
        if (value.length < 1) {
            $('.js-shops_list').find('.js-item').show();
        } else {
            $('.js-search_city input').trigger('keyup');
        }
        drawPlacemark(arShopsItem, rsPlacemark);
    });


    // filter
    $(document).on('click', '.js-filter .js-btn', function() {
        $('.js-shops .js-filter').find('.js-btn').removeClass(classActive);
        $(this).addClass(classActive);

        var typeFilter = $(this).data('filter');
        if (typeFilter.length > 0) {
            $('.js-shops_list').find('.js-item').hide();
            $('.js-shops_list').find('.js-item[data-type="' + typeFilter + '"]').show();
        } else {
            $('.js-shops_list').find('.js-item').show();
        }

		$(".js-search_city input").trigger('keyup');
        drawPlacemark(arShopsItem, rsPlacemark);
    });

    $(document).on('click', ".js-clear-shops-input", function() {
        $(".js-search_city .shops-input").val('').keyup();
    });

    function highlightFoundText($shops, searchValue) {
        var highlightSubstring = function(substr, str) {return  str.replace(new RegExp('(' + substr + ')','gi'), '<span>$1</span>');}

        $shops.each(function(key, item) {
            var $shop = $(item);
            var shopName = $shop.find(".js-item__name").html();
            var shopDescr = $shop.find(".js-item__descr").html();

            shopName = shopName.replace(new RegExp('<span>(.*?)</span>', 'gi'), '$1');
            shopDescr = shopDescr.replace(new RegExp('<span>(.*?)</span>', 'gi'), '$1');

            if(!searchValue) {
                $shop.find(".js-item__name").html(shopName.replace(new RegExp('<span>(.*?)</span>', 'gi'), '$1'));
                $shop.find(".js-item__descr").html(shopDescr.replace(new RegExp('<span>(.*?)</span>', 'gi'), '$1'));
                return;
            }

            if(shopName) {
                shopName.replace(new RegExp('<span>(.*?)</span>', 'gi'), '$1');
                $shop.find(".js-item__name").html(highlightSubstring(searchValue, shopName));
            }


            if(shopDescr) {
                shopDescr.replace(new RegExp('<span>(.*?)</span>', 'gi'), '$1');
                $shop.find(".js-item__descr").html(highlightSubstring(searchValue, shopDescr));
            }
        });
    }
});
