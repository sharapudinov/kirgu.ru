<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
   die();
}
use \Bitrix\Main\Localization\Loc;

return array (
  'code' => 'clothes/news1',
  'name' => Loc::getMessage('LANDING_DEMO_STORE_CLOTHES-NEMW1--NAME'),
  'description' => NULL,
  'type' => 'store',
  'version' => 2,
  'fields' => 
  array (
    'RULE' => NULL,
    'ADDITIONAL_FIELDS' => 
    array (
		'METAOG_IMAGE' => 'https://cdn.bitrix24.site/bitrix/images/demo/page/clothes/news1/preview.jpg',
      'VIEW_USE' => 'N',
      'VIEW_TYPE' => 'no',
    ),
  ),
  'layout' => 
  array (
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
          0 => 'Новости',
        ),
        '.landing-block-node-title' => 
        array (
          0 => 'Новое веяние в одежде - получено прочное водостойкое соединение',
        ),
        '.landing-block-node-text' => 
        array (
          0 => '<p><span style="font-weight: bold;">Авторы изобретения:</span> Разиньков Егор Михайлович и Зайцева Анна Анатольевна <br /><span style="">Патент Российской Федерации RU2277566 </span></p>',
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-title' => 
        array (
          0 => 'landing-block-node-title u-heading-v2__title g-line-height-1_1 g-font-weight-700 g-font-size-40 g-color-black g-mb-minus-10 g-font-montserrat g-text-transform-none',
        ),
        '.landing-block-node-subtitle' => 
        array (
          0 => 'landing-block-node-subtitle g-font-weight-700 g-font-size-12 g-color-primary g-mb-15',
        ),
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-pb-1 g-color-black g-font-open-sans g-font-size-16',
        ),
        '.landing-block-node-inner' => 
        array (
          0 => 'landing-block-node-inner text-uppercase u-heading-v2-4--bottom g-brd-primary',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block js-animation fadeInUp animated g-bg-main g-pt-40 g-pb-10',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    1 => 
    array (
      'code' => '31.4.two_cols_img_text_fix',
      'cards' => 
      array (
      ),
      'nodes' => 
      array (
        '.landing-block-node-title' => 
        array (
          0 => 'Описание изобретения',
        ),
        '.landing-block-node-text' => 
        array (
          0 => '<p>Изобретение относится к области получения и применения клеящих составов, используемых в производстве одежды и аксессуаров. Данная клеевая композиция предназначена только для горячего прессования и имеет в своем составе многокомпонентный гибкий отвердитель. Прототипом клеевой композиции является клей, состоящий из карбамидоформальдегидной смолы, сополимера акрилонитрила с N-винилкапролактамом и отвердитель. В качестве отвердителя применяют хлористый аммоний либо акриловую кислоту.</p><p><br /></p>',
        ),
        '.landing-block-node-img' => 
        array (
          0 => 
          array (
            'alt' => 'Image description',
			'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/eshop/930x580/img2.jpg',
          ),
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-text-container' => 
        array (
          0 => 'landing-block-node-text-container js-animation slideInRight col-md-6',
        ),
        '.landing-block-node-title' => 
        array (
          0 => 'landing-block-node-title g-font-weight-700 mb-0 g-mb-15 g-font-montserrat g-text-transform-none g-font-size-30',
        ),
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-color-gray-dark-v4 g-font-open-sans g-font-size-16',
        ),
        '.landing-block-node-img' => 
        array (
          0 => 'landing-block-node-img js-animation slideInLeft img-fluid',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block g-pt-10 g-pb-35',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
    2 => 
    array (
      'code' => '31.3.two_cols_text_img_fix',
      'cards' => 
      array (
      ),
      'nodes' => 
      array (
        '.landing-block-node-title' => 
        array (
          0 => ' ',
        ),
        '.landing-block-node-text' => 
        array (
          0 => '<p>Изобретение решает задачу по получению прочного и водостойкого клеевого соединения. Это достигается тем, что клеевая композиция, включающая синтетическую смолу и отвердитель, согласно изобретению, дополнительно содержит модификатор, причем в качестве синтетической смолы клеевая композиция включает карбамидомеламиноформальдегидную смолу с отвердителем 2542, в качестве модификатора - карбамидоформальдегидную смолу, а в качестве отвердителя - 10%-ный раствор щавелевой кислоты при следующем соотношении компонентов, мас.ч.:<br /><br /><span style="">Карбамидомеламиноформальдегидная смола	64,5-79,2<br /></span><span style="">10%-ный Раствор щавелевой кислоты	4,4-20,5<br /></span><span style="">Отвердитель для карбамидомеламиноформальдегидной	0,6-2,0<br /></span><span style="">смолы 2542	13,0-15,8</span></p>',
        ),
        '.landing-block-node-img' => 
        array (
          0 => 
          array (
            'alt' => 'Image description',
			'src' => 'https://cdn.bitrix24.site/bitrix/images/landing/business/eshop/802x590/img1.jpg',
          ),
        ),
      ),
      'style' => 
      array (
        '.landing-block-node-text-container' => 
        array (
          0 => 'landing-block-node-text-container js-animation slideInLeft col-md-6 g-pb-20 g-pb-0--md',
        ),
        '.landing-block-node-title' => 
        array (
          0 => 'landing-block-node-title text-uppercase g-font-weight-700 g-font-size-26 mb-0 g-mb-15',
        ),
        '.landing-block-node-text' => 
        array (
          0 => 'landing-block-node-text g-color-gray-dark-v4 g-font-size-16 g-font-open-sans',
        ),
        '.landing-block-node-img' => 
        array (
          0 => 'landing-block-node-img js-animation slideInRight img-fluid',
        ),
        '#wrapper' => 
        array (
          0 => 'landing-block g-pt-20 g-pb-55',
        ),
      ),
      'attrs' => 
      array (
      ),
    ),
  ),
);