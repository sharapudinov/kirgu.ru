/***********************************************************************/
/******************************* custom ********************************/
/***********************************************************************/
var RSGoPro_tamautID = 0,
	RSGoPro_timeoutDelay = 1200,
	RSGoPro_inputter,
	RSGoPro_modef_delay_hide = 4000,
	RSGoPro_modef_posFix = 0;
var RSGoPro_filtren,
	RSGoPro_offsetTopFilter = 0,
	RSGoPro_offsetTopFilterH = 0,
	RSGoPro_content,
	RSGoPro_offsetTopContent = 0,
	RSGoPro_offsetTopContentH = 0;

function RSGoPro_priceGoupClick() {
	if( $('.filtren').hasClass('ajaxfilter') ) {
		RSGoPro_FilterAjax();
	}
}

function RSGoPro_SeachProp($inputObj) {
	var value = $inputObj.val();
	var $lvl1 = $inputObj.parents('.lvl1');
	
	if(value.length<1) {
		$lvl1.find('.lvl2').css('display','block');
	} else {
		$lvl1.find('.lvl2').each(function(){
			var p_value = $(this).find('.val').html().substr(0,value.length);
			if( value.toLowerCase()==p_value.toLowerCase() ) {
				$(this).css('display','block');
			} else {
				$(this).css('display','none');
			}
		});
	}
	
	// reinitialize scroll
	if ($inputObj.parents('.lvl1').hasClass('scrolable')) {
		$inputObj.parents('.lvl1').find('.js-scroll').scrollbar();
	}
}

function RSGoPro_FilterSetPropHide() {
	// main
	if( $.cookie(BX_COOKIE_PREFIX+'RSGOPRO_SMARTFILTER_SHOW_ALL')=='Y' ) {
		$('.filtren').addClass('opened');
	}
}

function RSGoPro_FixedFilterWinScroll() {
	if (RSGoPro_filtren && RSGoPro_filtren.length > 0) {
		RSGoPro_offsetTopFilterH = RSGoPro_offsetTopFilter + RSGoPro_filtren.outerHeight(true);
		RSGoPro_offsetTopContentH = RSGoPro_content.offset().top + RSGoPro_content.outerHeight(true);
		RSGoPro_FlyHeaderH = $('#header-fly') && $('#header-fly').length > 0 ? $('#header-fly').outerHeight(true) : 0;
		if (window.pageYOffset + RSGoPro_FlyHeaderH > RSGoPro_offsetTopFilter) {
			RSGoPro_filtren.addClass('fixed');
		} else {
			RSGoPro_filtren.removeClass('fixed').css('top', 0 + 'px');
		}
		if (window.pageYOffset + RSGoPro_filtren.outerHeight(true) > RSGoPro_content.offset().top + RSGoPro_content.outerHeight(true)) {
			RSGoPro_filtren.addClass('stop').css('top', (RSGoPro_offsetTopContentH - RSGoPro_offsetTopFilterH) + 'px');
		} else {
			RSGoPro_filtren.removeClass('stop');
			if (!RSGoPro_filtren.hasClass('fixed')) {
				RSGoPro_filtren.removeClass('stop').css('top', 0 + 'px');
			} else {
				RSGoPro_filtren.removeClass('stop').css('top', 0 + RSGoPro_FlyHeaderH + 'px');
			}
		}
	}
}
function RSGoPro_FixedFilter() {
	if (RSGoPro_filtren && RSGoPro_filtren.length > 0) {
		RSGoPro_offsetTopFilter = RSGoPro_filtren.offset().top;
		RSGoPro_offsetTopFilterH = RSGoPro_offsetTopFilter + RSGoPro_filtren.outerHeight(true);
		RSGoPro_offsetTopContent = RSGoPro_content.offset().top;
		RSGoPro_offsetTopContentH = RSGoPro_offsetTopContent + RSGoPro_content.outerHeight(true);
		window.onscroll = RSGoPro_FixedFilterWinScroll;
	}
}

