<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;

return array(
	'code' => 'clothes/header',
	'name' => Loc::getMessage('LANDING_DEMO_STORE_CLOTHES-HEADER--NAME'),
	'description' => NULL,
	'type' => 'store',
	'version' => 2,
	'fields' =>
		array(
			'RULE' => NULL,
			'ADDITIONAL_FIELDS' => array(
				'METAOG_IMAGE' => 'https://cdn.bitrix24.site/bitrix/images/demo/page/clothes/header/preview.jpg',
				'VIEW_USE' => 'N',
				'VIEW_TYPE' => 'no',
			),
		),
	'layout' =>
		array(
			'code' => 'empty',
			'ref' => array(),
		),
	'items' =>
		array(
			0 => array(
				'code' => '35.5.header_with_search',
				'cards' => array(
					'.landing-block-node-card' => 2,
				),
				'nodes' => array(
					'.landing-block-node-logo' => array(
						0 =>
							array(
								'alt' => 'Logo',
								'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/eshop/logo.png',
							),
					),
					'.landing-block-node-menu-logo-link' => array(
						0 =>
							array(
								'text' => '
				<img class="landing-block-node-logo img-fluid g-max-width-180" src="https://cdn.bitrix24.site/bitrix/images/landing/business/eshop/logo.png" alt="Logo" data-fileid="6465" />
			',
								'href' => '#landing@landing[clothes/mainpage]',
								'target' => '_self',
								'attrs' =>
									array(
										'data-embed' => NULL,
										'data-url' => NULL,
									),
							),
					),
					'.landing-block-node-card-icon' => array(
						0 => 'landing-block-node-card-icon icon icon-screen-smartphone g-font-size-18',
						1 => 'landing-block-node-card-icon icon icon-clock g-font-size-18',
					),
					'.landing-block-node-card-title' => array(
						0 => 'Òåëåôîí',
						1 => 'Âğåìÿ ğàáîòû',
					),
					'.landing-block-node-card-text' => array(
						0 => '<a href="tel:+74952128506" target="_self">8 (495) 212 85 06</a>',
						1 => 'Ïí-Âñ: 10.00 - 19.00',
					),
				),
				'style' => array(
					'#wrapper' => array(
						0 => 'landing-block landing-block-menu g-bg-white g-brd-bottom g-brd-gray-light-v4 g-pt-0 g-pb-0 container',
					),
				),
				'attrs' => array(),
			),
			1 => array(
				'code' => '0.menu_21_wo_logo',
				'cards' => array(
					'.landing-block-node-menu-list-item' => 8,
				),
				'nodes' => array(
					'.landing-block-node-menu-list-item-link' => array(
						3 => array(
							'text' => 'Êàê êóïèòü',
							'href' => '#landing@landing[clothes/faq]',
							'target' => '_self',
							'attrs' => array(
								'data-embed' => NULL,
								'data-url' => NULL,
							),
						),
						4 => array(
							'text' => 'Äîñòàâêà',
							'href' => '#landing@landing[clothes/delivery]',
							'target' => '_self',
							'attrs' => array(
								'data-embed' => NULL,
								'data-url' => NULL,
							),
						),
						5 => array(
							'text' => 'Ãàğàíòèÿ',
							'href' => '#landing@landing[clothes/guarantee]',
							'target' => '_self',
							'attrs' => array(
								'data-embed' => NULL,
								'data-url' => NULL,
							),
						),
						6 => array(
							'text' => 'Î ìàãàçèíå',
							'href' => '#landing@landing[clothes/about]',
							'target' => '_self',
							'attrs' => array(
								'data-embed' => NULL,
								'data-url' => NULL,
							),
						),
						7 => array(
							'text' => 'Êîíòàêòû',
							'href' => '#landing@landing[clothes/contacts]',
							'target' => '_self',
							'attrs' => array(
								'data-embed' => NULL,
								'data-url' => NULL,
							),
						),
					),
				),
				'style' => array(
					'#wrapper' => array(
						0 => 'landing-block landing-block-menu landing-block-menu-store w-100 g-py-25 g-bg-white',
					),
					'.landing-block-node-menu-list-item-link' => array(
						0 => 'landing-block-node-menu-list-item-link nav-link p-0 g-color-black g-color-primary--hover',
					),
				),
				'attrs' => array(),
			),
			2 => array(
				'code' => 'store.breadcrumb_dark_bg_text_left',
				'cards' => array(),
				'nodes' => array(),
				'style' => array(),
				'attrs' => array(),
			),
		),
);