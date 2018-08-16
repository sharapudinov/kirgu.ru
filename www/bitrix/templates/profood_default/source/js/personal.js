function rsGoProInitPersonalSection() {
    BX.onCustomEvent('rs.gopro.before.initPersonalSection');

    var $section = $('.sale-personal-section-index'),
        svgIcons = {
            orders:         '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-calculator"></use></svg>',
            account:        '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-wallet"></use></svg>',
            private:        '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-profil-1"></use></svg>',
            ordersFilter:   '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-history"></use></svg>',
            profiles:       '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-list"></use></svg>',
            cart:           '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-cart-1"></use></svg>',
            subscribe:      '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-envelope"></use></svg>',
            contacts:       '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-contacts"></use></svg>',
            favorite:       '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-favorite"></use></svg>',
            viewed:         '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-viewed"></use></svg>',
        },
        faIcons = {
            orders:         '.fa.fa-calculator',
            account:        '.fa.fa-credit-card',
            private:        '.fa.fa-user-secret',
            ordersFilter:   '.fa.fa-list-alt',
            profiles:       '.fa.fa-list-ol',
            cart:           '.fa.fa-shopping-cart',
            subscribe:      '.fa.fa-envelope',
            contacts:       '.fa.fa-info-circle',
            favorite:       '.fa.favorite',
            viewed:         '.fa.viewed',
        };

    if ($section.length > 0) {
        for (var key in faIcons) {
            if ($section.find(faIcons[key]).length > 0) {
                $section.find(faIcons[key]).replaceWith(svgIcons[key]);
            }
        }
    }

    BX.onCustomEvent('rs.gopro.after.initPersonalSection');
}

function rsGoProInitPersonalOrderList() {
    var $orders = $('.sale-order-list-container');

    if ($orders.length > 0) {
        BX.onCustomEvent('rs.gopro.before.initPersonalOrderList');

        // BX.onCustomEvent('rs.gopro.after.initPersonalOrderList');
    }
}
function rsGoProInitPersonalOrderDetail() {
    var $ordersDetail = $('.sale-order-detail');

    if ($ordersDetail.length > 0) {
        BX.onCustomEvent('rs.gopro.before.initPersonalOrderDetail');

        $ordersDetail.find('.sale-order-detail-order-item-td').removeAttr('style');

        BX.onCustomEvent('rs.gopro.after.initPersonalOrderDetail');
    }
}
function rsGoProInitPersonalOrderCancel() {
    var $cancel = $('.bx_my_order_cancel');

    if ($cancel.length > 0) {
        BX.onCustomEvent('rs.gopro.before.initPersonalOrderCancel');

        // BX.onCustomEvent('rs.gopro.after.initPersonalOrderCancel');
    }
}

function rsGoProInitPersonalAccount() {
    var $accountWallet = $('.sale-personal-account-wallet-container'),
        $accountTitle = $('.sale-personal-section-account-sub-header'),
        $accountContent = $('.bx-sap');

    if ($accountContent.length > 0) {
        BX.onCustomEvent('rs.gopro.before.initPersonalAccount');

        // BX.onCustomEvent('rs.gopro.after.initPersonalAccount');
    }
}

function rsGoProInitPersonalPrivate() {
    var $profile = $('.bx_profile');

    if ($profile.length > 0) {
        BX.onCustomEvent('rs.gopro.before.initPersonalPrivate');

        // BX.onCustomEvent('rs.gopro.after.initPersonalPrivate');
    }
}

function rsGoProInitPersonalProfilesList() {
    var $profiles = $('.sale-personal-profile-list-container');

    if ($profiles.length > 0) {
        BX.onCustomEvent('rs.gopro.before.initPersonalProfilesList');

        // BX.onCustomEvent('rs.gopro.after.initPersonalProfilesList');
    }
}
function rsGoProInitPersonalProfilesDetail() {
    var $profilesDetail = $('.bx_profile');

    if ($profilesDetail.length > 0) {
        BX.onCustomEvent('rs.gopro.before.initPersonalProfilesDetail');

        // BX.onCustomEvent('rs.gopro.after.initPersonalProfilesDetail');
    }
}

$(document).on('rsGoPro.document.ready', function(){

    rsGoProInitPersonalSection();

    rsGoProInitPersonalOrderList();
    rsGoProInitPersonalOrderDetail();
    rsGoProInitPersonalOrderCancel();

    rsGoProInitPersonalAccount();
    
    rsGoProInitPersonalPrivate();

    rsGoProInitPersonalProfilesList();
    rsGoProInitPersonalProfilesDetail();

});
