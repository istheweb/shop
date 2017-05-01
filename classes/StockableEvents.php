<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 5/03/17
 * Time: 11:49
 */

namespace istheweb\shop\classes;


class StockableEvents
{
    const PRE_INCREASE = 'istheweb.shop.stockable.pre_increase';
    const POST_INCREASE = 'istheweb.shop.stockable.post_increase';

    const PRE_DECREASE = 'istheweb.shop.stockable.pre_decrease';
    const POST_DECREASE = 'istheweb.shop.stockable.post_decrease';

    const PRE_HOLD = 'istheweb.shop.stockable.pre_hold';
    const POST_HOLD = 'istheweb.shop.stockable.post_hold';

    const PRE_RELEASE = 'istheweb.shop.stockable.pre_release';
    const POST_RELEASE = 'istheweb.shop.stockable.post_release';
}