function RSGoPro_FilterAjax() {
	clearTimeout(RSGoPro_tamautID);
	RSGoPro_tamautID = setTimeout(function(){
		RSGoPro_Area2Darken( $('#catalog'), 'animashka' );
		var $formObj = $('form.smartfilter');
		var seriData = $formObj.serialize(),
			url = $formObj.attr('action');
		if(url.indexOf("?")<1) 		{
			url = url + '?' + seriData + '&AJAX_CALL=Y&get=catalog&set_filter=Y';
		} else {
			url = url + '&' + seriData + '&AJAX_CALL=Y&get=catalog&set_filter=Y';
		}
		BX.ajax({
			url				: url,
			method			: 'GET',
			dataType		: 'html',
			scriptsRunFirst	: false,
			emulateOnload	: false,
			start			: true,
			cache			: false,
			onsuccess: function(data){
				$('#catalog').html(data);
				$('.prices_jscrollpane').scrollbar();
				RSGoPro_Area2Darken( $('#catalog') );
				RSGoPro_FilterOnDocumentReady();
			},
			onfailure: function(){
				RSGoPro_Area2Darken( $('#catalog') );
				RSGoPro_FilterOnDocumentReady();
				console.warn( 'FILTER -> ajax load failed' );
			}
		});
	},RSGoPro_timeoutDelay);
}

function RSGoPro_FilterOnDocumentReady() {
	RSGoPro_FilterSetPropHide();
	
	// shiw/hide filter
	$(document).off('click', '.filtren .title a.shhi');
	$(document).on('click', '.filtren .title a.shhi', function(e){
		if($('.filtren').hasClass('opened')) { // was opened
			$.removeCookie(BX_COOKIE_PREFIX+'RSGOPRO_SMARTFILTER_SHOW_ALL');
			$('.filtren').removeClass('opened');
		} else { // was closed
			$.cookie(BX_COOKIE_PREFIX+'RSGOPRO_SMARTFILTER_SHOW_ALL','Y','/');
			$('.filtren').addClass('opened');
		}
		$('.js-scroll').scrollbar();
		RSGoPro_FixedFilterWinScroll();
		return false;
	});
	
	// shiw/hide property
	$(document).off('click', '.filtren .showchild');
	$(document).on('click', '.filtren .showchild', function() {
		console.log( 'filtren -> showchild' );
		var $lvl1 = $(this).parents('.lvl1');
		var propcode = $lvl1.data('propcode');
		if($lvl1.hasClass('closed')) { // was closed
			$lvl1.removeClass('closed');
		} else { // was opened
			$lvl1.addClass('closed');
		}
		$('.filtren').find('.js-scroll').scrollbar();
		RSGoPro_FixedFilterWinScroll();
		return false;
	});
	
	// disable click on disabled property
	$(document).off('click','.lvl2 .disabled input, .lvl2 .disabled label');
	$(document).on('click', '.lvl2 .disabled input, .lvl2 .disabled label', function(e){
		e.stopPropagation();
		return false;
	});
	
	// scrollbar
	$('.filtren').find('.js-scroll').scrollbar();
	$(window).resize(function(){
		$('.filtren').find('.js-scroll').scrollbar();
	});
	
	// search
	$(document).off('click','.f_search');
	$(document).on('keyup', '.f_search', function(){
		var $inputObj = $(this);
		RSGoPro_SeachProp($inputObj);
	});
	
	// modef link click
	$(document).off('click','#modef a');
	$(document).on('click','#modef a',function(){
		$("#set_filter").click();
		return false;
	});
	// fixed filter on scrolling
	if(!RSDevFunc_PHONETABLET)
	{
		RSGoPro_filtren = $('.filtren.filterfixed'),
		RSGoPro_offsetTopFilter = 0,
		RSGoPro_offsetTopFilterH = 0,
		RSGoPro_content = $('.content'),
		RSGoPro_offsetTopContent = 0,
		RSGoPro_offsetTopContentH = 0;
		
		RSGoPro_FixedFilter();
	}
	
	RSGoPro_SetSet();
}

