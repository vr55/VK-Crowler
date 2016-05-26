<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Curl;
use Mail;
use DB;

use \App\Models\mcPosts as mcPost;
use \App\Models\mcComunities as mcComunities;
use \App\Models\mcKeywords as mcKeywords;

class mcUpdateController extends mcBaseController
{
    public function getData( )
    {
        $comunities = mcComunities::all();
        $keywords = mcKeywords::all();

        $data = array();

        foreach ( $comunities as $key => $comunity )
        {
            $comunity->url = str_replace( 'https://vk.com/', '', $comunity->url );

            $content = Curl::to('https://api.vk.com/method/wall.get' )
                        ->withData([ 'domain' => $comunity->url, 'v' => '5.52', 'count' => '20' ] )
                        ->withOption( 'USERAGENT', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7' )
                        ->get();

            $content = json_decode( $content );
            if ( isset( $content->error ) )
                continue;

            foreach( $content->response->items as $item )
            {
                if ( !isset( $item->is_pinned) )
                {
                    $item->owner_name = $comunity->name;
                    $item->comunity_id = $comunity->id;
                    array_push( $data, $item );
                }
            }

            usleep( rand( 500000, 2000000 ) );

        }

        foreach( $data as $item )
        {
            $post = mcPost::select('*')->where( 'vk_id', '=', $item->id )->first();

            //пост уже обработали, пропускаем его
            if ( $post )
                continue;

            if ( $this->analyse_data( $item, $keywords ) == false )
                continue;
/*
            $post_type = $item->post_type;
            $comments = $item->comments;
*/
            $post = new mcPost();
            $post->vk_id = $item->id;
            $post->owner_id = $item->owner_id;
            $post->from_id = $item->from_id;
            $post->signer_id = isset( $item->signer_id ) ? $item->signer_id : false;
            $post->text = $item->text;
            $post->date = $item->date;
            $post->owner_name = $item->owner_name;
            $post->save();

            //увеличиваем счетчик эффективности на 1
            mcComunities::find( $item->comunity_id )->increment('efficiency');

        }
        return redirect()->route( 'home' )->with( 'msg', 'Обновлено' );
    }


    private function analyse_data( &$item, $keywords )
    {
        setlocale ( LC_ALL, 'ru_RU' );

        foreach( $keywords as $word )
        {
            $pattern = '/\s' . $word->keyword . '\s/i';
            if( preg_match( $pattern, $item->text ) )
            {
                $item->text = preg_replace( $pattern, '<b> ' . $word->keyword . ' </b>', $item->text );
                $word->increment( 'efficiency' );
                return true;
            }

            //$text = str_ireplace( $word->keyword, '<b>' . $word->keyword . '</b>', $item->text, $count );
            /*if ( stripos( $item->text, $word->keyword ) )
                return true;*/
            //if ( $count > 0 )
            //{
            //    var_dump( $text ); /*exit;*/
            //    return true;
            //}
        }
        return false;
    }

    public function sendMessage( $id, $message )
    {
        //*https://api.vk.com/method/messages.send?user_id=6269901&message=habrahabr&v=5.37&access_token=000000*/
        //token - 96b974f939195cfd6660abb4073b43f8d3fb41529ffe9b287137953a776a52e36b5e4ee089027548c4842
        $settings = mcSettings::first();
        if ( !isset( $settings->access_token ) )
            return false;

        $response = Curl::to('https://api.vk.com/method/messages.send')
                ->withData(['user_id' => $id, 'message' => $message, 'v' => '5.52', 'access_token' => $settings->access_token ])
                ->post();

        $response = json_decode( $response );

        if ( isset( $response->error ) )
        {
            return false;
        }

        return true;
    }

/*------------------------------------------------------------------------------
*
*
*
*-------------------------------------------------------------------------------
*/
    public function sendMail()
    {
        Mail::queue( 'emails.welcome', ['key' => 'value'], function($message)
        {
          $message->to('vr5@bk.ru', 'John Smith')->subject('Welcome!');
          $message->from( 'admin@promo.monochromatic.ru', 'admin');
        });
        # code...
    }


}
