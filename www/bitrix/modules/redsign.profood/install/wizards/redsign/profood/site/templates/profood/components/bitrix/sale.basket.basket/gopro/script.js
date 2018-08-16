var RSGoPro_BasketTimeoutID = 0;

$(document).ready(function(){
	
	$(document).on('click', '.clearitems', function(){
		$('#basket_form_container .js-element .for-checkbox input').each(function(){
			if (!$(this).is(':checked')) {
				$('label[for="' + $(this).attr('name') + '"]').trigger('click');
			}
		});
		$(this).parents('form').find('.hiddensubmit').trigger('click');
		return false;
	});

	$(document).on('click','.clearsolo',function(){
		$(this).parents('form').find('.hiddensubmit').trigger('click');
		return false;
	});
	
	$(document).on('submit','#basket_form',function(){
		$('html').addClass('hidedefaultwaitwindow');
		RSGoPro_Area2Darken( $('#basket_form'), 'animashka' );
	});
	$(document).on('click','#basket_form a.delay, #basket_form a.delete, #basket_form a.add',function(){
		$('html').addClass('hidedefaultwaitwindow');
		RSGoPro_Area2Darken( $('#basket_form'), 'animashka' );
	});
	
	$(document).on('click','#basket_form .js-plus, #basket_form .js-minus',function(){
		var $link = $(this);
		clearTimeout(RSGoPro_BasketTimeoutID);
		RSGoPro_BasketTimeoutID = setTimeout(function(){
			$link.closest('form').find('.hiddensubmit').trigger('click');
		},1200);
	});

	$(document).on('blur','#basket_form .js-quantity',function(){
		var $input = $(this);
		RSGoPro_BasketTimeoutID = setTimeout(function(){
			$input.closest('form').find('.hiddensubmit').trigger('click');
		},1200);
	});
	
});
