<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use Illuminate\Http\Request;
use JWTAuth;

class ApiBotsController extends Controller {





public function index(){

  $user = JWTAuth::parseToken()->authenticate();
    return $user
        ->bots()
        ->orderBy('created_at', 'DESC')
        ->get()
        ->toArray();
}



public function show($id)
{

	$user = JWTAuth::parseToken()->authenticate();
    $bot = $this->user->bots()->find($id);
 
    if (!$bot) {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, bot with id ' . $id . ' cannot be found'
        ], 400);
    }
 
    return $bot;
}



public function store(Request $request)
{


	$user = JWTAuth::parseToken()->authenticate();

    $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
        'edited_at' => 'required'
    ]);
 
    $bot = new Bot();
    $bot->title = $request->title;
    $bot->description = $request->price;
    $bot->edited_at = $request->edited_at;
 
    if ($this->user->bots()->save($bot))
        return response()->json([
            'success' => true,
            'bot' => $bot
        ]);
    else
        return response()->json([
            'success' => false,
            'message' => 'Sorry, bot could not created bot'
        ], 500);
}


public function update(Request $request, $id)
{
    $user = JWTAuth::parseToken()->authenticate();

    $bot = $user->bots()->find($id);
   
    if(!$bot)
        throw new NotFoundHttpException;

    $bot->fill($request->all());

    if($bot->save())
        return $this->response->noContent();
    else
        return $this->response->error('could not update this bot', 500);
}




public function destroy($id)
{

	$user = JWTAuth::parseToken()->authenticate();


    $bot = $this->user->bots()->find($id);
 
    if (!$bot) {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, bot with id ' . $id . ' cannot be found'
        ], 400);
    }
 
    if ($bot->delete()) {
        return response()->json([
            'success' => true
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'bot could not be deleted'
        ], 500);
    }
}
















}