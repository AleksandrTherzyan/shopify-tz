<?php


namespace App\Http\Controllers\Api\Shopify;


class ShopifyRequest
{

    /**
     * Make a request for shopify
     * @param $api_name
     * @param string $query
     * @return mixed
     */
    public static  function get($api_name,$query = '')
    {

        $key = env('SHOPIFY_KEY');
        $secret = env('SHOPIFY_SECRET');
        $shop_name = env('SHOPIFY_SHOP_NAME');

        $url = "https://{$key}:{$secret}@{$shop_name}.myshopify.com/admin/api/2019-04/{$api_name}?{$query}";

        $curl = curl_init( $url );
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json_response = curl_exec($curl);
        curl_close($curl);
        return json_decode($json_response, TRUE);
    }

}















