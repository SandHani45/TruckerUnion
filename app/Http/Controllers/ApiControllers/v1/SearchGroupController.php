<?php

namespace App\Http\Controllers\ApiControllers\v1;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchGroupController extends Controller
{
    public function getSearchResults($id, $key, $skip, $limit)
    {
    	$search = Group::where('name', 'like','%' .$key. '%')
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
