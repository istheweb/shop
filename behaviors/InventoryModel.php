<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 8/02/17
 * Time: 13:55
 */

namespace istheweb\shop\behaviors;


use istheweb\shop\classes\StockableEvents;

use istheweb\shop\classes\StockableInterface;
use System\Classes\ModelBehavior;
use Webmozart\Assert\Assert;
use Event;

class InventoryModel extends ModelBehavior
{

    public function __construct($model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function hold(StockableInterface $stockable, $quantity)
    {
        Assert::greaterThan($quantity, 0, 'Quantity of units must be greater than 0.');
        Event::fire(StockableEvents::PRE_HOLD, [$stockable]);
        $stockable->setOnHold($stockable->getOnHold() + $quantity);
        Event::fire(StockableEvents::POST_HOLD, [$stockable]);
    }

    /**
     * {@inheritdoc}
     */
    public function release(StockableInterface $stockable, $quantity)
    {
        Assert::greaterThan($quantity, 0, 'Quantity of units must be greater than 0.');
        Event::fire(StockableEvents::PRE_RELEASE, [$stockable]);
        $stockable->setOnHold($stockable->getOnHold() - $quantity);
        Event::fire(StockableEvents::POST_RELEASE, [$stockable]);
    }
}