<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log,
    App\Http\Controllers\ts3Controller;

class teamspeakController extends \App\Http\Controllers\ts3Controller{


    /**
     * Instantiate a teamspeak controller
     *
     * @return \App\Http\Controllers\ts3Controller
     */
    public static function InstantiateTS(){
        $tsAdmin = new ts3Controller(env('TS3_IP'), env('TS3_QUERY_PORT'), 2);

        if(!$tsAdmin->getElement('success', $tsAdmin->connect())){
            Log::error('Connection could not be established.');
            abort(500);
        }

        $tsAdmin->login(env('TS3_USER'), env('TS3_PASS'));
        $tsAdmin->selectServer(env('TS3_PORT'));

        return $tsAdmin;
    }

    /**
     * Return a list of clients currently connected to the server
     *
     * @doc http://ts3admin.info/manual/classts3admin.html#a8bf4f096a55b5144da44c51fd5adce09
     * @return array clientList
     */
    public static function listUsers(){
        // Instantiate Teamspeak Instance
        $tsAdmin = self::InstantiateTS();

        // List Users on server
        $clients = $tsAdmin->clientList();

        return $clients;
    }

    /**
     * List Channels
     *
     * @return array
     */
    public static function listChannels(){
        $tsAdmin = self::InstantiateTS();

        return $tsAdmin->channelList();
    }

    /**
     * Kick a user by id from the server/channel with a message
     *
     * @param $id
     * @param $mode
     * @param $message
     * @return bool
     */
    public static function kickUser($id, $mode, $message){
        $tsAdmin = self::InstantiateTS();

        return $tsAdmin->clientKick($id, $mode, $message);
    }

    /**
     * Ban an user
     *
     * @param $id
     * @param int $length
     * @param string $reason
     * @return array
     */
    public static function banUser($id, $length = 0, $reason = 'Banned From TS3Dev'){
        $tsAdmin = self::InstantiateTS();

        return $tsAdmin->banClient($id, $length, $reason);
    }

    /**
     * Create a channel from the POST Parameters
     *
     * @return array
     */
    public static function createChannel(){
        // Check for required Parameters
        if(!isSet($_POST['channel_name']) || !isSet($_POST['channel_flag']))
            abort(500);

        $params = array(
            'CHANNEL_NAME' => $_POST['channel_name']
        );

        if($_POST['channel_flag'] === 'CHANNEL_FLAG_PERMANENT')
            $params['CHANNEL_FLAG_PERMANENT'] = 1;
        elseif($_POST['channel_flag'] === 'CHANNEL_FLAG_SEMI_PERMANENT')
            $params['CHANNEL_FLAG_SEMI_PERMANENT'] = 1;
        else
            $params['CHANNEL_FLAG_TEMPORARY'] = 1;

        // Check for optional parameters
        if(isSet($_POST['password']))
            $params['CHANNEL_PASSWORD'] = $_POST['password'];

        if(isSet($_POST['talk_power']))
            $params['CHANNEL_NEEDED_TALK_POWER'] = $_POST['talk_power'];

        $tsAdmin = self::InstantiateTS();
        return $tsAdmin->channelCreate($params);
    }

    /**
     * Send Mass Message to Server
     *
     * @param $msg
     * @return bool
     */
    public static function massMessage($msg){
        $tsAdmin = self::InstantiateTS();

        $serverID = $tsAdmin->serverIdGetByPort(env('TS3_PORT'))['data']['server_id'];

        // Send Message
        return $tsAdmin->sendMessage(
            self::TextMessageTarget_SERVER,
            $serverID,
            $msg
        );
    }

    /**
     * Get Detailed Channel Info For Channel Passed
     *
     * @param $cid
     * @return array
     */
    public static function getChannelInfo($cid){
        $tsAdmin = self::InstantiateTS();

        return $tsAdmin->channelInfo($cid);
    }

    /**
     * Delete a channel
     *
     * @param $cid
     * @param int $force
     * @return bool
     */
    public static function deleteChannel($cid, $force = 1){
        $tsAdmin = self::InstantiateTS();

        return $tsAdmin->channelDelete($cid, $force);
    }

    /**
     * Edit an channel
     *
     * @param $cid
     * @param $data
     * @return bool
     */
    public static function editChannel($cid, $data){
        $tsAdmin = self::InstantiateTS();

        return $tsAdmin->channelEdit($cid, $data);
    }

    /**
     * Get detailed information about a user
     *
     * @param $cid
     * @return array
     */
    public static function getUserInfo($cid){
        $tsAdmin = self::InstantiateTS();

        return $tsAdmin->clientInfo($cid);
    }
}
