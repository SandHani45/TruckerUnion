<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GroupMember;
use App\User;


class GroupMemberController extends Controller
{

    public function index()
    {
        $eachGroupList = GroupMember::first();
        $id =  $eachGroupList->user_id;
        $userData = User::where('id', $id)->get();
        return  $userData;                         
    }

    public function destroy($id)
    {
        GroupMember::where('id',$id)->delete();
        toast('Removed from chat list  ','success','top-right');
        return redirect()->back();
    }
}
