<?php

function presentPrice($price) /*functie presentprice*/
{
    return money_format('€%i', $price/100); /*als price wordt aangeroepen deel het door 100 voor correcte prijs*/
}

function productImage($path)/*functie productimage*/
{
    return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('/images/no-image.png'); /*lkijkt of product gekoppeld is aan foto anders display stock foto broken image*/
}