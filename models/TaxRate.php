<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * TaxRate Model
 */
class TaxRate extends Base
{

    use Validation;

    const PERCENTAGE_TYPE = 'P';
    const FIXED_TYPE = 'F';
    const TAX_TYPE = 'tax';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_tax_rates';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation Rules
     */
    protected $rules = [
        'rate' => 'required|numeric'
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'zone' => 'Istheweb\Shop\Models\Zone',
        'tax_category' => 'Istheweb\Shop\Models\TaxCategory'
    ];

    public function scopeRate($query, $tax_category_id){
        $query->select(['rate', 'type', 'name'])->where('tax_category_id', '=', $tax_category_id);
    }

    public static function isIncludedInPrice(){
        /**
         * TODO: Tenemos que hacerlo dinámico
         */
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function calculate($base)
    {
        if ($this->isIncludedInPrice()) {
            return number_format($base - ($base / (1 + $this->rate)), 2);
        }

        $rate = $this->type == TaxRate::FIXED_TYPE ? number_format($this->rate, 2) :  number_format($base * $this->rate / 100, 2);
        $rates = explode('.', $rate);
        $rate = $rates[0].''.$rates[1];

        return $rate;
    }

}