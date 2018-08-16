function rsGoProInitPersonalSection() {
    console.log("rsGoProInitPersonalSection");
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
}

$(document).on('rsGoPro.document.ready', function(){

    rsGoProInitPersonalSection();

});
