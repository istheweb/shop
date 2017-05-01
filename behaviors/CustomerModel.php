<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 27/01/17
 * Time: 14:24
 */

namespace istheweb\shop\behaviors;


use Illuminate\Support\Str;
use Istheweb\Shop\Models\Address;
use Istheweb\Shop\Models\Customer;
use RainLab\User\Facades\Auth;
use RainLab\User\Models\User;
use RainLab\User\Models\UserGroup;
use System\Classes\ModelBehavior;
use RainLab\User\Models\Settings as UserSettings;


class CustomerModel extends ModelBehavior
{

    const CLIENTS_GROUP_CODE = 'clients';

    const USER_SETTINGS_ACTIVATED_CODE = 'activate_mode';

    public function __construct($model)
    {
        return parent::__construct($model);
    }

    public function createUser($user){
        $automaticActivation = UserSettings::get(self::USER_SETTINGS_ACTIVATED_CODE) == UserSettings::ACTIVATE_AUTO;
        $user = Auth::register($user, $automaticActivation);

        $group = UserGroup::where('code', self::CLIENTS_GROUP_CODE)->first();

        $user->groups()->add($group);
        $user->save();

        return $user;
    }

    /**
     *
     * @param $id customer id
     * @return \Rainlab\User\Models\User $user
     */
    public function getUserByCustomerId($id){
        $customer = Customer::find($id)->first();
        $user = User::find($customer->user_id)->first();
        return $user;
    }

}