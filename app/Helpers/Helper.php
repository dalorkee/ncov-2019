<?php
namespace App\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Helper
{


	/*
	* set query string
	* call it
	* url_query('products', ['manufacturer' => 'Samsung']);
	* Returns 'http://localhost/products?manufacturer=Samsung'
	* url_query('products', ['manufacturer' => 'Samsung'], [$product->id]);
	* Returns 'http://localhost/products/1?manufacturer=Samsung'
	*/
	public static function url_query($to, array $params = [], array $additional = []) {
		return Str::finish(url($to, $additional), '?') . Arr::query($params);
	}

	public static function SayHello() {
		return "Hello";
	}

}
?>