/* bitrix */
function JCSmartFilter(ajaxURL, params)
{
	this.ajaxURL = ajaxURL;
	this.form = null;
	this.timer = null;
	this.cacheKey = '';
	this.cache = [];
	this.popups = [];
	if (params && params.SEF_SET_FILTER_URL)
	{
		this.bindUrlToButton('set_filter', params.SEF_SET_FILTER_URL);
		this.sef = true;
	}
	if (params && params.SEF_DEL_FILTER_URL)
	{
		this.bindUrlToButton('del_filter', params.SEF_DEL_FILTER_URL);
	}
}

JCSmartFilter.prototype.keyup = function(input)
{
	$(input).toggleClass('active');
	$(input).parents('div').toggleClass('active');
	if( $('.filtren').hasClass('ajaxfilter') ) {
		RSGoPro_FilterAjax();
	} else {
		if(this.timer)
			clearTimeout(this.timer);
		this.timer = setTimeout(BX.delegate(function(){
			this.reload(input);
		}, this), RSGoPro_timeoutDelay);
	}
}

JCSmartFilter.prototype.click = function(checkbox)
{
	if( $(checkbox).parents('.dropdown').length>0 ) {
		var val = $(checkbox).parents('.lvl2').find('.val').html();
		$(checkbox).parents('.dd').removeClass('open').find('.name.select').find('span').html( val );
		if( $(checkbox).parents('.dd').find('.pic.select').find('span').length>0 ) {
			if( $(checkbox).parents('.lvl2').find('.pic span').hasClass('nopic') ) {
				$(checkbox).parents('.dd').find('.pic.select').find('span').addClass('nopic').css( 'backgroundImage', '' );
			} else {
				var pic = $(checkbox).parents('.lvl2').find('.pic span').css('backgroundImage');
				$(checkbox).parents('.dd').find('.pic.select').find('span').removeClass('nopic').css( 'backgroundImage', pic );
			}
		}
	}
	if( $('.filtren').hasClass('ajaxfilter') )
	{
		RSGoPro_FilterAjax();
	} else {
		if(this.timer)
			clearTimeout(this.timer);
		this.timer = setTimeout(BX.delegate(function(){
			this.reload(checkbox);
		}, this), RSGoPro_timeoutDelay);
	}
}

JCSmartFilter.prototype.reload = function(input)
{
	// if(!RSDevFunc_PHONETABLET) {
		/* GoPro */
		RSGoPro_inputter = input;
		
		var lvl1 = BX.pos(BX.findParent(input, {'class':'property'}), true);
		RSGoPro_Area2Darken( $(input).closest('.filtren'), 'animashka', {'progressTop': lvl1.top + lvl1.height/2});
		
		var values = [];
		this.position = BX.pos(input, true);
		this.form = BX.findParent(input, {'tag':'form'});
		if(this.form) {
			values[0] = {name: 'ajax', value: 'y'};
			this.gatherInputsValues(values, BX.findChildren(this.form, {'tag': new RegExp('^(input|select)$', 'i')}, true));
			this.curFilterinput = input;
			BX.ajax.loadJSON(
				this.ajaxURL,
				this.values2post(values),
				BX.delegate(this.postHandler, this)
			);
		}
	// }
}

JCSmartFilter.prototype.updateItem = function (PID, arItem)
{
	if (arItem.PROPERTY_TYPE === 'N' || arItem.PRICE)
	{
		var trackBar = window['trackBar' + PID];
		if (!trackBar && arItem.ENCODED_ID)
			trackBar = window['trackBar' + arItem.ENCODED_ID];

		if (trackBar && arItem.VALUES)
		{
			if (arItem.VALUES.MIN)
			{
				if (arItem.VALUES.MIN.FILTERED_VALUE)
					trackBar.setMinFilteredValue(arItem.VALUES.MIN.FILTERED_VALUE);
				else
					trackBar.setMinFilteredValue(arItem.VALUES.MIN.VALUE);
			}

			if (arItem.VALUES.MAX)
			{
				if (arItem.VALUES.MAX.FILTERED_VALUE)
					trackBar.setMaxFilteredValue(arItem.VALUES.MAX.FILTERED_VALUE);
				else
					trackBar.setMaxFilteredValue(arItem.VALUES.MAX.VALUE);
			}
		}
	}
	else if (arItem.VALUES)
	{
		for (var i in arItem.VALUES)
		{
			if (arItem.VALUES.hasOwnProperty(i))
			{
				var value = arItem.VALUES[i];
				var control = BX(value.CONTROL_ID);
        
				if (!!control)
				{
					var label = document.querySelector('[data-role="label_'+value.CONTROL_ID+'"]');
					if (value.DISABLED)
					{
						if (label)
							BX.addClass(label, 'disabled');
						else
							BX.addClass(control.parentNode, 'disabled');
            /* custom */
            if ($(label).parents('div').length > 0) {
              $(label).parents('div').addClass('disabled');
            }
            /* /custom */
					}
					else
					{
						if (label)
							BX.removeClass(label, 'disabled');
						else
							BX.removeClass(control.parentNode, 'disabled');
            /* custom */
            if ($(label).parents('div').length > 0) {
              $(label).parents('div').removeClass('disabled');
            }
            /* /custom */
					}

					if (value.hasOwnProperty('ELEMENT_COUNT'))
					{
						label = document.querySelector('[data-role="count_'+value.CONTROL_ID+'"]');
						if (label)
							label.innerHTML = value.ELEMENT_COUNT;
					}
				}
			}
		}
	}
};

