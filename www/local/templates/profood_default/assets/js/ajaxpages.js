var RSGoPro_AJAXPAGES_processing = false;

function RSGoPro_AjaxPages(linkObj) {
	if (linkObj.parent().hasClass('animation')) {
		linkObj.parent().removeClass('animation');
	} else {
		linkObj.parent().addClass('animation');
	}
}

function RSGoPro_AJAXPAGESAuto() {
	$('.js-ajaxpages.auto').each(function(i){
		var porog = 200,
			$ajaxpObj = $(this),
			ajaxpOffsetTop = $ajaxpObj.offset().top,
			window_height = $(window).height();

		if (porog > (ajaxpOffsetTop - window.pageYOffset - window_height) && !RSGoPro_AJAXPAGES_processing && !$ajaxpObj.hasClass('')) {
			$ajaxpObj.find('.js-ajaxpages__link').trigger('click');
		}
	});
}

$(document).on('rsGoPro.document.ready', function(){

	$(window).on('scroll', function(){
		RSGoPro_AJAXPAGESAuto();
	});

	// AJAXPAGES
	$(document).on('click', '.js-ajaxpages__link', function(){
		var $linkObj = $(this),
			ajaxurl = $linkObj.data('ajaxurl'),
			ajaxpagesid = $linkObj.data('ajaxpagesid'),
			navpagenomer = $linkObj.data('navpagenomer'),
			navpagecount = $linkObj.data('navpagecount'),
			navnum = $linkObj.data('navnum'),
			nextpagenomer = parseInt(navpagenomer) + 1,
			url = '';

		if ($('#' + ajaxpagesid).length > 0 && navpagenomer < navpagecount && parseInt(navnum) > 0 && ajaxurl != '') {
			BX.onCustomEvent('rs.gopro.before.ajaxpages', [{ajaxpagesid: ajaxpagesid, pagenNum: navnum, nextPageNumber: nextpagenomer}]);
			RSGoPro_AJAXPAGES_processing = true;
			RSGoPro_AjaxPages($linkObj);
			if(ajaxurl.indexOf("?")<1) {
				url = ajaxurl + '?ajaxpages=Y&ajaxpagesid=' + ajaxpagesid + '&PAGEN_'+navnum+'='+nextpagenomer;
			} else {
				url = ajaxurl + '&ajaxpages=Y&ajaxpagesid=' + ajaxpagesid + '&PAGEN_'+navnum+'='+nextpagenomer;
			}
			$.getJSON(url, {}, function(json){
				RSGoPro_PutJSon(json, $linkObj, ajaxpagesid);
				BX.onCustomEvent('rs.gopro.after.ajaxpages', [{ajaxpagesid: ajaxpagesid, pagenNum: navnum, nextPageNumber: nextpagenomer}]);
			}).fail(function(json){
				console.warn( 'ajaxpages - error responsed' );
			}).always(function(){
				setTimeout(function(){ // fix for slow shit
					RSGoPro_AJAXPAGES_processing = false;
					RSGoPro_AjaxPages($linkObj);
				},50);
			});
		} else {
			if (!($('#'+ajaxpagesid).length > 0)) {
				console.warn( 'AJAXPAGES: ajaxpages -> empty DOM element' );
			}
			if (!(navpagenomer < navpagecount)) {
				console.warn( 'AJAXPAGES: ajaxpages -> navpagenomer !< navpagecount' );
			}
			if (!(parseInt(navnum) > 0)) {
				console.warn( 'AJAXPAGES: ajaxpages -> parseInt(navnum)!>0' );
			}
			if (!(ajaxurl != '')) {
				console.warn( 'AJAXPAGES: ajaxpages -> ajaxurl is empty' );
			}
		}
		return false;
	});
	// /AJAXPAGES

});
