<?php

use Illuminate\Http\Request,
    App\Http\Controllers\teamspeakController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/listUsers', function(){
    return teamspeakController::listUsers();
});

Route::get('/listUsersHTML', function(){
    $clients = teamspeakController::listUsers();
    $html = '';
    foreach($clients['data'] as $client){

        $html .= '<tr class="client">';
        $html .= '<th class="clid" scope="row">'.$client['clid'].'</th>';
        $html .= '<td class="name">'.$client['client_nickname'].'</td>';
        $html .= '<td class="type">'.$client['client_type'].'</td>';
        $html .= '<td class="actions" data-username="'.$client['client_nickname'].'" data-clid="'.$client['clid'].'">';
        $html .= '<a href="#" class="minus kick_user" title="Kick User">';
        $html .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 295.82 295.82" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 295.82 295.82"><g><g><path d="M147.91,0C66.124,0,0,66.124,0,147.91s66.124,147.91,147.91,147.91s147.91-66.124,147.91-147.91S229.696,0,147.91,0z     M147.91,278.419c-71.345,0-130.509-59.164-130.509-130.509S76.565,17.401,147.91,17.401S278.419,76.565,278.419,147.91    S219.255,278.419,147.91,278.419z"/><path d="m191.413,139.21h-87.006c-5.22,0-8.701,3.48-8.701,8.701 0,5.22 3.48,8.701 8.701,8.701h87.006c5.22,0 8.701-3.48 8.701-8.701 0-5.221-3.481-8.701-8.701-8.701z"/></g></g> </svg>';
        $html .= '</a>';
        $html .= '<a href="#" class="cross ban_user" title="Ban User">';
        $html .= '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M256,480 C132.288,480,32,379.712,32,256S132.288,32,256,32s224,100.288,224,224S379.712,480,256,480z"/><polygon points="356.64,132.64 256,233.44 155.36,132.64 132.64,155.36 233.44,256 132.64,356.64 155.36,379.36 256,278.56 356.64,379.36 379.36,356.64 278.56,256 379.36,155.36 			"/></g></g></g></svg>';
        $html .= '</a>';
        $html .= '</td>';
        $html .= '</tr>';

    };
    return $html;
});

Route::get('/listChannels', function(){
    return teamspeakController::listChannels();
});

Route::get('/listChannelsHTML', function(){
    $channels = teamspeakController::listChannels();
    $html = '';
    foreach ($channels['data'] as $channel){

        $html .= '<tr class="channel" title="View Channel">';
        $html .= '<td class="cid">' . $channel['cid'] . '</td>';
        $html .= '<td class="pid">' . $channel['pid'] . '</td>';
        $html .= '<td class="channel_name">' . $channel['channel_name'] . '</td>';
        $html .= '<td class="total_clients">' . $channel['total_clients'] . '</td>';
        $html .= '<td class="channel_order">' . $channel['channel_order'] . '</td>';
        $html .= '<td class="channel_needed_subscribe_power">' . $channel['channel_needed_subscribe_power'] . '</td>';
        $html .= '</tr>';

    };
    return $html;
});

Route::get('/kickUser', function(){
    if(!isSet($_GET['id']) || !isSet($_GET['mode']))
        abort(500);

    $reason = (!isSet($_GET['reason']) || $_GET['reason'] === '') ? 'Kicked from TS3 Panel' : $_GET['reason'];

    return teamspeakController::kickUser($_GET['id'], $_GET['mode'], $reason);
});

Route::get('/banUser', function(){
    if(!isSet($_GET['id']))
        abort(500);

    // BAN LENGTH
    $length = 0; // PERM
    if(isSet($_GET['length']))
        $length = $_GET['length'];

    // BAN REASON
    $reason = 'Banned From TS3Dev';
    if(isSet($_GET['reason']))
        $reason = $_GET['reason'];

     // CONTROLLER ACTION
    return teamspeakController::banUser($_GET['id'], $length, $reason);
});

Route::get('/massMessage/{msg}',function($msg){
    return teamspeakController::massMessage($msg);
});

Route::get('/getChannelInfo/{cid}', function ($cid){
    return teamspeakController::getChannelInfo($cid);
});

Route::get('/deleteChannel/{cid}', function($cid){
    return teamspeakController::deleteChannel($cid);
});

Route::get('/updateChannel/{cid}', function($cid){
    if(!isSet($_GET['params']))
        abort(500);

    $data = array();
    $p = $_GET['params'];

    if(isSet($p['channelName']))
        $data['CHANNEL_NAME'] = $p['channelName'];

    if(isSet($p['CHANNEL_DESCRIPTION']))
        $data['CHANNEL_NAME'] = $p['description'];

    if(isSet($p['CHANNEL_PASSWORD']))
        $data['CHANNEL_NAME'] = $p['password'];

    if(isSet($p['max_clients']))
        $data['CHANNEL_MAXCLIENTS'] = $p['max_clients'];

    if(isSet($p['needed_talkpower']))
        $data['CHANNEL_NEEDED_TALK_POWER'] = $p['needed_talkpower'];

    if(isSet($p['order']))
        $data['CHANNEL_ORDER'] = $p['order'];

    return teamspeakController::editChannel($cid, $data);
});

Route::get('/getUserInfo/{cid}', function ($cid){
    return teamspeakController::getUserInfo($cid);
});