JCSmartFilter.prototype.postHandler = function (result)
{
	/* custom */ 
	clearInterval(RSGoPro_tamautID);
	RSGoPro_Area2Darken( $('.filtren') );
	/* /custom */
  
  var hrefFILTER, url, curProp;
	var modef = BX('modef');
	var modef_num = BX('modef_num');

	if (!!result && !!result.ITEMS)
	{
		for(var popupId in this.popups)
		{
			if (this.popups.hasOwnProperty(popupId))
			{
				this.popups[popupId].destroy();
			}
		}
		this.popups = [];

		for(var PID in result.ITEMS)
		{
			if (result.ITEMS.hasOwnProperty(PID))
			{
				this.updateItem(PID, result.ITEMS[PID]);
			}
		}

		if (!!modef && !!modef_num)
		{
			modef_num.innerHTML = result.ELEMENT_COUNT;
			hrefFILTER = BX.findChildren(modef, {tag: 'A'}, true);

			if (result.FILTER_URL && hrefFILTER)
			{
				hrefFILTER[0].href = BX.util.htmlspecialcharsback(result.FILTER_URL);
			}

			if (result.FILTER_AJAX_URL && result.COMPONENT_CONTAINER_ID)
			{
				BX.unbindAll(hrefFILTER[0]);
				BX.bind(hrefFILTER[0], 'click', function(e)
				{
					url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
					BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
					return BX.PreventDefault(e);
				});
			}
      
			if (result.INSTANT_RELOAD && result.COMPONENT_CONTAINER_ID)
			{
				url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
				BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
			}
			else
			{
				if (modef.style.display === 'none' && !RSDevFunc_PHONETABLET)
				{
					modef.style.display = 'inline-block';
				}
        
        /* custom */
				var NewPoStop = this.position.top;
				if($(RSGoPro_inputter).hasClass('min') || $(RSGoPro_inputter).hasClass('max')) {
					NewPoStop = NewPoStop + RSGoPro_modef_posFix + 1;
				} else if($(RSGoPro_inputter).parents('.js-scroll').length>0) {
					var id = $(RSGoPro_inputter).parents('.js-scroll').attr('id');
					if ($('#'+id).data('jsp')) {
						NewPoStop = NewPoStop + RSGoPro_modef_posFix + BX(id).offsetTop - $('#'+id).data('jsp').getContentPositionY();
					} else {
						NewPoStop = NewPoStop + RSGoPro_modef_posFix + BX(id).offsetTop;
					}
					if($(RSGoPro_inputter).parents('.cwpal').length>0) {
						NewPoStop = NewPoStop + RSGoPro_modef_posFix + 7;
					}
				} else if($(RSGoPro_inputter).parents('.dropdown').length>0) {
					var id = $(RSGoPro_inputter).parents('li.dropdown').attr('id');
					NewPoStop = NewPoStop + BX(id).offsetTop;
					if( $(RSGoPro_inputter).parents('.dd').hasClass('wpal') ) {
						NewPoStop = NewPoStop + 7;
					}
				} else if($(RSGoPro_inputter).parents('.cwpal').length>0) {
					NewPoStop = NewPoStop + RSGoPro_modef_posFix + 7;
				} else if($(RSGoPro_inputter).parents('.cwp').length>0) {
					NewPoStop = NewPoStop + RSGoPro_modef_posFix + 6;
				} else {
					NewPoStop = NewPoStop + RSGoPro_modef_posFix;
				}
				modef.style.top = NewPoStop + 'px';
				/* /custom */

				if (this.viewMode == "VERTICAL")
				{
					curProp = BX.findChild(BX.findParent(this.curFilterinput, {'class':'bx-filter-parameters-box'}), {'class':'bx-filter-container-modef'}, true, false);
					curProp.appendChild(modef);
				}

				if (result.SEF_SET_FILTER_URL)
				{
					this.bindUrlToButton('set_filter', result.SEF_SET_FILTER_URL);
				}
			}
		}
	}
};

