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
use \App\Models\mcSettings as mcSettings;

class mcUpdateController extends mcBaseController
{
    private $settings;

    public function __construct()
    {
        $this->settings = mcSettings::first();
    }
/*------------------------------------------------------------------------------
*
*
*
*-------------------------------------------------------------------------------
*/
    public function getData( )
    {
        $comunities = mcComunities::all();
        $keywords = mcKeywords::all();

        $data = array();

        foreach ( $comunities as $key => $comunity )
        {
            $comunity->url = str_replace( 'https://vk.com/', '', $comunity->url );

            $content = Curl::to('https://api.vk.com/method/wall.get' )
                        ->withData([ 'domain' => $comunity->url, 'v' => '5.52', 'count' => $this->settings->scan_depth ] )
                        ->withOption( 'USERAGENT', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7' )
                        ->get();

            $content = json_decode( $content );
            if ( isset( $content->error ) )
                continue;

            foreach( $content->response->items as $item )
            {
                if ( !isset( $item->is_pinned ) )
                {
                    $item->owner_name = $comunity->name;
                    $item->comunity_id = $comunity->id;
                    array_push( $data, $item );
                }
            }

            usleep( rand( 500000, 2000000 ) );
        }

        $posts = array();
        foreach( $data as $item )
        {
            $post = mcPost::select('*')->where( 'vk_id', '=', $item->id )->first();

            //пост уже обработали, пропускаем его
            if ( $post )
                continue;

            if ( $this->analyse_data( $item, $keywords ) == false )
                continue;

                //добавляем перенос строки перед элементом нумерованного списка
                $item->text = preg_replace( '/(\d\.)[^\d]/', '<br>$1', $item->text );

                //добавляем перенос строки перед хэш тэгом
                $item->text = preg_replace( '/(#\S*)/', '<br>$1', $item->text );

                //replace http://vk.com/id12356 на кликабельную ссылку
                $item->text = preg_replace( '/(http\S*)/', '<br><a href=$1>$1</a>' , $item->text );

                //replace [id123456|имя] на ссылку на профиль
                $item->text = preg_replace( '/\[(id[\d]*)\|(\S.*)\]/', '<a href="https://vk.com/$1">$2</a>', $item->text );
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

            //отправляем персональные сообщения
            if( $this->settings->send_proposal )
            {
                $message = mcProposal::all()->random(1);

                if( isset( $post->signer_id ) )
                {

                    // $sent = $this->sendMessage( $post->signer_id , $message->text );
                }
                else if( $post->owner_id > 0 )
                {
                    //$sent = $this->sendMessage( $post->owner_id, $message->text );
                }
            }
            if ( isset( $sent ) )
                $post->sent = true;

            $post->save();
            array_push( $posts, $post );
            //увеличиваем счетчик эффективности на 1
            mcComunities::find( $item->comunity_id )->increment('efficiency');


        }
        $this->sendMail( $posts );

        return redirect()->route( 'home' )->with( 'msg', 'Обновлено' );
    }

/*------------------------------------------------------------------------------
*
*
*
*-------------------------------------------------------------------------------
*/
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

/*------------------------------------------------------------------------------
*
*
*
*-------------------------------------------------------------------------------
*/
    public function sendMessage( $id, $message )
    {
        //*https://api.vk.com/method/messages.send?user_id=6269901&message=habrahabr&v=5.37&access_token=000000*/
        //token - 96b974f939195cfd6660abb4073b43f8d3fb41529ffe9b287137953a776a52e36b5e4ee089027548c4842
        //$settings = mcSettings::first();
        if ( !isset( $this->settings->access_token ) && !$this->settings->send_proposal )
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
    public function sendMail( $items )
    {
        if ( $this->settings->admin_email )
        {
            Mail::queue( 'emails.welcome', ['items' => $items], function( \Illuminate\Mail\Message $message )
            {
              $message->to( $this->settings->admin_email, 'Admin' );
              $message->subject( 'Новые сообщения' );
              $message->from( 'admin@promo.monochromatic.ru', 'VK Crowler' );
            });
        }
    }


}
