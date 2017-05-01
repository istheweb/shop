<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 7/04/17
 * Time: 19:29
 */

namespace istheweb\shop\behaviors;

use System\Classes\ModelBehavior;

class ShipmentModel extends ModelBehavior
{

    /**
     * ShipmentModel constructor.
     */
    public function __construct($model)
    {
        parent::__construct($model);
    }

    /**
     * @return mixed

    public function calculateShipment($shipping_method, $count)
    {
        $total = 0;
        if($shipping_method->calculator == 'flat_rate'){
            $total = $shipping_method->amount;
        }elseif($shipping_method == 'per_unit_rate'){
            $total = $shipping_method->amount * $count;
        }
        $amounts = explode( '.', $total);
        if(count($amounts) == 2){
            $amount = $amounts[0]."".$amounts[1];
        }else{
            $amount = $total."00";
        }
        return $amount;
    }*/
}