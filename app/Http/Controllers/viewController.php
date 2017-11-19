<?php

namespace App\Http\Controllers;

use App\Http\Controllers\teamspeakController;
use Illuminate\Support\Facades\Session;

class viewController{

    public function instantiateTS(){
        return ts3Controller(env('TS3_IP'), env('TS3_QUERY_PORT'), 2);
    }

    public function index(){
        return view('welcome');
    }

    public function actions(){
        return view('actions');
    }

    public function listUsers(){
        $clients = teamspeakController::listUsers();

        return view('listUsers', ['clients' => $clients]);
    }

    public function createChannel(){
        return view('createChannel');
    }

    public function createChannelPost(){
        // Create Channel
        $res = teamspeakController::createChannel();

        // Set Messages
        if($res['success']){
            $successArray = array('type'=>'success', 'message'=>'You have successfully create the channel!');
            if(Session::has('msgs'))
                Session::push('msgs', $successArray);
            else
                Session::put('msgs', array($successArray));
        }else{
            $errorArray = array('type'=>'danger', 'message'=>'Error creating the channel!');
            if(Session::has('msgs'))
                Session::push('msgs', $errorArray);
            else
                Session::put('msgs', array($errorArray));
        }

        // Load View
        return self::createChannel();
    }

    public function listChannels(){
        $channels = teamspeakController::listChannels();

        return view('listChannels', ['channels' => $channels]);
    }
}
