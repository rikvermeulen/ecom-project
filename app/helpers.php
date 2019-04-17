<?php

function presentPrice($price)
{
    return money_format('€%i', $price/100);
}

function productImage($path)
{
    return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('/images/no-image.png'); /*looks if image is in storage if not display no image pic*/
}