<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 16/04/17
 * Time: 20:41
 */

namespace istheweb\shop\classes;


class OrderEvents
{
    const PRE_CREATE = 'istheweb.order.pre_create';
    const POST_CREATE = 'istheweb.order.post_create';

    const PRE_UPDATE = 'istheweb.order.pre_update';
    const POST_UPDATE = 'istheweb.order.post_update';

    const PRE_DELETE = 'istheweb.order.pre_delete';
    const POST_DELETE = 'istheweb.order.post_delete';
}