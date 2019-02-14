@extends('master')

<section>
	Hello, {{$user->email}} Please Verify You Account <a href="{{route('sendEmailDone',["email" => $user->email,"verifyToken"=>$user->verifyToken])}}">click here</a>
	
</section>

