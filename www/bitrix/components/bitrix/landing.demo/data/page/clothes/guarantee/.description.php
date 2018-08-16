<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
   die();
}
use \Bitrix\Main\Localization\Loc;

return array (
  'code' => 'clothes/guarantee',
  'name' => Loc::getMessage('LANDING_DEMO_STORE_CLOTHES-GUARANTEE--NAME'),
  'description' => NULL,
  'type' => 'store',
  'version' => 2,
  'fields' => 
  array (
    'RULE' => NULL,
    'ADDITIONAL_FIELDS' => 
    array (
		'METAOG_IMAGE' => 'https://cdn.bitrix24.site/bitrix/images/demo/page/clothes/guarantee/preview.jpg',
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
          0 => 'Гарантия',
        ),
        '.landing-block-node-text' => 
        array (
          0 => '<p>Одной из важных составляющих работы нашего интернет-магазина является то, что продаваемые товары сертифицированы и обеспечены фирменной гарантией фирм-производителей.</p>',
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
          0 => 'landing-block-node-text g-pb-1 g-color-gray-dark-v3 g-font-size-16 g-font-open-sans',
        ),
        '.landing-block-node-inner' => 
        array (
          0 => 'landing-block-node-inner text-uppercase u-heading-v2-4--bottom g-brd-primary',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block js-animation animated g-bg-gray-light-v5 fadeIn g-pt-60 g-pb-30',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    1 => 
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
          0 => 'Для осуществления гарантийного обслуживания необходимы:',
        ),
        '.landing-block-node-text' => 
        array (
          0 => ' ',
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-title' => 
        array (
          0 => 'landing-block-node-title u-heading-v2__title g-line-height-1_1 g-font-weight-700 g-color-black g-mb-minus-10 g-text-transform-none g-font-montserrat g-font-size-30',
        ),
        '.landing-block-node-subtitle' => 
        array (
          0 => 'landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-primary g-mb-15',
        ),
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-color-gray-dark-v5 g-pb-1',
        ),
        '.landing-block-node-inner' => 
        array (
          0 => 'landing-block-node-inner text-uppercase u-heading-v2-4--bottom g-brd-primary',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block js-animation fadeInUp g-pt-20 g-pb-20 animated g-bg-main',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    2 => 
    array (
      'code' => '34.4.two_cols_with_text_and_icons',
      'cards' => 
      array (
        '.landing-block-node-card' => 1,
      ),
      'nodes' => 
      array (
        '.landing-block-node-card-icon' => 
        array (
          0 => 'landing-block-node-card-icon icon-check',
        ),
        '.landing-block-node-card-text' => 
        array (
          0 => '<p>Правильно и без помарок и исправлений заполненный гарантийный талон, в котором должны быть указаны ё<br />модель и серийный номер изделия, <br />дата продажи и печать торгующей организации.</p>',
        ),
        '.landing-block-node-card-title' => 
        array (
          0 => ' ',
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-card' => 
        array (
          0 => 'landing-block-node-card js-animation fadeInUp col-md-6 g-mb-40 animated landing-card col-lg-12',
        ),
        '.landing-block-node-card-text' => 
        array (
          0 => 'landing-block-node-card-text g-font-size-default g-color-gray-dark-v2 mb-0 g-font-size-16 g-font-open-sans',
        ),
        '.landing-block-node-card-title' => 
        array (
          0 => 'landing-block-node-card-title h5 text-uppercase g-font-weight-800',
        ),
        '.landing-block-node-card-icon' => 
        array (
          0 => 'landing-block-node-card-icon icon-check',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block g-pt-0 g-pb-0',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    3 => 
    array (
      'code' => '34.4.two_cols_with_text_and_icons',
      'cards' => 
      array (
        '.landing-block-node-card' => 2,
      ),
      'nodes' => 
      array (
        '.landing-block-node-card-icon' => 
        array (
          0 => 'landing-block-node-card-icon icon-check',
          1 => 'landing-block-node-card-icon icon-check',
        ),
        '.landing-block-node-card-text' => 
        array (
          0 => '<p>Документ, <br />подтверждающий покупку <br />(товарная накладная).</p>',
          1 => '<p>Полная <br />комплектация <br />товара.</p>',
        ),
        '.landing-block-node-card-title' => 
        array (
          0 => ' ',
          1 => ' ',
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-card' => 
        array (
          0 => 'landing-block-node-card js-animation fadeInUp col-md-6 g-mb-40 animated landing-card col-lg-6',
        ),
        '.landing-block-node-card-text' => 
        array (
          0 => 'landing-block-node-card-text g-font-size-default g-color-gray-dark-v2 mb-0 g-font-size-16 g-font-open-sans',
        ),
        '.landing-block-node-card-title' => 
        array (
          0 => 'landing-block-node-card-title h5 text-uppercase g-font-weight-800',
        ),
        '#wrapper' =>
        array (
          0 => 'landing-block g-pt-0 g-pb-0',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    4 => 
    array (
      'code' => '27.4.one_col_fix_text',
      'cards' => 
      array (
      ),
      'nodes' => 
      array (
        '.landing-block-node-text' => 
        array (
          0 => '<p>Обращаем также ваше внимание на то, что при получении и оплате заказа покупатель в присутствии курьера обязан проверить комплектацию и внешний вид изделия на предмет отсутствия физических дефектов (царапин, трещин, сколов и т.п.) и полноту комплектации. После отъезда курьера претензии по этим вопросам не принимаются.</p>',
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-pb-1 g-font-open-sans g-color-gray-dark-v4 g-font-size-14',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block js-animation fadeInUp animated g-pt-0 g-pb-30',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    5 => 
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
          0 => 'Гарантийное обслуживание <br />не производится, если:',
        ),
        '.landing-block-node-text' => 
        array (
          0 => ' ',
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-title' => 
        array (
          0 => 'landing-block-node-title u-heading-v2__title g-line-height-1_1 g-font-weight-700 g-color-black g-mb-minus-10 g-text-transform-none g-font-montserrat g-font-size-30',
        ),
        '.landing-block-node-subtitle' => 
        array (
          0 => 'landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-primary g-mb-15',
        ),
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-color-gray-dark-v5 g-pb-1',
        ),
        '.landing-block-node-inner' => 
        array (
          0 => 'landing-block-node-inner text-uppercase u-heading-v2-4--bottom g-brd-primary',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block js-animation fadeInUp g-bg-gray-light-v5 g-pt-20 g-pb-20 animated',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    6 => 
    array (
      'code' => '34.4.two_cols_with_text_and_icons',
      'cards' => 
      array (
        '.landing-block-node-card' => 7,
      ),
      'nodes' => 
      array (
        '.landing-block-node-card-icon' => 
        array (
          0 => 'landing-block-node-card-icon icon-close',
          1 => 'landing-block-node-card-icon icon-close',
          2 => 'landing-block-node-card-icon icon-close',
          3 => 'landing-block-node-card-icon icon-close',
          4 => 'landing-block-node-card-icon icon-close',
          5 => 'landing-block-node-card-icon icon-close',
          6 => 'landing-block-node-card-icon icon-close',
        ),
        '.landing-block-node-card-text' => 
        array (
          0 => '<p>Утерян <br />или не заполнен <br />гарантийный талон</p>',
          1 => '<p>Оборудование было поставлено <br />на территорию РФ <br />неофициально</p>',
          2 => '<p>Изделие имеет следы <br />механического повреждения <br />или вскрытия</p>',
          3 => '<p>Нарушены <br />заводские <br />пломбы</p>',
          4 => '<p>Были нарушены <br />условия эксплуатации, <br />транспортировки или хранения</p>',
          5 => '<p>Проводился ремонт лицами, <br />не являющимися сотрудниками авторизованного <br />сервисного центра</p>',
          6 => '<p>Использовались <br />неоригинальные <br />комплектующие</p>',
        ),
        '.landing-block-node-card-title' => 
        array (
          0 => ' ',
          1 => ' ',
          2 => ' ',
          3 => ' ',
          4 => ' ',
          5 => ' ',
          6 => ' ',
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-card' => 
        array (
          0 => 'landing-block-node-card js-animation fadeInUp col-md-6 g-mb-40 animated landing-card col-lg-6',
        ),
        '.landing-block-node-card-text' => 
        array (
          0 => 'landing-block-node-card-text g-font-size-default g-color-gray-dark-v2 mb-0 g-font-size-16 g-font-open-sans',
        ),
        '.landing-block-node-card-title' => 
        array (
          0 => 'landing-block-node-card-title h5 text-uppercase g-font-weight-800',
        ),
        '#wrapper' =>
        array (
          0 => 'landing-block g-pt-0 g-pb-0 g-bg-gray-light-v5',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    7 => 
    array (
      'code' => '27.4.one_col_fix_text',
      'cards' => 
      array (
      ),
      'nodes' => 
      array (
        '.landing-block-node-text' => 
        array (
          0 => '<p>Подробное описание условий предоставления гарантии вы можете найти в документации к приобретенному товару и/или на сайте соответствующего производителя.</p>',
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-pb-1 g-font-open-sans g-font-size-14 g-color-gray-dark-v4',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block js-animation animated g-bg-gray-light-v5 g-pb-20 g-pt-0 animation-none',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
  ),
);