function bigDataLoad(params) {
	var url = 'https://analytics.bitrix.info/crecoms/v1_0/recoms.php',
		data = BX.ajax.prepareData(params.bigData.params);

	if (data) {
		url += (url.indexOf('?') !== -1 ? '&' : '?') + data;
	}
	var onReady = function(result){
		// if (result && result.items) {
			sendRequest(params, {
				action: 'deferredLoad',
				bigData: 'Y',
				items: result && result.items || [],
				rid: result && result.id,
				count: params.bigData.params.count,
                shownIds: params.bigData.shownIds
			});
		// } else {
		// 	console.warn('recoms.php return nothin');
		// }
	};
	BX.ajax({
		method: 'GET',
		dataType: 'json',
		url: url,
		timeout: 3,
		onsuccess: onReady,
		onfailure: onReady
	});
}
function sendRequest(params, data) {
	var defaultData = {
		AJAX_CALL: 'Y',
		siteId: params.siteId,
		template: params.template,
		parameters: params.parameters
	};
	if (params.ajaxId)
	{
		defaultData.AJAX_ID = params.ajaxId;
	}
	BX.ajax({
		url: params.componentPath + '/ajax.php' + (document.location.href.indexOf('clear_cache=Y') !== -1 ? '?clear_cache=Y' : ''),
		method: 'POST',
		dataType: 'html',
		timeout: 60,
		data: BX.merge(defaultData, data),
		onsuccess: function(result){
			$('#ajaxpages_bigdata').html(result);

			setTimeout(function(){
				$('.js-bigdata').show();
				RSGoPro_SetSet();
			}, 150);
		}
	});
};
