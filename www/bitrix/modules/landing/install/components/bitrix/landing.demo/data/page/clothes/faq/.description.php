<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
   die();
}
use \Bitrix\Main\Localization\Loc;

return array (
  'code' => 'clothes/faq',
  'name' => Loc::getMessage('LANDING_DEMO_STORE_CLOTHES-FAQ--NAME'),
  'description' => NULL,
  'type' => 'store',
  'version' => 2,
  'fields' => 
  array (
    'RULE' => NULL,
    'ADDITIONAL_FIELDS' => 
    array (
		'METAOG_IMAGE' => 'https://cdn.bitrix24.site/bitrix/images/demo/page/clothes/faq/preview.jpg',
      'VIEW_USE' => 'N',
      'VIEW_TYPE' => 'no',
    ),
  ),
  'layout' => 
  array (
    'code' => 'header_footer',
    'ref' => 
    array (
      1 => 'clothes/header',
      2 => 'clothes/footer',
    ),
  ),
  'items' => 
  array (
    0 => 
    array (
      'code' => '04.7.one_col_fix_with_title_and_text_2',
      'cards' => 
      array (
      ),
      'nodes' => 
      array (
        '.landing-block-node-subtitle' => 
        array (
          0 => ' ',
        ),
        '.landing-block-node-title' => 
        array (
          0 => 'Как купить',
        ),
        '.landing-block-node-text' => 
        array (
          0 => '<p>Процедура покупки товара в нашем Интернет-магазине очень проста и состоит из нескольких шагов.</p>',
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-title' => 
        array (
          0 => 'landing-block-node-title u-heading-v2__title g-line-height-1_1 g-font-weight-700 g-mb-minus-10 g-color-black g-font-montserrat g-text-transform-none g-font-size-40',
        ),
        '.landing-block-node-subtitle' => 
        array (
          0 => 'landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-primary g-mb-15',
        ),
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-pb-1 g-font-open-sans g-font-size-16 g-color-black-opacity-0_9',
        ),
        '.landing-block-node-inner' => 
        array (
          0 => 'landing-block-node-inner text-uppercase u-heading-v2-4--bottom g-brd-primary',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block js-animation animated g-pb-10 g-bg-gray-light-v5 g-pt-40 animation-none',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    1 => 
    array (
      'code' => '31.3.two_cols_text_img_fix',
      'cards' => 
      array (
      ),
      'nodes' => 
      array (
        '.landing-block-node-title' => 
        array (
          0 => 'Оформление заказа',
        ),
        '.landing-block-node-text' => 
        array (
          0 => '<p>После выбора товара нажмите кнопку <span style="font-weight: bold;">В корзину</span> — товар добавится в вашу корзину.<br /><span style="">Далее, если вы закончили выбирать товар, нажмите кнопку <span style="font-weight: bold;">ваша корзина</span>.<br /><br /></span><span style="">На странице <span style="font-weight: bold;">ваша корзина</span> будут перечислены все выбранные вами товары.<br /></span><span style="">В поле <span style="font-weight: bold;">Количество</span> вы можете изменить количество товара для покупки. После изменения количества товара необходимо нажать кнопку <span style="font-weight: bold;">Пересчитать</span> для пересчета итоговой суммы заказа.<br /><br /></span><span style="">В колонке <span style="font-weight: bold;">Действия</span> над каждым товаром можно произвести следующие действия: либо <span style="font-weight: bold;">удалить</span> товар из корзины, либо <span style="font-weight: bold;">отложить</span> товар на будущее.<br /><br /></span><span style="">Также можно ввести код скидки в соответствующее поле.</span></p>',
        ),
        '.landing-block-node-img' => 
        array (
          0 => 
          array (
            'alt' => 'Image description',
			'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/eshop/600x408/img1.jpg',
          ),
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-text-container' => 
        array (
          0 => 'landing-block-node-text-container js-animation slideInLeft col-md-6 g-pb-20 g-pb-0--md animated',
        ),
        '.landing-block-node-title' => 
        array (
          0 => 'landing-block-node-title g-font-weight-700 mb-0 g-mb-15 g-text-transform-none g-font-size-30 g-font-montserrat',
        ),
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-font-open-sans g-font-size-14 g-color-black-opacity-0_9',
        ),
        '.landing-block-node-img' => 
        array (
          0 => 'landing-block-node-img js-animation slideInRight img-fluid animated',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block g-pt-50 g-pb-50',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    2 => 
    array (
      'code' => '31.4.two_cols_img_text_fix',
      'cards' => 
      array (
      ),
      'nodes' => 
      array (
        '.landing-block-node-title' => 
        array (
          0 => 'Подтверждение заказа',
        ),
        '.landing-block-node-text' => 
        array (
          0 => '<p>После ввода необходимой информации о доставке товара (ФИО получателя, адрес доставки, контактные данные, вариант доставки, способ оплаты и т.д) для оформления заказа вам нужно нажать кнопку Оформить заказ.<br /><span style="">Копия заказа будет выслана на ваш e-mail, указанный при оформлении заказа.<br /><br /></span><span style=""><span style="font-weight: bold;">Внимание!</span> Неправильно указанный номер телефона, неточный или неполный адрес могут привести к дополнительной задержке! Пожалуйста, внимательно проверяйте ваши персональные данные при регистрации и оформлении заказа.<br /><br /></span><span style="">Через некоторое время после оформления покупки, с вами свяжется наш менеджер по контактным данным, указанным при оформлении заказа. С менеджером можно будет согласовать точное время и сроки доставки, а также уточнить детали.</span><br /></p>',
        ),
        '.landing-block-node-img' => 
        array (
          0 => 
          array (
            'alt' => 'Image description',
			'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/eshop/600x412/img1.jpg',
          ),
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-text-container' => 
        array (
          0 => 'landing-block-node-text-container js-animation slideInRight col-md-6 animated',
        ),
        '.landing-block-node-title' => 
        array (
          0 => 'landing-block-node-title g-font-weight-700 mb-0 g-mb-15 g-text-transform-none g-font-montserrat g-font-size-30',
        ),
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-font-open-sans g-font-size-14 g-color-black-opacity-0_9',
        ),
        '.landing-block-node-img' => 
        array (
          0 => 'landing-block-node-img js-animation slideInLeft img-fluid animated',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block g-pt-50 g-pb-50',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    3 => 
    array (
      'code' => '31.3.two_cols_text_img_fix',
      'cards' => 
      array (
      ),
      'nodes' => 
      array (
        '.landing-block-node-title' => 
        array (
          0 => 'Оплата и цены',
        ),
        '.landing-block-node-text' => 
        array (
          0 => '<p>Цены, указанные на сайте, являются окончательными и не требуют доплат при стандартных условиях поставки. Все налоги включены в стоимость товара.<br /><br /><span style=""><span style="font-weight: bold;">Внимание!</span> Для каждого отдельного заказа возможен только один способ оплаты на ваш выбор. Оплата заказа по частям различными способами невозможна.<br /><br /></span><span style="">Возможные способы оплаты:<br /></span><span style=""><span style="font-style: italic; text-decoration-line: underline;">- Наличный расчет. </span><br /></span><span style="">Оплата производится наличными курьеру при доставке или в магазине при самовывозе. Вместе с товаром передается товарный и кассовый чеки, а также гарантийный талон.<br /></span><span style=""><span style="font-style: italic; text-decoration-line: underline;">- Оплата через Сбербанк.</span><br /></span><span style="">Вы можете оплатить заказ в любом отделении Сбербанка. За услугу по переводу денег с вас возьмут от 3 до 7% от стоимости заказа, в зависимости от региона. Перечисление денег займет порядка 10 дней.</span></p>',
        ),
        '.landing-block-node-img' => 
        array (
          0 => 
          array (
            'alt' => 'Image description',
			'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/eshop/600x468/img1.jpg',
          ),
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-text-container' => 
        array (
          0 => 'landing-block-node-text-container js-animation slideInLeft col-md-6 g-pb-20 g-pb-0--md animated',
        ),
        '.landing-block-node-title' => 
        array (
          0 => 'landing-block-node-title g-font-weight-700 mb-0 g-mb-15 g-font-montserrat g-text-transform-none g-font-size-30',
        ),
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-font-open-sans g-font-size-14 g-color-black-opacity-0_9',
        ),
        '.landing-block-node-img' => 
        array (
          0 => 'landing-block-node-img js-animation slideInRight img-fluid animated',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block g-pt-50 g-pb-50',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
  ),
);