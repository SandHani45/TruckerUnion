<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function() {

    //Auth Routes
    Route::group(['prefix' => 'auth'], function () {

        Route::post('login', 'ApiControllers\v1\Auth\AuthController@login');
        Route::post('verify_otp', 'ApiControllers\v1\Auth\AuthController@verifyOtp');
        Route::post('logout', 'ApiControllers\v1\Auth\AuthController@logout');
        Route::post('refresh', 'ApiControllers\v1\Auth\AuthController@refresh');
        Route::post('me', 'ApiControllers\v1\Auth\AuthController@me');
        Route::post('resend', 'ApiControllers\v1\Auth\AuthController@reSendOtp');

    });

    Route::group(['prefix'=> 'user', 'middleware' => ['auth:api']], function () {

        //Favorite Routes
        Route::get('{id}/favorites', 'ApiControllers\v1\FavoriteController@index');
        Route::put('{id}/fav_drop_point', 'ApiControllers\v1\FavoriteController@faveDropPoint');
        Route::put('{id}/unfav_drop_point', 'ApiControllers\v1\FavoriteController@unfavDropPoint');
        Route::delete('{id}/delete_favorite/{favorite}', 'ApiControllers\v1\FavoriteController@destroy');

        //ActiveRoots Routes
        Route::get('{id}/active_routes', 'ApiControllers\v1\ActiveRootController@index');
        Route::post('{id}/add_route', 'ApiControllers\v1\ActiveRootController@store');
        Route::delete('{id}/delete_route/{active_root}', 'ApiControllers\v1\ActiveRootController@destroy');

        //Search Routes
        Route::get('{id}/search/{key}/{skip}/{limit}','ApiControllers\v1\SearchController@getSearchResults');

        //DropPoint Routes
        Route::get('{id}/drop_points', 'ApiControllers\v1\DropPointController@index');
        Route::get('{id}/drop_points/{drop_point}', 'ApiControllers\v1\DropPointController@show');

        //Chat Group Routes
        //Chat Group Search Routes
        Route::get('{id}/search-groups/{key}/{skip}/{limit}','ApiControllers\v1\SearchGroupController@getSearchResults');

        Route::post('{id}/password_match', 'ApiControllers\v1\GroupMemberController@addGroupMember');
        Route::get('{id}/all-groups-list', 'ApiControllers\v1\GroupMemberController@groupList');
        Route::get('{id}/my-groups', 'ApiControllers\v1\MyGroupController@index');
        Route::get('{id}/my-groups/{group}'
            , 'ApiControllers\v1\GroupMemberController@eachGroupMemberList');
        Route::delete('{id}/my-groups/{group}'
                , 'ApiControllers\v1\GroupMemberController@destroy');
    });    
});
