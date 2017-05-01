<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/04/17
 * Time: 11:56
 */

namespace istheweb\shop\classes;


interface ShippableInterface
{
    /**
     * @return int
     */
    public function getShippingWeight();

    /**
     * @return int
     */
    public function getShippingVolume();

    /**
     * @return int
     */
    public function getShippingWidth();

    /**
     * @return int
     */
    public function getShippingHeight();

    /**
     * @return int
     */
    public function getShippingDepth();

    /**
     * @return ShippingCategoryInterface
     */
    public function getShippingCategory();
}