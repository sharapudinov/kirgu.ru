<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;

return array(
	'code' => 'clothes/delivery',
	'name' => Loc::getMessage('LANDING_DEMO_STORE_CLOTHES-DELIVERY--NAME'),
	'description' => NULL,
	'type' => 'store',
	'version' => 2,
	'fields' => array(
		'RULE' => NULL,
		'ADDITIONAL_FIELDS' => array(
			'METAOG_IMAGE' => 'https://cdn.bitrix24.site/bitrix/images/demo/page/clothes/delivery/preview.jpg',
			'VIEW_USE' => 'N',
			'VIEW_TYPE' => 'no',
		),
	),
	'layout' => array(
		'code' => 'header_footer',
		'ref' => array(
			1 => 'clothes/header',
			2 => 'clothes/footer',
		),
	),
	'items' => array(
		0 => array(
			'code' => '04.7.one_col_fix_with_title_and_text_2',
			'cards' => array(),
			'nodes' => array(
				'.landing-block-node-subtitle' => array(
					0 => ' ',
				),
				'.landing-block-node-title' => array(
					0 => 'Доставка',
				),
				'.landing-block-node-text' => array(
					0 => '<p>Интернет-магазин выполняет доставку любого товара своей собственной Службой доставки.</p>',
				),
			),
			'style' => array(
				'.landing-block-node-title' => array(
					0 => 'landing-block-node-title u-heading-v2__title g-line-height-1_1 g-font-weight-700 g-mb-minus-10 g-color-black g-font-size-40 g-font-montserrat g-text-transform-none',
				),
				'.landing-block-node-subtitle' => array(
					0 => 'landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-primary g-mb-15',
				),
				'.landing-block-node-text' => array(
					0 => 'landing-block-node-text g-pb-1 g-font-open-sans g-font-size-16 g-color-black-opacity-0_9',
				),
				'.landing-block-node-inner' => array(
					0 => 'landing-block-node-inner text-uppercase u-heading-v2-4--bottom g-brd-primary',
				),
				'#wrapper' => array(
					0 => 'landing-block js-animation animated g-pt-40 g-pb-10 g-bg-gray-light-v5 animation-none',
				),
			),
			'attrs' => array(),
		),
		1 => array(
			'code' => '34.4.two_cols_with_text_and_icons',
			'cards' => array(
				'.landing-block-node-card' => 2,
			),
			'nodes' => array(
				'.landing-block-node-card-icon' => array(
					0 => 'landing-block-node-card-icon icon-transport-021 u-line-icon-pro',
					1 => 'landing-block-node-card-icon icon-hotel-restaurant-112 u-line-icon-pro',
				),
				'.landing-block-node-card-text' => array(
					0 => '<p>Стоимость доставки товара из нашего магазина - 500 руб, <br />при условии выбора при заказе товара в качестве способа доставки нашим курьером.</p>',
					1 => '<p>Доставка осуществляется по адресу, указанному при оформлении заказа. Если необходимо доставить товар по иному адресу, необходимо сообщить адрес менеджеру Службы доставки, который свяжется с вами непосредственно после оформления заказа на сайте.</p>',
				),
				'.landing-block-node-card-title' => array(
					0 => 'Стоимость доставки курьером',
					1 => 'Место доставки',
				),
			),
			'style' => array(
				'.landing-block-node-card' => array(
					0 => 'landing-block-node-card js-animation fadeInUp col-md-6 col-lg-6 g-mb-40 animated landing-card',
				),
				'.landing-block-node-card-text' => array(
					0 => 'landing-block-node-card-text g-font-size-default g-color-gray-dark-v2 mb-0 g-font-open-sans g-font-size-14',
				),
				'.landing-block-node-card-title' => array(
					0 => 'landing-block-node-card-title h5 g-font-weight-800 g-font-size-22 g-text-transform-none g-font-open-sans',
				),
				'#wrapper' => array(
					0 => 'landing-block g-pt-20 g-bg-gray-light-v5 g-pb-10',
				),
			),
			'attrs' => array(),
		),
		2 => array(
			'code' => '04.4.one_col_big_with_img',
			'cards' => array(),
			'nodes' => array(
				'.landing-block-node-subtitle' => array(
					0 => ' ',
				),
				'.landing-block-node-title' => array(
					0 => 'Время доставки',
				),
				'.landing-block-node-mainimg' => array(
					0 =>
						array(
							'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/1920x1073/img1.jpg',
						),
				),
			),
			'style' => array(
				'.landing-block-node-subtitle' => array(
					0 => 'landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-white g-mb-20',
				),
				'.landing-block-node-title' => array(
					0 => 'landing-block-node-title u-heading-v2__title g-line-height-1_1 g-font-weight-700 g-color-white g-mb-minus-10 g-font-size-40 g-font-montserrat g-text-transform-none',
				),
				'.landing-block-node-inner' => array(
					0 => 'landing-block-node-inner text-uppercase text-center u-heading-v2-4--bottom g-brd-white',
				),
				'#wrapper' => array(
					0 => 'landing-block js-animation landing-block-node-mainimg u-bg-overlay g-bg-img-hero g-pt-40 g-pb-40 animated g-bg-black-opacity-0_6--after animation-none',
				),
			),
			'attrs' => array(),
		),
		3 => array(
			'code' => '31.3.two_cols_text_img_fix',
			'cards' => array(),
			'nodes' => array(
				'.landing-block-node-title' => array(
					0 => 'Когда возможна доставка?',
				),
				'.landing-block-node-text' => array(
					0 => '<p>Время доставки согласовывается с менеджером Службы доставки, который обязательно свяжется с вами сразу после того, как вы разместите свой заказ.<br /><br /><span style=""><span style="font-weight: bold;">Внимание!</span> Неправильно указанный номер телефона, неточный или неполный адрес могут привести к дополнительной задержке! Пожалуйста, внимательно проверяйте ваши персональные данные при регистрации и оформлении заказа.Конфиденциальность ваших регистрационных данных гарантируется.<br /><br /></span><span style="">Доставка выполняется ежедневно с 10:00 до 20:00 часов, в субботу с 10:00 до 14:00, в воскресенье доставки нет. Время осуществления доставки зависит от времени размещения заказа и наличия товара на складе:<br /></span><span style="font-style: italic;">- если заказ подтвержден менеджером Службы доставки до 12:00, товар может быть доставлен на следующий рабочий день между 10:00 и 15:00 или между 15:00 и 20:00;<br /></span><span style=""><span style="font-style: italic;">- если заказ подтвержден менеджером Службы доставки после 12:00, товар может быть доставлен на следующий рабочий день между 15:00 и 18:00.</span><br /></span></p>',
				),
				'.landing-block-node-img' => array(
					0 =>
						array(
							'alt' => 'Image description',
							'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/eshop/476x399/img1.jpg',
						),
				),
			),
			'style' => array(
				'.landing-block-node-text-container' => array(
					0 => 'landing-block-node-text-container js-animation slideInLeft col-md-6 g-pb-20 g-pb-0--md animated',
				),
				'.landing-block-node-title' => array(
					0 => 'landing-block-node-title g-font-weight-700 g-font-size-26 mb-0 g-mb-15 g-text-transform-none g-font-montserrat',
				),
				'.landing-block-node-text' => array(
					0 => 'landing-block-node-text g-font-open-sans g-font-size-14 g-color-black-opacity-0_9',
				),
				'.landing-block-node-img' => array(
					0 => 'landing-block-node-img js-animation slideInRight img-fluid animated',
				),
				'#wrapper' => array(
					0 => 'landing-block g-pt-60 g-pb-55',
				),
			),
			'attrs' => array(),
		),
		4 => array(
			'code' => '04.4.one_col_big_with_img',
			'cards' => array(),
			'nodes' => array(
				'.landing-block-node-subtitle' => array(
					0 => ' ',
				),
				'.landing-block-node-title' => array(
					0 => 'Правила',
				),
				'.landing-block-node-mainimg' => array(
					0 =>
						array(
							'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/1920x1073/img1.jpg',
						),
				),
			),
			'style' => array(
				'.landing-block-node-subtitle' => array(
					0 => 'landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-white g-mb-20',
				),
				'.landing-block-node-title' => array(
					0 => 'landing-block-node-title u-heading-v2__title g-line-height-1_1 g-font-weight-700 g-color-white g-mb-minus-10 g-font-size-40 g-text-transform-none g-font-montserrat',
				),
				'.landing-block-node-inner' => array(
					0 => 'landing-block-node-inner text-uppercase text-center u-heading-v2-4--bottom g-brd-white',
				),
				'#wrapper' => array(
					0 => 'landing-block js-animation landing-block-node-mainimg u-bg-overlay g-bg-img-hero g-pt-40 g-pb-40 animated g-bg-black-opacity-0_6--after animation-none',
				),
			),
			'attrs' => array(),
		),
		5 => array(
			'code' => '31.4.two_cols_img_text_fix',
			'cards' => array(),
			'nodes' => array(
				'.landing-block-node-title' => array(
					0 => 'Правила',
				),
				'.landing-block-node-text' => array(
					0 => '<p>При доставке вам будут переданы все необходимые документы на покупку: товарный, кассовый чеки, а также гарантийный талон.При оформлении покупки на организацию, вам будут переданы счет-фактура, а также накладная, в которой необходимо поставить печать вашей организации.<br /><br /><span style=""><span style="font-weight: bold;">Внимание!</span> Просим вас помнить, что все технические параметры и потребительские свойства приобретаемого товара вам следует уточнять у нашего менеджера до момента покупки товара. В обязанности работников Службы доставки не входит осуществление консультаций и комментариев относительно потребительских свойств товара. При необходимости инсталляции приобретаемого в нашем магазине товара вам необходимо сообщить об этом нашему менеджеру.При доставке вам заказанного товара проверяйте комплектность доставленного товара, работоспособность товара, соответствие доставленного товара описанию на нашем сайте, также проверьте товар на наличие механических повреждений. </span></p>',
				),
				'.landing-block-node-img' => array(
					0 =>
						array(
							'alt' => 'Image description',
							'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/eshop/476x399/img2.jpg',
						),
				),
			),
			'style' => array(
				'.landing-block-node-text-container' => array(
					0 => 'landing-block-node-text-container js-animation slideInRight col-md-6 animated',
				),
				'.landing-block-node-title' => array(
					0 => 'landing-block-node-title g-font-weight-700 g-font-size-26 mb-0 g-mb-15 g-text-transform-none g-font-montserrat',
				),
				'.landing-block-node-text' => array(
					0 => 'landing-block-node-text g-font-open-sans g-font-size-14 g-color-black-opacity-0_9',
				),
				'.landing-block-node-img' => array(
					0 => 'landing-block-node-img js-animation slideInLeft img-fluid animated',
				),
				'#wrapper' => array(
					0 => 'landing-block g-pt-50 g-pb-50',
				),
			),
			'attrs' => array(),
		),
		6 => array(
			'code' => '27.4.one_col_fix_text',
			'cards' => array(),
			'nodes' => array(
				'.landing-block-node-text' => array(
					0 => '<p>В случае вопросов, пожеланий и претензий обращайтесь к нам по следующим координатам:</p>',
				),
			),
			'style' => array(
				'.landing-block-node-text' => array(
					0 => 'landing-block-node-text g-pb-1 g-font-size-14 g-color-gray-dark-v3',
				),
				'#wrapper' => array(
					0 => 'landing-block js-animation animated g-pb-0 g-pt-20 fadeIn',
				),
			),
			'attrs' => array(),
		),
		7 => array(
			'code' => '14.2contacts_3_cols',
			'cards' => array(
				'.landing-block-card' => 3,
			),
			'nodes' => array(
				'.landing-block-node-contact-img' => array(
					0 => 'landing-block-node-contact-img icon-call-in d-inline-block g-font-size-50 g-color-primary g-mb-20',
					1 => 'landing-block-node-contact-img icon-envelope d-inline-block g-font-size-50 g-color-primary g-mb-20',
					2 => 'landing-block-node-contact-img d-inline-block g-font-size-50 g-color-primary g-mb-20 fa fa-skype',
				),
				'.landing-block-node-contact-title' => array(
					0 => '<span style="font-weight: bold;">Служба доставки</span>',
					1 => '<span style="font-weight: bold;">Email</span>',
					2 => '<span style="font-weight: bold;">Skype</span>',
				),
				'.landing-block-node-contact-text' => array(
					0 => '<span style="font-weight: 700;"><a href="tel:74952128506">8 (495) 212 85 06</a></span>',
					1 => '<span style="font-weight: 700;"><a href="mailto:info@company24.com">info@company24.com</a></span>',
					2 => '<span style="font-weight: 700;"><a href="skype:shipping.example.ru">shipping.example.ru</a></span>',
				),
			),
			'style' => array(
				'.landing-block-card' => array(
					0 => 'landing-block-card js-animation landing-block-node-contact g-brd-between-cols col-sm-4 g-brd-top g-brd-top-none--md g-brd-left--md g-brd-primary g-px-15 g-py-30 g-py-0--md animated landing-card fadeInUp',
				),
				'.landing-block-node-contact-title' => array(
					0 => 'landing-block-node-contact-title text-uppercase g-font-size-default g-mb-5 g-font-open-sans g-color-gray-dark-v1',
				),
				'.landing-block-node-contact-img' => array(
					0 => 'landing-block-node-contact-img icon-call-in d-inline-block g-font-size-50 g-color-primary g-mb-20',
					1 => 'landing-block-node-contact-img icon-envelope d-inline-block g-font-size-50 g-color-primary g-mb-20',
					2 => 'landing-block-node-contact-img d-inline-block g-font-size-50 g-color-primary g-mb-20 fa fa-skype',
				),
				'.landing-block-node-contact-link' => array(
					0 => 'landing-block-node-contact-link g-font-weight-700 g-color-primary g-font-open-sans',
				),
				'#wrapper' => array(
					0 => 'landing-block g-bg-main g-pt-0',
				),
			),
			'attrs' => array(),
		),
	),
);