<?php
/**
 * Created by PhpStorm.
 * User: MIGUEL-PF
 * Date: 2/4/2017
 * Time: 11:35 AM
 */

namespace TeachMe\Entities;


use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    public static function getClass()
    {
        return get_class(new static);
    }
}