$(document).ready(function() {

    $(document).on('click', '.js-rstuning__selectbox-open', function() {
        var $option = $(this),
            $select = $option.parents('.js-rstuning__selectbox__select');

        $select.toggleClass('open');

        return false;
    });

    $(document).on('click', '.rstuning__selectbox__option:not(.active)', function(e) {
        var $option = $(this),
            $select = $option.parents('.rstuning__selectbox__select'),
            el = e.target;

        // $select.parents('.js-rs_option_info').find('input').val($option.attr('value')).change();
        $select.parents('.js-rs_option_info').find('input').val($option.attr('value'));
        while ((el = el.parentElement) && !el.classList.contains('js-rs_option_info'));
        el.querySelector('input').value = $option.attr('value');
        el.querySelector('input').dispatchEvent(new Event('change'));
        $select.find('.rstuning__selectbox__option.active').removeClass('active');
        $option.addClass('active');

        return false;
    });

	$(document).on('click', function(e) {
        var $tuning = $('.js-rstuning');

		if ($tuning.hasClass('open')) {
			if ($(e.target).parents('.rstuning__selectbox__select.open').length > 0) {

			} else {
				$tuning.find('.rstuning__selectbox__select.open').removeClass('open');
			}
		}
	});

});
