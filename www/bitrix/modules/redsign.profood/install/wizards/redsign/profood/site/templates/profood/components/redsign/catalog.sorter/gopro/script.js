function RSGoProSorterGo(ajaxpagesid, $link, isBigdata) {
	if ($link) {
		var catalogSelector = '#' + ajaxpagesid,
			url = $link.attr('href');
		
		RSGoPro_Area2Darken($(catalogSelector),'animashka');
		$link.parent().find('a').removeClass('selected');
		$link.addClass('selected');

		// dropdown
		if ($link.parents('.js-sorter__dropdown').find('.select').length > 0) {
			$link.parents('.js-sorter__dropdown').find('.select').html($link.html());
		}

		// shortsorter
		if ($link.parents('.js-sorter__shortsort').length > 0) {
			if (url == $link.data('url1')){
				$link.attr('href',$link.data('url2'));
			} else {
				$link.attr('href',$link.data('url1'));
			}
			if (BX.hasClass($link.find('.svg-icon').get(0), 'asc')) {
				BX.removeClass($link.find('.svg-icon').get(0), 'asc');
				BX.addClass($link.find('.svg-icon').get(0), 'desc');
			} else {
				BX.removeClass($link.find('.svg-icon').find('.svg-icon').get(0), 'desc');
				BX.addClass($link.find('.svg-icon').get(0), 'asc');
			}
		}
		
		if (isBigdata != 'Y' && url && url != '') {
			url+= '&AJAX_CALL=Y&sorterchange=' + ajaxpagesid;
			$.getJSON(url, {}, function(json) {
				RSGoPro_PutJSon(json,false,ajaxpagesid);
				setTimeout(function() {
					RSGoPro_SetSet();
				}, 150); // for slow shit
			}).fail(function(json) {
				console.warn( 'sorter - change template -> error responsed' );
			}).always(function() {
				RSGoPro_Area2Darken($(catalogSelector), 'animashka');
			});
		}
	}
}

$(document).ready(function(){
	
	// ajax sorter -> change (click link)
	$(document).on('click', '.js-sorter__a', function(){
		var $link = $(this),
			ajaxpagesid = $link.parents('.js-sorter').data('ajaxpagesid');

		if (ajaxpagesid && ajaxpagesid != '') {
			if ($link.parents('.js-bigdata').length > 0) { // big data
				RSGoProSorterGo(ajaxpagesid, $link, '', 'Y');
				var $jsBigdata = $link.parents('.js-bigdata');
				BX.ajax({
					url: $jsBigdata.data('url'),
					method: 'POST',
					data: {'parameters': $jsBigdata.data('parameters'), 'template': $jsBigdata.data('template'), 'rcm': 'yes', 'view': $link.data('fvalue')},
					dataType: 'html',
					processData: false,
					start: true,
					onsuccess: function (html) {
						var ob = BX.processHTML(html);
						// inject
						BX($jsBigdata.data('injectId')).innerHTML = ob.HTML;
						BX.ajax.processScripts(ob.SCRIPT);
						RSGoPro_SetSet();
					}
				});
			} else { // normal components
				RSGoProSorterGo(ajaxpagesid, $link, 'N');
				if ($link.parents('.js-sorter__dropdown').length > 0) {
					$link.parents('.js-sorter__dropdown').removeClass('hover');
				}
			}
		} else {
			console.warn('ajaxpagesid not detected');
		}

		return false;
	});
	
	$(document).on('mouseenter', '.js-sorter__dropdown',function(){
		$(this).addClass('hover');
		return false;
	}).on('mouseleave', '.js-sorter__dropdown',function(){
		$(this).removeClass('hover');
		return false;
	}).on('click', '.js-sorter__dropdown',function(){
		$(this).toggleClass('hover');
		return false;
	});
	
	$('.mix .js-sorter').addClass('used');
	
});
