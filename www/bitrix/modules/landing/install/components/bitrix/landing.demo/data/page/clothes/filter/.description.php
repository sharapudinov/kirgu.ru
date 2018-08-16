<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;

return array(
	'code' => 'clothes/filter',
	'name' => Loc::getMessage('LANDING_DEMO_STORE_CLOTHES-FILTER--NAME'),
	'description' => NULL,
	'type' => 'store',
	'version' => 2,
	'fields' => array(
		'RULE' => NULL,
		'ADDITIONAL_FIELDS' => array(
			'METAOG_IMAGE' => 'https://cdn.bitrix24.site/bitrix/images/demo/page/clothes/filter/preview.jpg',
			'VIEW_USE' => 'N',
			'VIEW_TYPE' => 'no',
			'THEME_CODE' => 'spa',
			'THEME_CODE_TYPO' => 'spa',
		),
	),
	'layout' => array(
		'code' => 'empty',
		'ref' => array(),
	),
	'items' => array(
		0 => array(
			'code' => 'store.catalog.filter',
			'cards' => array(),
			'nodes' => array(),
			'style' => array(),
			'attrs' => array(),
		),
		1 => array(
			'code' => '27.one_col_fix_title_and_text_2',
			'cards' => array(),
			'nodes' => array(
				'.landing-block-node-title' =>
					array(
						0 => '<span style="font-weight: bold;">Всегда на связи</span>',
					),
				'.landing-block-node-text' =>
					array(
						0 => '<p>Связаться с нами можно любым удобным для вас способом: e-mail, телефон, социальные сети и мессенджеры.</p>',
					),
			),
			'style' => array(
				'.landing-block-node-title' =>
					array(
						0 => 'landing-block-node-title g-font-weight-400 g-font-montserrat g-font-size-20',
					),
				'.landing-block-node-text' =>
					array(
						0 => 'landing-block-node-text g-pb-1 g-font-open-sans g-font-size-14',
					),
				'#wrapper' =>
					array(
						0 => 'landing-block js-animation fadeInUp g-pt-20 g-pb-20 animated g-pl-40 g-pr-40',
					),
			),
			'attrs' => array(),
		),
		2 => array(
			'code' => '14.2contacts_3_cols',
			'cards' => array(
				'.landing-block-card' => 3,
			),
			'nodes' => array(
				'.landing-block-node-contact-img' =>
					array(
						0 => 'landing-block-node-contact-img icon-call-in d-inline-block g-font-size-50 g-color-primary g-mb-20',
						1 => 'landing-block-node-contact-img icon-envelope d-inline-block g-font-size-50 g-color-primary g-mb-20',
						2 => 'landing-block-node-contact-img d-inline-block g-font-size-50 g-color-primary g-mb-20 fa fa-skype',
					),
				'.landing-block-node-contact-title' =>
					array(
						0 => '<span style="font-weight: bold;">Телефон</span>',
						1 => '<span style="font-weight: bold;">Email</span>',
						2 => '<span style="font-weight: bold;">Skype</span>',
					),
				'.landing-block-node-contact-text' =>
					array(
						0 => '<span style="font-weight: 700;"><a href="tel:74952128506">8 (495) 212 85 06</a></span>',
						1 => '<span style="font-weight: 700;"><a href="mailto:info@company24.com">info@company24.com</a></span>',
						2 => '<span style="font-weight: 700;"><a href="skype:shipping.example.ru">shipping.example.ru</a></span>',
					),
			),
			'style' => array(
				'.landing-block-card' =>
					array(
						0 => 'landing-block-card js-animation landing-block-node-contact g-brd-between-cols col-sm-4 g-brd-top g-brd-top-none--md g-brd-left--md g-brd-primary g-px-15 g-py-30 g-py-0--md animated landing-card fadeInUp col-lg-12',
					),
				'.landing-block-node-contact-title' =>
					array(
						0 => 'landing-block-node-contact-title g-font-size-default g-mb-5 g-font-open-sans g-color-gray-dark-v1 g-text-transform-none',
					),
				'.landing-block-node-contact-img' =>
					array(
						0 => 'landing-block-node-contact-img icon-call-in d-inline-block g-font-size-50 g-color-primary g-mb-20',
						1 => 'landing-block-node-contact-img icon-envelope d-inline-block g-font-size-50 g-color-primary g-mb-20',
						2 => 'landing-block-node-contact-img d-inline-block g-font-size-50 g-color-primary g-mb-20 fa fa-skype',
					),
				'.landing-block-node-contact-link' =>
					array(
						0 => 'landing-block-node-contact-link g-font-weight-700 g-color-primary g-font-open-sans',
					),
				'#wrapper' =>
					array(
						0 => 'landing-block g-bg-main landing-adjusted g-pl-40 g-pr-40 g-pb-0 g-pt-0',
					),
			),
			'attrs' => array(),
		),
		3 => array(
			'code' => '06.2.features_4_cols',
			'cards' => array(
				'.landing-block-card' => 1,
			),
			'nodes' => array(
				'.landing-block-node-element-icon' =>
					array(
						0 => 'landing-block-node-element-icon icon-fire',
					),
				'.landing-block-node-element-title' =>
					array(
						0 => '<span style="font-weight: bold;">Интересные ссылки</span>',
					),
				'.landing-block-node-element-text' =>
					array(
						0 => ' ',
					),
				'.landing-block-node-element-list' =>
					array(
						0 => '<li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10 g-text-transform-none g-font-open-sans g-font-size-14 text-left"><a href="#landing@landing[clothes/faq]" target="_self">Как купить</a></li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10 g-text-transform-none g-font-open-sans g-font-size-14 text-left"><a href="#landing@landing[clothes/delivery]" target="_self">Доставка</a></li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10 g-text-transform-none g-font-open-sans g-font-size-14 text-left"><a href="#landing@landing[clothes/about]" target="_self">О магазине</a></li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10 g-text-transform-none g-font-open-sans g-font-size-14 text-left"><a href="#landing@landing[clothes/quarantee]" target="_self">Гарантия</a></li>
                            <li class="landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10 g-text-transform-none g-font-open-sans g-font-size-14 text-left"><a href="#landing@landing[clothes/contacts]" target="_self">Контакты</a></li>',
					),
			),
			'style' => array(
				'.landing-block-node-element' =>
					array(
						0 => 'landing-block-node-element js-animation landing-block-card col-md-6 g-parent g-brd-around g-brd-gray-light-v4 g-brd-bottom-primary--hover g-brd-bottom-2--hover g-mb-30 g-mb-0--lg g-transition-0_2 g-transition--ease-in col-lg-12 animated landing-card fadeInUp',
					),
				'.landing-block-node-element-title' =>
					array(
						0 => 'landing-block-node-element-title h5 g-color-black g-mb-10 g-text-transform-none g-font-montserrat g-font-size-20',
					),
				'.landing-block-node-element-text' =>
					array(
						0 => 'landing-block-node-element-text g-color-gray-dark-v4',
					),
				'.landing-block-node-element-list-item' =>
					array(
						0 => 'landing-block-node-element-list-item g-brd-bottom g-brd-gray-light-v3 g-py-10 g-text-transform-none g-font-open-sans g-font-size-14 text-left',
					),
				'.landing-block-node-element-icon' =>
					array(
						0 => 'landing-block-node-element-icon icon-fire',
					),
				'.landing-block-node-separator' =>
					array(
						0 => 'landing-block-node-separator d-inline-block g-width-40 g-brd-bottom g-brd-2 g-brd-primary g-my-15',
					),
				'#wrapper' =>
					array(
						0 => 'landing-block landing-adjusted g-pt-50 g-pb-50 g-pl-20 g-pr-20',
					),
			),
			'attrs' => array(),
		),
	),
);