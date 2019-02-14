<?php

namespace App\Http\Controllers;

use App\GroupMember;
use App\User;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
