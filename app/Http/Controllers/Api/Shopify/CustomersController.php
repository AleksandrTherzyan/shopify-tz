<?php


namespace App\Http\Controllers\Api\Shopify;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomersController extends Controller
{

    const API_NAME = 'customers/search.json?';

    public static function getAll()
    {
        return response()->json(ShopifyRequest::get(self::API_NAME), 200);
    }

    public static function find(Request $request)
    {

        return response()->json(ShopifyRequest::get(self::API_NAME . $request->get('query')), 200);
    }

}