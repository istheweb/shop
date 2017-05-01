<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 5/03/17
 * Time: 11:51
 */

namespace istheweb\shop\classes;


interface StockableInterface
{
    /**
     * @return string
     */
    public function getInventoryName();

    /**
     * @return bool
     */
    public function isInStock();

    /**
     * @return int
     */
    public function getOnHold();

    /**
     * @param int $onHold
     */
    public function setOnHold($onHold);

    /**
     * @return int
     */
    public function getOnHand();

    /**
     * @param int $onHand
     */
    public function setOnHand($onHand);

    /**
     * @param bool $tracked
     */
    public function setTracked($tracked);

    /**
     * @return bool
     */
    public function isTracked();
}