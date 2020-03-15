<?php
/**
 * Created by PhpStorm.
 * User: saeed
 * Date: 3/14/2020 AD
 * Time: 17:07
 */

function is_admin($user)
{
    if($user->role != 'admin')
        return false;
    return true;
}