<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 16/04/17
 * Time: 20:42
 */

namespace istheweb\shop\classes;


class OrderTransitions
{
    const GRAPH = 'istheweb_order';

    const ISTHEWEB_CREATE = 'create';
    const ISTHEWEB_RELEASE = 'release';
    const ISTHEWEB_CONFIRM = 'confirm';
    const ISTHEWEB_SHIP = 'ship';
    const ISTHEWEB_ABANDON = 'abandon';
    const ISTHEWEB_CANCEL = 'cancel';
    const ISTHEWEB_RETURN = 'return';
}