<?php namespace Istheweb\Shop\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Backend\FormWidgets\RecordFinder;
use Backend\Traits\FormModelWidget;
use Istheweb\IsCorporate\Models\Client;

use Istheweb\Shop\Models\Address;
use Istheweb\Shop\Models\Customer;
use RainLab\Location\Models\State;
use RainLab\User\Models\User;

/**
 * ClientAddress Form Widget
 */
class ClientAddress extends RecordFinder
{

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'istheweb_shop_client_address';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->fillFromConfig([
            'title',
            'prompt',
            'keyFrom',
            'nameFrom',
            'descriptionFrom',
            'scope',
            'conditions',
            'searchMode',
            'searchScope',
            'recordsPerPage',
        ]);

        if (post('recordfinder_flag')) {
            $this->listWidget = $this->makeListWidget();
            $this->listWidget->bindToController();

            $this->searchWidget = $this->makeSearchWidget();
            $this->searchWidget->bindToController();

            $this->listWidget->setSearchTerm($this->searchWidget->getActiveTerm());

            /*
             * Link the Search Widget to the List Widget
             */
            $this->searchWidget->bindEvent('search.submit', function () {
                $this->listWidget->setSearchTerm($this->searchWidget->getActiveTerm());
                return $this->listWidget->onRefresh();
            });
        }
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('container');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['value'] = $this->getKeyValue();
        $this->vars['field'] = $this->formField;
        $this->vars['nameValue'] = $this->getNameValue();
        $this->vars['descriptionValue'] = $this->getDescriptionValue();
        $this->vars['addresses'] = $this->getAddresses();
        $this->vars['listWidget'] = $this->listWidget;
        $this->vars['searchWidget'] = $this->searchWidget;

        $this->vars['title'] = $this->title;
        $this->vars['prompt'] = str_replace('%s', '<i class="icon-th-list"></i>', e(trans($this->prompt)));

    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/clientaddress.css', 'Istheweb.Shop');
        $this->addJs('js/clientaddress.js', 'Istheweb.Shop');
    }

    public function onRefresh()
    {
        $customer = Customer::find(post('Address[customer]'));
        $this->relationModel = $customer;
        //dd($this->relationModel->user_id);

        $this->prepareVars();
        return ['#'.$this->getId('container') => $this->makePartial('recordfinder')];
    }

    public function onChange()
    {
        $address = Address::find(post('addresses'));
        $customer = Customer::find(post('Address[customer]'));
        $states = State::where('country_id', '=', $address->country_id)->lists('name', 'id', 'code');

        return [
            'address' => $address,
            'customer' => $customer,
            'states'   => $states
        ];
    }

    public function getNameValue()
    {

        if (!$this->relationModel || !$this->relationModel->user_id) {
            return null;
        }

        $user = User::find($this->relationModel->user_id);
        $name = $user->name . " " . $user->surname;
        return $name;
    }

    public function getAddresses()
    {
        if(!$this->relationModel){
            return null;
        }

        $addresses = Address::where('customer_id', '=', $this->relationModel->id)->get();
        return $addresses;
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return $value;
    }

}
