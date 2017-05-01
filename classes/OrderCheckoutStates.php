<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 23/04/17
 * Time: 12:01
 */

namespace istheweb\shop\classes;


class OrderCheckoutStates
{
    const STATE_ADDRESSED = 'addressed';
    const STATE_CART = 'cart';
    const STATE_COMPLETED = 'completed';
    const STATE_PAYMENT_SELECTED = 'payment_selected';
    const STATE_SHIPPING_SELECTED = 'shipping_selected';
}