<?php

namespace App\Http\Controllers\ApiControllers\v1;

use App\Group;
use App\GroupMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class GroupMemberController extends Controller
{
    public function addGroupMember(Request $request)
    {
    	$validate_group = Group::where('id', Input::get('group_id'))
                            	->first();

        $validate_group_member = GroupMember::where('user_id',$request->user_id)
        									->where('group_id',$request->group_id)
        									->first();									
        if ($validate_group && Hash::check(Input::get('password'), $validate_group->password)) {
  			if(!$validate_group_member){
	  			$add_group_member = new GroupMember;
	  			$add_group_member->group_id = $request->group_id;
	  			$add_group_member->user_id = $request->user_id;
	  			$add_group_member->save();

	  			return response()->json([
		        	'sucess' => true,
		          	'message' => 'query is sucess',
		            'data' => $add_group_member
		    	]);	
  			}
  			return response()->json([
	        	'sucess' => true,
	          	'message' => 'already in group',  
	    	]);	
  			
		}
		return response()->json([
        	'sucess' => false,
          	'message' => 'invalid data',  
	    ]);	
	}

	public function groupList()
	{
		$allGroupName = Group::all();

		return response()->json([
        	'message' => 'query is sucess',
		    'data' => $allGroupName
	    ]);	
	}

	public function eachGroupMemberList($id, $group)
	{
		$eachGroupLists = GroupMember::join('users', 'group_members.user_id', '=', 'users.id')
             						->where('group_members.group_id', '=', $group)
             						->where('group_members.user_id', '!=', $id)
             						->where('users.status', '==', 0)
            						->get(['group_members.id',
              								'group_members.user_id',
              							  'group_members.group_id',
              							  'users.phone_number',
                              'users.onesignal_token',
              							  'users.status',
              								'group_members.created_at',
              								'group_members.updated_at',
            							    ]);

        if($eachGroupLists){
        	return $eachGroupLists;
        }
    }

    public function destroy($id, $group)
	{
        $GroupMember = GroupMember::findOrFail($group)->delete();

        if($GroupMember){
        	return response()->json([
	           'success' => true,
	           'message' => 'query delete',
        	], 200);
        }                    
         return response()->json([
	           'success' => false,
	           'message' => 'please send valide id ',
        	], 200);                 
	}
	
}