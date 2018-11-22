var RSGoPro_MenuTO = 0,
	RSGoPro_MenuElemHover = false;

$(document).ready(function(){

	$('.catalogmenu2').on('mouseenter',function(){
		$(this).addClass('hover');
	}).on('mouseleave',function(){
		$(this).removeClass('hover');
	});
	
	var timeoutHover = {};
	$('.catalogmenu2 a').on('click',function(e){
		var $link = $(this);
		if(!$link.hasClass('hover')){
			e.preventDefault();
			$link.addClass('hover');
		}
	}).on('mouseenter',function(){
		var $link = $(this);
		$link.parent().parent().find('a.hover').removeClass('hover');
		timeoutHover[$link.index()] = setTimeout(function(){
			$link.addClass('hover');
		},150);
	}).on('mouseleave',function(){
		var $link = $(this);
		clearTimeout(timeoutHover[$link.index()]);
		timeoutHover[$link.index()] = setTimeout(function(){
			$link.removeClass('hover');
		},2);
	});
	
	$('.catalogmenu2 li').on('mouseenter',function(){
		var $liObj = $(this);
		$liObj.parent().find('li.hover').removeClass('hover');
		setTimeout(function(){
			$liObj.addClass('hover');
		},2);
	}).on('mouseleave',function(){
		var $liObj = $(this);
		setTimeout(function(){
			if(!RSGoPro_MenuElemHover){
				$liObj.removeClass('hover')
			}
		},2);
	});
	
	$('.catalogmenu2 .elementinmenu').on('mouseenter',function(){
		RSGoPro_MenuElemHover = true;
	}).on('mouseleave',function(){
		RSGoPro_MenuElemHover = false;
	});
	
	if(RSDevFunc_PHONETABLET)
	{
		$('.catalogmenusmall a.parent').on('click',function(){
			if($(this).parent().find('ul').hasClass('noned'))
			{
				$(this).parent().find('ul').removeClass('noned');
				return false;
			}
		});
		$(document).on('click',function(){
			var $obj = $(this);
			if(!$('.catalogmenusmall ul.first').hasClass('noned'))
			{
				$('.catalogmenusmall ul.first').addClass('noned');
			}
		});
	} else {
		$('.catalogmenusmall li.parent').on('mouseenter',function(){
			$(this).find('ul').removeClass('noned');
		}).on('mouseleave',function(){
			$(this).find('ul').addClass('noned');
		});
	}
});
