<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\SocialAuth;
use Illuminate\Http\Request;

class MediaController extends Controller
{


    private $comsumerKey = '';  //twitter  keys
    private $comsumerSecrete = ''; //twitter  keys


    public function connect_twitter()
    {
        /** @var Callback URL $callback */
        $callback = route('media.cbk');

//        /** @var establishing twitter connection $_twitter_connect */
        $_twitter_connect = new TwitterOAuth($this->comsumerKey,$this->comsumerSecrete);

//        /** @var  $_access_token  get access token*/
        $_access_token =  $_twitter_connect->oauth('oauth/request_token',['oauth_callback'=>$callback]);

//        /** @var generate a new url for client $_route */
        $_route = $_twitter_connect->url('oauth/authorize',['oauth_token'=>$_access_token['oauth_token']]);

        return redirect($_route);

    }


    public function twitter_cbk(Request $request)
    {
        $response  = $request->all();

        $oauth_token = $response['oauth_token'];
        $oauth_verifier = $response['oauth_verifier'];

//        /** @var establishing twitter connection $_twitter_connect */
        $_twitter_connect = new TwitterOAuth($this->comsumerKey,$this->comsumerSecrete,$oauth_token,$oauth_verifier);

        //verify user token
        $token =  $_twitter_connect->oauth('oauth/access_token',['oauth_verifier'=>$oauth_verifier]);



        $oauth_token = $token['oauth_token'];   //access token
        $screen_name = $token['screen_name'];   //access token
        $oauth_token_secrete = $token['oauth_token_secret'];   //token secret


        /** Save token to database */
        $save = SocialAuth::query()->updateOrCreate(
            [ 'twitter_screen_name'=>$screen_name],
            [
                'twitter_oauth_token'=>$oauth_token,
                'twitter_oauth_token_secrete'=>$oauth_token_secrete
            ]
        );



        return redirect()->route('home.index');
    }


    public function twitter_post(Request $request)
    {
        $twitter  = SocialAuth::query()->first();
        $message  = $request->input('message');
        $hasFile =  $request->hasFile('attachment');  //true or false
        $file = null;   //set the file to null


            if($hasFile){
                $file = $request->file('attachment');
            }

        return $this->postMessageToTwitter($twitter->twitter_oauth_token,$twitter->twitter_oauth_token_secrete,$message,$file);
    }

    public function postMessageToTwitter($oauth_token,$oauth_token_secrete,$message,$file=null)  //$file has default as null
    {

        $push = new TwitterOAuth($this->comsumerKey,$this->comsumerSecrete,$oauth_token,$oauth_token_secrete);
        $push->setTimeouts(10,15);
        /** @noinspection PhpUndefinedFieldInspection */
        $push->ssl_verifypeer = true;

        if(!empty($file)){  //if a file has been uploaded

            $media = $push->upload('media/upload', ['media' => $file]);
            $parameters = [
                'status' =>$message,
                'media_ids' => $media->media_id_string
            ];

            $push->post('statuses/update', $parameters);  //push attachment with message to twitter status
        }
        else
        {
            //message without attachment
            $push->post('statuses/update', array('status' => $message));
        }

        return response()->json($push->getLastBody());
    }


}
