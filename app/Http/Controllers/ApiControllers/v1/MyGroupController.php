<?php

namespace App\Http\Controllers\ApiControllers\v1;

use App\Group;
use App\Http\Controllers\Controller;
use App\GroupMember;
use Illuminate\Http\Request;

class MyGroupController extends Controller
{
	
   public function index($id)
   {

   	$myGroup = GroupMember::with('group')
   							->where('group_members.user_id', '=', $id)
   							->get();
 
   	// $myGroup = GroupMember::join('groups', 'group_members.group_id', '=', 'groups.id')
    //         ->where('group_members.user_id', '=', $id)
    //         ->get([	'group_members.id',
    //         		'group_members.group_id',
	   //          	'groups.name',
	   //          	'group_members.user_id',
	   //          	'groups.image',
	   //          	'groups.password',
    //         		'groups.created_at',
    //         		'group_members.updated_at'
    //         	]);

		return response()->json([
		    'success' => true,
		    'message' => 'query is successfull',
		    'data' => $myGroup
	    ], 200);
   }

   public function addMyGroupList(Request $request)
   {
   		$validate_group = MyGroup::where('user_id',$request->user_id)
   								->where('group_id',$request->group_id)
   								->first();
   		if(!$validate_group){

   			$addGroupList = new MyGroup;
	   		$addGroupList->user_id = $request->user_id;
	   		$addGroupList->group_id = $request->group_id;
	   		$addGroupList->save();

	   		return response()->json([
			    'success' => true,
			    'message' => 'query is successfull',
			    'data' => $addGroupList
		    ], 200);
   		}							
   		return response()->json([
			    'success' => true,
			    'message' => 'query already added',
		    ], 200);
   	}
}
