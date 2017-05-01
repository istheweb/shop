<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 5/03/17
 * Time: 11:59
 */

namespace istheweb\shop\classes;


class AvailabilityChecker
{
    /**
     * Are backorders enabled?
     *
     * @var bool
     */
    protected $backorders;

    /**
     * Constructor.
     *
     * @param bool $backorders
     */
    public function __construct($backorders)
    {
        $this->backorders = (bool) $backorders;
    }

    /**
     * {@inheritdoc}
     */
    public function isStockAvailable(StockableInterface $stockable)
    {
        if ($this->backorders || $stockable->isAvailableOnDemand()) {
            return true;
        }

        return 0 < ($stockable->getOnHand() - $stockable->getOnHold());
    }

    /**
     * {@inheritdoc}
     */
    public function isStockSufficient(StockableInterface $stockable, $quantity)
    {
        if ($this->backorders || $stockable->isAvailableOnDemand()) {
            return true;
        }

        return $quantity <= ($stockable->getOnHand() - $stockable->getOnHold());
    }
}