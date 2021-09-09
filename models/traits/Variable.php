<?php

namespace denisok94\admin\models\traits;

trait Variable
{

    public static function getValue($name)
    {
        $var = self::findOne($name);
        if ($var == null) {
            return null;
        }
        return $var->value; //json_decode(, true);
    }

    public static function setValue($name, $value)
    {
        $var = self::findOne($name);
        if ($var == null) {
            $var = new self(['name' => $name]);
        }
        $var->value = $value;
        $var->save();
    }
}
