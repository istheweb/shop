<?php

return [
    'istheweb_checkout' => [
        'class' => Istheweb\Shop\Models\Order::class,
        'graph' => 'istheweb_checkout',
        'property_path' => 'checkout_state',
        'states' => [
            'cart',
            'addressed',
            'shipping_selected',
            'payment_selected',
            'completed',
        ],
        'transitions' => [
            'address' => [
                'from' => ['cart', 'addressed', 'shipping_selected', 'payment_selected'],
                'to' => 'addressed',
            ],
            'select_shipping' => [
                'from' => ['addressed', 'shipping_selected', 'payment_selected'],
                'to' => 'shipping_selected',
            ],
            'select_payment' => [
                'from' => ['payment_selected', 'shipping_selected'],
                'to' => 'payment_selected',
            ],
            'complete' => [
                'from' => ['payment_selected'],
                'to' => 'completed',
            ],
        ],
        'callbacks' => [
            'after' => [
                'istheweb_process_cart'  => [
                    'on'=> ["address", "select_shipping", "select_payment"],
                    'do' => [Istheweb\Shop\behaviors\OrderModel::class, "process"],
                    'args' => ["object"]
                ],
            ],
        ],
    ],
    'istheweb_order' => [
        'class' => Istheweb\Shop\Models\Order::class,
        'graph' => 'istheweb_order',
        'property_path' => 'state',
        'states' => [
            'cart',
            'new',
            'cancelled',
            'confirmed'
        ],
        'transitions' => [
            'create' => [
                'from' => ['cart'],
                'to' => 'new',
            ],
            'cancel' => [
                'from' => ['new'],
                'to' => 'cancelled',
            ],
            'confirm' => [
                'from' => ['new'],
                'to' => 'confirmed',
            ],
            'return' => [
                'from' => ['confirmed'],
                'to' => 'new',
            ],
        ],

        'callbacks' => [
            'before' => [],
            'after' => [],
        ],
    ],
    'istheweb_inventory_unit' => [
        'class' => Istheweb\Shop\Models\InventoryUnit::class,
        'graph' => 'istheweb_inventory_unit',
        'property_path' => 'state',
        'states' => [
            'checkout',
            'onhold',
            'sold',
            'backordered',
            'returned'
        ],
        'transitions' => [
            'hold' => [
                'from' => ['checkout'],
                'to' => 'onhold',
            ],
            'sell' => [
                'from' => ['onhold'],
                'to' => 'sold',
            ],
            'release' => [
                'from' => ['onhold'],
                'to' => 'checkout',
            ],
            'return' => [
                'from' => ['sold'],
                'to' => 'checkout',
            ],
        ],
        'callbacks' => [
            'before' => [],
            'after' => [],
        ],
    ],
];
