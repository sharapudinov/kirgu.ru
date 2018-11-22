// apadtive menu
function adaptMenu() {
  var $menu = $('.main-menu-nav'),
    maxMenuWidth = $($menu).outerWidth(),
    $other = $menu.find('.other'),
    lastVisibleIndex = 0,
    otherMarginRight = 30,
    itemsWidth = $other.outerWidth() + otherMarginRight;

  if ($menu.length === 0) {
    return;
  }

  $menu.css('visibility', 'hidden').addClass('loaded');

  if ($(window).width <= 970) {
    $menu.find(".lvl1").removeClass('invisible');
    $other.addClass("invisible").find(".main").remove();
    return;
  }

  $menu.find(".lvl1").removeClass('invisible').each(function(index, item) {
    if (itemsWidth + $(item).outerWidth() <= maxMenuWidth) {
      itemsWidth += $(item).outerWidth();
      lastVisibleIndex++;
    } else {
      return false;
    }
  });

  $other.find(".other_li").remove();
  $menu.find(".lvl1:gt(" + --lastVisibleIndex + ")").addClass("invisible").each(function(index, item) {
    $other.find("ul.dropdown-menu").append(
      $("<li>")
      .addClass("other_li")
      .attr("id", "elementelement" + $(item).attr('id'))
      .html($(item).children("a").clone())
    );
  });

  if ($other.find(".other_li").length > 0) {
    $other.removeClass("invisible");
  } else {
    $other.addClass("invisible");
  }

  $menu.css('visibility', 'visible');
}

$(document).on('rsGoPro.document.ready', function(){

	adaptMenu();

  // click at first main menu
  $(document).on('show.bs.dropdown', '.main-menu-nav li.dropdown, .main-menu-nav li.dropdown > a', function(e) {
    console.warn('script.js -> preventDefault');
    e.preventDefault();
  });

	$(window).resize(BX.debounce(function() {
		adaptMenu();
	}, 100));

  $(document).on('click', '.main-menu-nav .dropdown a > span', function() {
    $(this).parent().parent().toggleClass('open');
    return false;
  });

});
