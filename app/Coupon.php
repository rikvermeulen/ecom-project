<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public static function findByCode($code)
    {
        return self::where('code', $code)->first(); /*pas code toe als code overheen komt in db*/
    }

    public function discount($total)
    {
        if ($this->type == 'fixed') {
            return $this->value; /*static waarde*/
        } elseif ($this->type == 'percent') {
            return round(($this->percent_off / 100) * $total); /*prectage waarde*/
        } else {
            return 0;
        }
    }
}
