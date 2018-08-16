<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;

return array(
	'code' => 'clothes/footer',
	'name' => Loc::getMessage('LANDING_DEMO_STORE_CLOTHES-FOOTER--NAME'),
	'description' => NULL,
	'type' => 'store',
	'version' => 2,
	'fields' =>
		array(
			'RULE' => NULL,
			'ADDITIONAL_FIELDS' =>
				array(
					'METAOG_IMAGE' => 'https://cdn.bitrix24.site/bitrix/images/demo/page/clothes/footer/preview.jpg',
					'VIEW_USE' => 'N',
					'VIEW_TYPE' => 'no',
				),
		),
	'layout' =>
		array(),
	'items' =>
		array(
			0 =>
				array(
					'code' => '35.2.footer_dark',
					'cards' =>
						array(
							'.landing-block-card-contact' => 2,
							'.landing-block-card-list1-item' => 3,
							'.landing-block-card-list2-item' => 3,
							'.landing-block-card-list3-item' => 2,
						),
					'nodes' =>
						array(
							'.landing-block-node-title' => array(
								0 => 'Магазин',
								1 => 'Каталог',
								2 => 'Покупка',
								3 => 'О нас',
							),
							'.landing-block-node-text' => array(
								0 => '<a href="#landing17" target="_self">Персональный раздел</a>',
							),
							'.landing-block-node-card-contact-icon' => array(
								0 => 'landing-block-node-card-contact-icon fa fa-home g-absolute-centered--y g-left-0',
								1 => 'landing-block-node-card-contact-icon fa fa-phone g-absolute-centered--y g-left-0',
							),
							'.landing-block-node-card-contact-text' => array(
								0 => 'Время работы: ПН-ВС 10-19',
								1 => '<span style="font-weight: bold;"><a href="tel:74952128506">8 (495) 212 85 06</a></span>',
							),
							'.landing-block-node-list-item' => array(
								3 => array(
									'text' => 'Как купить',
									'href' => '#landing@landing[clothes/faq]',
									'target' => '_self',
									'attrs' => array(
										'data-embed' => NULL,
										'data-url' => NULL,
									),
								),
								4 => array(
									'text' => 'Доставка',
									'href' => '#landing@landing[clothes/delivery]',
									'target' => '_self',
									'attrs' => array(
										'data-embed' => NULL,
										'data-url' => NULL,
									),
								),
								5 => array(
									'text' => 'Гарантия',
									'href' => '#landing@landing[clothes/guarantee]',
									'target' => '_self',
									'attrs' => array(
										'data-embed' => NULL,
										'data-url' => NULL,
									),
								),
								6 => array(
									'text' => 'О магазине',
									'href' => '#landing@landing[clothes/about]',
									'target' => '_self',
									'attrs' => array(
										'data-embed' => NULL,
										'data-url' => NULL,
									),
								),
								7 => array(
									'text' => 'Контакты',
									'href' => '#landing@landing[clothes/contacts]',
									'target' => '_self',
									'attrs' => array(
										'data-embed' => NULL,
										'data-url' => NULL,
									),
								),
							),
						),
					'style' =>
						array(
							'.landing-block-node-title' => array(
								0 => 'landing-block-node-title g-font-weight-700 g-mb-20 g-color-primary g-font-montserrat g-text-transform-none g-font-size-20',
							),
							'.landing-block-node-text' => array(
								0 => 'landing-block-node-text g-font-size-default g-color-gray-light-v1 g-mb-20 g-font-open-sans',
							),
							'.landing-block-node-list-item' => array(
								0 => 'landing-block-node-list-item g-color-gray-dark-v5 g-font-open-sans',
							),
							'.landing-block-node-card-contact-icon-container' => array(
								0 => 'landing-block-node-card-contact-icon-container g-color-gray-light-v1 g-absolute-centered--y g-left-0',
								1 => 'landing-block-node-card-contact-icon-container g-color-gray-light-v1 g-absolute-centered--y g-left-0',
							),
							'.landing-block-node-card-contact-icon' => array(
								0 => 'landing-block-node-card-contact-icon fa fa-home',
								1 => 'landing-block-node-card-contact-icon fa fa-phone',
							),
							'#wrapper' => array(
								0 => 'g-pt-60 g-bg-black g-pb-0',
							),
						),
					'attrs' =>
						array(),
				),
			1 =>
				array(
					'code' => '17.copyright',
					'cards' =>
						array(),
					'nodes' =>
						array(
							'.landing-block-node-text' => array(
								0 => '<p>© 2018 Интернет-магазин одежды.</p>',
							),
						),
					'style' =>
						array(
							'.landing-block-node-text' => array(
								0 => 'landing-block-node-text g-font-size-12 g-color-white js-animation animation-none g-font-open-sans',
							),
							'#wrapper' => array(
								0 => 'landing-block g-bg-black js-animation animation-none',
							),
						),
					'attrs' =>
						array(),
				),
		),
);