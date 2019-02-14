<?php

namespace App\Http\Controllers\ApiControllers\v1;

use App\DropPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function getSearchResults($id, $key, $skip, $limit)
    {
        $search = DropPoint::where('name', 'like','%' .$key. '%')
               ->orWhere('phone_number', 'like', '%' .$key. '%')
               ->orWhere('address', 'like', '%' .$key. '%')
               ->orWhere('city', 'like', '%' .$key. '%')
               ->orWhere('state', 'like', '%' .$key. '%')
               ->orWhere('country', 'like', '%' .$key. '%')
               ->orWhere('pincode', 'like', '%' .$key. '%')
               ->offset($skip)
               ->limit($limit)
               ->get();

        return response()->json([
        	'sucess' => true,
          'message' => 'query is sucess',
            'data' => $search
        ]);
    }
}
