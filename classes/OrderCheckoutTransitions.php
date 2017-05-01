<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 23/04/17
 * Time: 12:00
 */

namespace istheweb\shop\classes;


class OrderCheckoutTransitions
{
    const GRAPH = 'istheweb_order_checkout';

    const TRANSITION_ADDRESS = 'address';
    const TRANSITION_COMPLETE = 'complete';
    const TRANSITION_SELECT_PAYMENT = 'select_payment';
    const TRANSITION_SELECT_SHIPPING = 'select_shipping';
}