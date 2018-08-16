function rsGoProInitTab($tab) {
    var tabId = $tab.attr('id');

    if ($tab.data('ajax-load') == 'Y') {
        $(document).on('click', '#' + tabId + ' a', function(){
            var $tabSwitcher = $(this),
                $contentBlock = $($tabSwitcher.attr('href')).find('.js-tabs__put-content'),
                url = $tabSwitcher.data('tab-path') + '?fancybox=true&x-fancybox=y',
                data = {};

            if (!$tabSwitcher.hasClass('js-tab-loaded') && url != '') {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data
                }).done(function(response) {
                    $contentBlock.html(response);
                    $tabSwitcher.addClass('js-tab-loaded');
                }).fail(function(){
                    console.warn( 'tabs -> fail loading tab content' );
                }).always(function(){
                    setTimeout(function(){
                        RSGoPro_SetSet();
                    }, 150);
                });
            }

            return false;
        });
    }
}

function rsGoProInitTabs() {
    $('.js-tabs').each(function(){
        $tab = $(this);
        rsGoProInitTab($tab);
    });
}

$(document).on('rsGoPro.document.ready', function(){

    rsGoProInitTabs();
        
});
