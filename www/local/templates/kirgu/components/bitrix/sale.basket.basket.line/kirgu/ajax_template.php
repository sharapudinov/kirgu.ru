<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(dirname(__FILE__)) . '/top_template.php');

if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY'])))
{
?><div  id="header-cart">

    <div class="minicart-wrapper" id="korzina_all">
        <?
        $parity = 'odd' ?>
        <ul id="cart-sidebar" class="mini-products-list">
            <?
            foreach ($arResult["CATEGORIES"] as $category => $items):
                if (empty($items))
                    continue;
                ?>
                <?
                foreach ($items as $v):?>
                    <li class="item <?= $parity ?>">
                        <a href="<?= $v["DETAIL_PAGE_URL"] ?>" title="<?= $v["NAME"] ?>" class="product-image">
                            <img src="<?= $v["PICTURE_SRC"] ?>" height="50" alt="<?= $v["NAME"] ?>">
                        </a>
                        <div class="product-details">
                            <p class="product-name">
                                <a href="<?= $v["DETAIL_PAGE_URL"] ?>"><?= $v["NAME"] ?></a>
                            </p>
                            <div class="bx-basket-item-list-item-remove"
                                 onclick="<?= $cartId ?>.removeItemFromCart(<?= $v['ID'] ?>)"
                                 title="<?= GetMessage("TSB1_DELETE") ?>"></div>
                            <div class="rating rating-small">
                                <div class="box-star">
                                    <div class="sprite-common star-not-active"></div>
                                    <div class="sprite-common star-active" style="width:0%"></div>
                                </div>
                                <span>(0)</span>
                            </div>
                            <table class="info-wrapper">
                                <tbody>
                                <tr>
                                    <td>
                                        <span class="price"><?= $v["PRICE_FMT"] ?></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                    <?
                    $parity = ($parity == 'even') ? 'odd' : 'even' ?>
                <?endforeach; ?>
            <?endforeach; ?>
        </ul>
        <?
        if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'):?>
            <? if ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'): ?>
                <p class="subtotal">
                    <span class="label"><?= GetMessage('TSB1_TOTAL_PRICE') ?></span>
                    <span class="price"><?= $arResult['TOTAL_PRICE'] ?></span>
                </p>
            <?endif; ?>
        <?endif; ?>
        <div class="minicart-actions">
            <ul class="checkout-types minicart">
                <?
                if ($arParams["PATH_TO_ORDER"] && $arResult["CATEGORIES"]["READY"]):?>
                    <li>
                        <a title="<?= GetMessage("TSB1_2ORDER") ?>" class="btn btn-green checkout-button"
                           href="<?= $arParams["PATH_TO_ORDER"] ?>"><?= GetMessage("TSB1_2ORDER") ?></a>
                    </li>
                <?endif ?>
            </ul>
        </div>
        <div class="minicart_promises">
            <div class="promise-2">
                <span class="icon"></span>
                <span>Честные цены на более<br>чем 200 000 товаров</span>
            </div>
        </div>
    </div>

    <script>
        BX.ready(function () {
            <?=$cartId?>.
            fixCart();
        });
    </script>
    <?
    }

    ?>

</div>