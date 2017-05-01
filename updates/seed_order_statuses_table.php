<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 30/01/17
 * Time: 13:57
 */

namespace istheweb\shop\updates;

use October\Rain\Database\Updates\Seeder;
use Istheweb\Shop\Models\OrderStatus;

class SeedOrderStatusesTable extends Seeder
{
    public function run()
    {
        $os = new OrderStatus();
        $os->name = 'Nuevo Pedido - Reembolso';
        $os->state = 'cash';
        $os->color = '#f1c40f';
        $os->send_email = 1;
        $os->attach_invoice = 0;
        $os->email_template = 'istheweb.shop::mail.orderconfirm';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'Nuevo Pedido - Paypal';
        $os->state = 'paypal';
        $os->color = '#f1c40f';
        $os->send_email = 1;
        $os->attach_invoice = 0;
        $os->email_template = 'istheweb.shop::mail.orderconfirm';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'Pago Cancelado';
        $os->state = 'cancel';
        $os->color = '#c0392b';
        $os->send_email = 0;
        $os->attach_invoice = 0;
        $os->email_template = 'istheweb.shop::mail.orderconfirm';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'Pago Recibido';
        $os->state = 'approved';
        $os->color = '#8e44ad';
        $os->send_email = 1;
        $os->attach_invoice = 1;
        $os->email_template = 'istheweb.shop::mail.orderconfirm';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'Pedido Enviado';
        $os->state = 'sent';
        $os->color = '#27ae60';
        $os->send_email = 1;
        $os->attach_invoice = 0;
        $os->email_template = 'istheweb.shop::order.order_send';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'Pedido Entregado';
        $os->state = 'delivered';
        $os->color = '#95a5a6';
        $os->send_email = 1;
        $os->attach_invoice = 0;
        $os->email_template = 'istheweb.shop::order.order_delivered';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'Nuevo Pedido - Administración';
        $os->state = 'admin';
        $os->color = '#34495e';
        $os->send_email = 0;
        $os->attach_invoice = 0;
        $os->email_template = 'istheweb.shop::order.order-received';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'Nuevo Pedido - Tpv';
        $os->state = 'tpv';
        $os->color = '#f39c12';
        $os->send_email = 1;
        $os->attach_invoice = 0;
        $os->email_template = 'istheweb.shop::order.order-received';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'Nuevo Pedido - Stripe';
        $os->state = 'stripe';
        $os->color = '#2ecc71';
        $os->send_email = 1;
        $os->attach_invoice = 0;
        $os->email_template = 'istheweb.shop::order.order-received';
        $os->save();
    }
}