JCSmartFilter.prototype.bindUrlToButton = function (buttonId, url)
{
	var button = BX(buttonId);
	if (button)
	{
		var proxy = function(j, func)
		{
			return function()
			{
				return func(j);
			}
		};

		if (button.type == 'submit')
			button.type = 'button';

		BX.unbindAll(button);
		BX.bind(button, 'click', proxy(url, function(url)
		{
			window.location.href = url;
			return false;
		}));
	}
};

JCSmartFilter.prototype.gatherInputsValues = function (values, elements)
{
	if(elements)
	{
		for(var i = 0; i < elements.length; i++)
		{
			var el = elements[i];
			if (el.disabled || !el.type)
				continue;

			switch(el.type.toLowerCase())
			{
				case 'text':
				case 'textarea':
				case 'password':
				case 'hidden':
				case 'select-one':
					if(el.value.length)
						values[values.length] = {name : el.name, value : el.value};
					break;
				case 'radio':
				case 'checkbox':
					if(el.checked)
						values[values.length] = {name : el.name, value : el.value};
					break;
				case 'select-multiple':
					for (var j = 0; j < el.options.length; j++)
					{
						if (el.options[j].selected)
							values[values.length] = {name : el.name, value : el.options[j].value};
					}
					break;
				default:
					break;
			}
		}
	}
};

JCSmartFilter.prototype.values2post = function (values)
{
	var post = new Array;
	var current = post;
	var i = 0;
	while(i < values.length)
	{
		var p = values[i].name.indexOf('[');
		if(p == -1)
		{
			current[values[i].name] = values[i].value;
			current = post;
			i++;
		}
		else
		{
			var name = values[i].name.substring(0, p);
			var rest = values[i].name.substring(p+1);
			if(!current[name])
				current[name] = new Array;

			var pp = rest.indexOf(']');
			if(pp == -1)
			{
				//Error - not balanced brackets
				current = post;
				i++;
			}
			else if(pp == 0)
			{
				//No index specified - so take the next integer
				current = current[name];
				values[i].name = '' + current.length;
			}
			else
			{
				//Now index name becomes and name and we go deeper into the array
				current = current[name];
				values[i].name = rest.substring(0, pp) + rest.substring(pp+1);
			}
		}
	}
	return post;
}

