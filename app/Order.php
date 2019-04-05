<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "oc_order";
    protected $primaryKey = "order_id";
    protected $fillable = ["total", "date_added", "date_modified"];

    public $timestamps = false;

    protected $attributes = [
        'invoice_no' => 0,
        "invoice_prefix" => "",
        "store_id" => 4,
        "store_name" => "", //Monkey King Thai Restaurant
        "store_url" => 'http://192.168.1.220/',
        "customer_id" => 0,
        "customer_group_id" => 1,
        "firstname" => " ",
        "lastname" => " ",
        "email" => "",
        "telephone" => " ",
        "fax" => " ",
        "custom_field" => " ",
        "payment_firstname" => " ",
        "payment_lastname" => " ",
        "payment_company" => " ",
        "payment_address_1" => " ",
        "payment_address_2" => " ",
        "payment_city" => " ",
        "payment_postcode" => " ",
        "payment_country" => " ",
        "payment_country_id" => 0,
        "payment_state" => " ",
        "payment_state_id" => 0,
        "payment_suburb" => " ",
        "payment_suburb_id" => 0,
        "payment_address_format" => " ",
        "payment_custom_field" => " ",
        "payment_code" => "cod",
        "payment_method" => "DineIn",
        "shipping_firstname" => " ",
        "shipping_lastname" => " ",
        "shipping_email" => "tableorder@order2.com",
        "shipping_telephone" => " ",
        "shipping_company" => " ",
        "shipping_address_1" => " ",
        "shipping_address_2" => " ",
        "shipping_city" => " ",
        "shipping_postcode" => " ",
        "shipping_country" => " ",
        "shipping_country_id" => 0,
        "shipping_state" => " ",
        "shipping_state_id" => 0,
        "shipping_suburb" => " ",
        "shipping_suburb_id" => 0,
        "shipping_address_format" => " ",
        "shipping_custom_field" => " ",
        "shipping_method" => "DineIn",
        "shipping_orderWhen" => "now",
        "shipping_code" => " ",
        "comment" => " ",
        "order_status_id" => 1,
        "affiliate_id" => 0,
        "commission" => 0.0000,
        "marketing_id" => 0,
        "tracking" => " ",
        "language_id" => 1,
        "currency_id" => 4,
        "currency_code" => "AUD",
        "shipping_orderTime" => "",
        "shipping_orderDate" => "",
        "currency_value" => 1.000000,
        //Todo: fetch from request
        "ip" => "192.168.1.220",
        "forwarded_ip" => " ",
        "user_agent" => "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36",
        //Todo: fetch from accept_language
        "accept_language" => "en-GB,en-US;q=0.8,en;q=0.6",
    ];
}
