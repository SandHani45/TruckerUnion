<?php

namespace App\Http\Controllers;
Use Alert;
use App\DropPoint;
use App\Group;
use App\GroupMember;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $groups = Group::where('user_id',$user->id)->get();
        return view('pages.groups.group',compact('groups'));
    }

  
    public function create()
    {
        $user = Auth::user();
        //return $user;
        $groups = Group::where('user_id',$user->id)->first();
        if($groups['user_id'] == $user->id)
        {
           alert()->error('Opps ','You can add only one group');
           return redirect('groups');
        }
            
        return view('pages.groups.add_group');
    }


    public function store(Request $request)
    {
        if ($request->hasFile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $image = $request->file('image');
            $t = Storage::disk('s3')->put($imageName, file_get_contents($image), 'public');
            $imageName = Storage::disk('s3')->url($imageName);
        }else
        {
            $imageName = Storage::disk('s3')->url('1527061218.png');
        }
        $user = Auth::user(); 
        $group = Group::create([
            'name' => $request['name'],
            'password' => Hash::make($request['password']),
            'image' => $imageName,
            'user_id' => $user->id,
        ]);
        alert()->success('Successfully','Chat Group Created');
        return redirect(route('groups.index'));
    }


    public function show($id)
    {
        $userDatas = DB::table('group_members')
            ->join('users', 'users.id', '=', 'group_members.user_id')
            ->where('group_members.group_id', '=', $id) 
            ->get(['group_members.id',
                    'group_members.group_id',
                    'group_members.user_id',                   
                    'users.phone_number']);
        return view('pages.groups.group-members', compact('userDatas'));
    }


    public function edit($id)
    {
        $groups = Group::where('id', $id)->first();
        return view('pages.groups.edit_group', compact('groups'));
    }


    public function update(Request $request, $id)
    {
        $imageName = '';
        if ($request->hasFile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $image = $request->file('image');
            $t = Storage::disk('s3')->put($imageName, file_get_contents($image), 'public');
            $imageName = Storage::disk('s3')->url($imageName);
        }
        $user = Auth::user();
        $groups = Group::find($id);
        $groups->user_id = $user->id;
        $groups->name = $request->name;
        $groups->image = $imageName ? $imageName : $groups->image;
        $groups->update();
        if($groups->update()){
            alert()->success('Successfully','Chat Group edited ');
        }
        return redirect(route('groups.index'));
    }


    public function destroy($id)
    {
        Group::where('id', $id)->delete();
        GroupMember::where('group_id',$id)->delete();
        toast('Group Delete ','success','top-right');
        return redirect()->back();    
    }
}
