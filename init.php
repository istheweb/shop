<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 5/03/17
 * Time: 9:45
 */
Event::listen('issue.afterCreate', 'Istheweb\IsCorporate\Listeners\EmailSupportTeam');