BX.namespace("BX.Iblock.SmartFilter");
BX.Iblock.SmartFilter = (function()
{
	var SmartFilter = function(arParams)
	{
		if (typeof arParams === 'object')
		{
			this.leftSlider = BX(arParams.leftSlider);
			this.rightSlider = BX(arParams.rightSlider);
			this.tracker = BX(arParams.tracker);
			this.trackerWrap = BX(arParams.trackerWrap);

			this.minInput = BX(arParams.minInputId);
			this.maxInput = BX(arParams.maxInputId);

			this.minPrice = parseFloat(arParams.minPrice);
			this.maxPrice = parseFloat(arParams.maxPrice);

			this.curMinPrice = parseFloat(arParams.curMinPrice);
			this.curMaxPrice = parseFloat(arParams.curMaxPrice);

			this.fltMinPrice = arParams.fltMinPrice ? parseFloat(arParams.fltMinPrice) : parseFloat(arParams.curMinPrice);
			this.fltMaxPrice = arParams.fltMaxPrice ? parseFloat(arParams.fltMaxPrice) : parseFloat(arParams.curMaxPrice);

			this.precision = arParams.precision || 0;

			this.priceDiff = this.maxPrice - this.minPrice;

			this.leftPercent = 0;
			this.rightPercent = 0;

			this.fltMinPercent = 0;
			this.fltMaxPercent = 0;

			this.colorUnavailableActive = BX(arParams.colorUnavailableActive);//gray
			this.colorAvailableActive = BX(arParams.colorAvailableActive);//blue
			this.colorAvailableInactive = BX(arParams.colorAvailableInactive);//light blue

			this.isTouch = false;

			this.init();

			if ('ontouchstart' in document.documentElement)
			{
				this.isTouch = true;

				BX.bind(this.leftSlider, "touchstart", BX.proxy(function(event){
					this.onMoveLeftSlider(event)
				}, this));

				BX.bind(this.rightSlider, "touchstart", BX.proxy(function(event){
					this.onMoveRightSlider(event)
				}, this));
			}
			else
			{
				BX.bind(this.leftSlider, "mousedown", BX.proxy(function(event){
					this.onMoveLeftSlider(event)
				}, this));

				BX.bind(this.rightSlider, "mousedown", BX.proxy(function(event){
					this.onMoveRightSlider(event)
				}, this));
			}

			BX.bind(this.minInput, "keyup", BX.proxy(function(event){
				this.onInputChange();
			}, this));

			BX.bind(this.maxInput, "keyup", BX.proxy(function(event){
				this.onInputChange();
			}, this));
		}
	};

	SmartFilter.prototype.init = function()
	{
		var priceDiff;

		if (this.curMinPrice > this.minPrice)
		{
			priceDiff = this.curMinPrice - this.minPrice;
			this.leftPercent = (priceDiff*100)/this.priceDiff;

			this.leftSlider.style.left = this.leftPercent + "%";
			this.colorUnavailableActive.style.left = this.leftPercent + "%";
		}

		this.setMinFilteredValue(this.fltMinPrice);

		if (this.curMaxPrice < this.maxPrice)
		{
			priceDiff = this.maxPrice - this.curMaxPrice;
			this.rightPercent = (priceDiff*100)/this.priceDiff;

			this.rightSlider.style.right = this.rightPercent + "%";
			this.colorUnavailableActive.style.right = this.rightPercent + "%";
		}

		this.setMaxFilteredValue(this.fltMaxPrice);
	};

	SmartFilter.prototype.setMinFilteredValue = function (fltMinPrice)
	{
		this.fltMinPrice = parseFloat(fltMinPrice);
		if (this.fltMinPrice >= this.minPrice)
		{
			var priceDiff = this.fltMinPrice - this.minPrice;
			this.fltMinPercent = (priceDiff*100)/this.priceDiff;

			if (this.leftPercent > this.fltMinPercent)
				this.colorAvailableActive.style.left = this.leftPercent + "%";
			else
				this.colorAvailableActive.style.left = this.fltMinPercent + "%";

			this.colorAvailableInactive.style.left = this.fltMinPercent + "%";
		}
		else
		{
			this.colorAvailableActive.style.left = "0%";
			this.colorAvailableInactive.style.left = "0%";
		}
	};

	SmartFilter.prototype.setMaxFilteredValue = function (fltMaxPrice)
	{
		this.fltMaxPrice = parseFloat(fltMaxPrice);
		if (this.fltMaxPrice <= this.maxPrice)
		{
			var priceDiff = this.maxPrice - this.fltMaxPrice;
			this.fltMaxPercent = (priceDiff*100)/this.priceDiff;

			if (this.rightPercent > this.fltMaxPercent)
				this.colorAvailableActive.style.right = this.rightPercent + "%";
			else
				this.colorAvailableActive.style.right = this.fltMaxPercent + "%";

			this.colorAvailableInactive.style.right = this.fltMaxPercent + "%";
		}
		else
		{
			this.colorAvailableActive.style.right = "0%";
			this.colorAvailableInactive.style.right = "0%";
		}
	};

	SmartFilter.prototype.getXCoord = function(elem)
	{
		var box = elem.getBoundingClientRect();
		var body = document.body;
		var docElem = document.documentElement;

		var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;
		var clientLeft = docElem.clientLeft || body.clientLeft || 0;
		var left = box.left + scrollLeft - clientLeft;

		return Math.round(left);
	};

	SmartFilter.prototype.getPageX = function(e)
	{
		e = e || window.event;
		var pageX = null;

		if (this.isTouch && event.targetTouches[0] != null)
		{
			pageX = e.targetTouches[0].pageX;
		}
		else if (e.pageX != null)
		{
			pageX = e.pageX;
		}
		else if (e.clientX != null)
		{
			var html = document.documentElement;
			var body = document.body;

			pageX = e.clientX + (html.scrollLeft || body && body.scrollLeft || 0);
			pageX -= html.clientLeft || 0;
		}

		return pageX;
	};

	SmartFilter.prototype.recountMinPrice = function()
	{
		var newMinPrice = (this.priceDiff*this.leftPercent)/100;
		newMinPrice = (this.minPrice + newMinPrice).toFixed(this.precision);

		if (newMinPrice != this.minPrice)
			this.minInput.value = newMinPrice;
		else
			this.minInput.value = "";
		smartFilter.keyup(this.minInput);
	};

	SmartFilter.prototype.recountMaxPrice = function()
	{
		var newMaxPrice = (this.priceDiff*this.rightPercent)/100;
		newMaxPrice = (this.maxPrice - newMaxPrice).toFixed(this.precision);

		if (newMaxPrice != this.maxPrice)
			this.maxInput.value = newMaxPrice;
		else
			this.maxInput.value = "";
		smartFilter.keyup(this.maxInput);
	};

	SmartFilter.prototype.onInputChange = function ()
	{
		var priceDiff;
		if (this.minInput.value)
		{
			var leftInputValue = this.minInput.value;
			if (leftInputValue < this.minPrice)
				leftInputValue = this.minPrice;

			if (leftInputValue > this.maxPrice)
				leftInputValue = this.maxPrice;

			priceDiff = leftInputValue - this.minPrice;
			this.leftPercent = (priceDiff*100)/this.priceDiff;

			this.makeLeftSliderMove(false);
		}

		if (this.maxInput.value)
		{
			var rightInputValue = this.maxInput.value;
			if (rightInputValue < this.minPrice)
				rightInputValue = this.minPrice;

			if (rightInputValue > this.maxPrice)
				rightInputValue = this.maxPrice;

			priceDiff = this.maxPrice - rightInputValue;
			this.rightPercent = (priceDiff*100)/this.priceDiff;

			this.makeRightSliderMove(false);
		}
	};

	SmartFilter.prototype.makeLeftSliderMove = function(recountPrice)
	{
		recountPrice = (recountPrice === false) ? false : true;

		this.leftSlider.style.left = this.leftPercent + "%";
		this.colorUnavailableActive.style.left = this.leftPercent + "%";

		var areBothSlidersMoving = false;
		if (this.leftPercent + this.rightPercent >= 100)
		{
			areBothSlidersMoving = true;
			this.rightPercent = 100 - this.leftPercent;
			this.rightSlider.style.right = this.rightPercent + "%";
			this.colorUnavailableActive.style.right = this.rightPercent + "%";
		}

		if (this.leftPercent >= this.fltMinPercent && this.leftPercent <= (100-this.fltMaxPercent))
		{
			this.colorAvailableActive.style.left = this.leftPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = 100 - this.leftPercent + "%";
			}
		}
		else if(this.leftPercent <= this.fltMinPercent)
		{
			this.colorAvailableActive.style.left = this.fltMinPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = 100 - this.fltMinPercent + "%";
			}
		}
		else if(this.leftPercent >= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.left = 100-this.fltMaxPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = this.fltMaxPercent + "%";
			}
		}

		if (recountPrice)
		{
			this.recountMinPrice();
			if (areBothSlidersMoving)
				this.recountMaxPrice();
		}
	};

	SmartFilter.prototype.countNewLeft = function(event)
	{
		pageX = this.getPageX(event);

		var trackerXCoord = this.getXCoord(this.trackerWrap);
		var rightEdge = this.trackerWrap.offsetWidth;

		var newLeft = pageX - trackerXCoord;

		if (newLeft < 0)
			newLeft = 0;
		else if (newLeft > rightEdge)
			newLeft = rightEdge;

		return newLeft;
	};

	SmartFilter.prototype.onMoveLeftSlider = function(e)
	{
		if (!this.isTouch)
		{
			this.leftSlider.ondragstart = function() {
				return false;
			};
		}

		if (!this.isTouch)
		{
			document.onmousemove = BX.proxy(function(event) {
				this.leftPercent = ((this.countNewLeft(event)*100)/this.trackerWrap.offsetWidth);
				this.makeLeftSliderMove();
			}, this);

			document.onmouseup = function() {
				document.onmousemove = document.onmouseup = null;
			};
		}
		else
		{
			document.ontouchmove = BX.proxy(function(event) {
				this.leftPercent = ((this.countNewLeft(event)*100)/this.trackerWrap.offsetWidth);
				this.makeLeftSliderMove();
			}, this);

			document.ontouchend = function() {
				document.ontouchmove = document.touchend = null;
			};
		}

		return false;
	};

	SmartFilter.prototype.makeRightSliderMove = function(recountPrice)
	{
		recountPrice = (recountPrice === false) ? false : true;

		this.rightSlider.style.right = this.rightPercent + "%";
		this.colorUnavailableActive.style.right = this.rightPercent + "%";

		var areBothSlidersMoving = false;
		if (this.leftPercent + this.rightPercent >= 100)
		{
			areBothSlidersMoving = true;
			this.leftPercent = 100 - this.rightPercent;
			this.leftSlider.style.left = this.leftPercent + "%";
			this.colorUnavailableActive.style.left = this.leftPercent + "%";
		}

		if ((100-this.rightPercent) >= this.fltMinPercent && this.rightPercent >= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.right = this.rightPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = 100 - this.rightPercent + "%";
			}
		}
		else if(this.rightPercent <= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.right = this.fltMaxPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = 100 - this.fltMaxPercent + "%";
			}
		}
		else if((100-this.rightPercent) <= this.fltMinPercent)
		{
			this.colorAvailableActive.style.right = 100-this.fltMinPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = this.fltMinPercent + "%";
			}
		}

		if (recountPrice)
		{
			this.recountMaxPrice();
			if (areBothSlidersMoving)
				this.recountMinPrice();
		}
	};

	SmartFilter.prototype.onMoveRightSlider = function(e)
	{
		if (!this.isTouch)
		{
			this.rightSlider.ondragstart = function() {
				return false;
			};
		}

		if (!this.isTouch)
		{
			document.onmousemove = BX.proxy(function(event) {
				this.rightPercent = 100-(((this.countNewLeft(event))*100)/(this.trackerWrap.offsetWidth));
				this.makeRightSliderMove();
			}, this);

			document.onmouseup = function() {
				document.onmousemove = document.onmouseup = null;
			};
		}
		else
		{
			document.ontouchmove = BX.proxy(function(event) {
				this.rightPercent = 100-(((this.countNewLeft(event))*100)/(this.trackerWrap.offsetWidth));
				this.makeRightSliderMove();
			}, this);

			document.ontouchend = function() {
				document.ontouchmove = document.ontouchend = null;
			};
		}

		return false;
	};

	return SmartFilter;
})();

/***********************************************************************/
/******************************* custom ********************************/
/***********************************************************************/
$(document).ready(function(){
	
	RSGoPro_FilterOnDocumentReady();

	$(document).on('click',function(e){
		if( $(e.target).parents('.dd.open').length>0 ) {
			
		} else {
			$('.filtren .dd').removeClass('open');
		}
	});

	$(document).off('click','.filtren label.select');
	$(document).on('click','.filtren label.select',function(){
		$(this).parents('.filtren').find('.dd.open').removeClass('open');
		$(this).parents('.dd').toggleClass('open');
	});
  
});
