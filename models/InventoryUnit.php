<?php namespace Istheweb\Shop\Models;

use istheweb\shop\classes\StockableInterface;
use Model;


/**
 * InventoryUnit Model
 */
class InventoryUnit extends Model
{

    /**
     * Default states.
     */
    const STATE_CHECKOUT = 'checkout';

    const STATE_ONHOLD = 'onhold';

    const STATE_SOLD = 'sold';

    const STATE_BACKORDERED = 'backordered';

    const STATE_RETURNED = 'returned';

    /**
     * Default transitions
     */

    const GRAPH = 'istheweb_inventory_unit';

    const ISTHEWEB_HOLD = 'hold';

    const ISTHEWEB_BACKORDER = 'backorder';

    const ISTHEWEB_SELL = 'sell';

    const ISTHEWEB_RELEASE = 'release';

    const ISTHEWEB_RETURN = 'return';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_inventory_units';

    /**
     * @var array Implements bevaviors
     */
    public $implement = [
        'Istheweb.Shop.Behaviors.InventoryModel'
    ];

    public $morphTo = [
        'stockable' => []
    ];


    /**
     * {@inheritdoc}
     */
    public function getStockable()
    {
        return $this->stockable;
    }

    /**
     * @param StockableInterface $stockable
     */
    public function setStockable(StockableInterface $stockable)
    {
        $this->stockable = $stockable;
    }

    /**
     * {@inheritdoc}
     */
    public function getInventoryName()
    {
        return $this->stockable->getInventoryName();
    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setInventoryState($state)
    {
        $this->state = $state;
    }

    /**
     * {@inheritdoc}
     */
    public function isSold()
    {
        return InventoryUnit::STATE_SOLD === $this->inventoryState;
    }
}