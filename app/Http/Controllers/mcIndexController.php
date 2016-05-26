<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Curl;

use App\Models\mcKeywords as mcKeywords;
use App\Models\mcComunities as mcComunities;
use App\Models\mcPosts as mcPosts;
use App\Models\mcSettings as mcSettings;
use App\Models\mcProposals as mcProposals;

class mcIndexController extends mcBaseController
{

    public function getIndex()
    {
        $posts = mcPosts::orderBy( 'date', 'desc' )->paginate( 15 );
        return view( 'index', ['posts' => $posts] );
    }


    public function getKeywords()
    {
        $keywords = mcKeywords::paginate(15);
        return view( 'keywords', ['keywords' => $keywords] );
    }

    public function postKeywords( Request $request )
    {
        $this->validate( $request, [
            'keyword' => 'required'
        ]);

        $keyword = new mcKeywords();
        $keyword->keyword = $request->input( 'keyword' );
        $keyword->save();

        return redirect()->route('keywords');
    }
    public function getDeleteKeyword( Request $request, $id )
    {
        $keyword = mcKeywords::find( $id );

        if ( $keyword )
            $keyword->delete();

        return redirect()->route( 'keywords' )->with( 'msg', 'Удалено' );
    }

    public function getComunities()
    {
        $comunities = mcComunities::paginate(15);
        return view( 'comunities', ['comunities' => $comunities] );
    }

    public function postComunities( Request $request )
    {
        $this->validate( $request, [
                'url' => 'required|url'
                ]);
        //Вытаскиваем имя сообщества
        $name = str_replace( 'https://vk.com/', '', $request->input( 'url' ) );

        $content = Curl::to('https://api.vk.com/method/groups.getById' )
                    ->withData([ 'group_id' => $name, 'v' => '5.52' ] )
                    ->withOption('USERAGENT', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7' )
                    ->get();
        $content = json_decode( $content );

        if ( !isset( $content->error ) )
        {
            $name = $content->response[0]->name;
        }

        $comunitie = new mcComunities();
        $comunitie->url = $request->input( 'url' );
        $comunitie->name = $name;

        $comunitie->save();

        return redirect()->route( 'comunities' );
    }

    public function getDeleteComunity( Request $request, $id )
    {
        $comunity = mcComunities::find( $id );
        if ( $comunity )
            $comunity->delete();

        return redirect( 'comunities' )->with( 'msg', 'Удалено' );
    }

    public function getSettings()
    {
        $settings = mcSettings::first();
        //var_dump( $settings );
        return view( 'settings', [ 'settings' => $settings ] );
    }

    public function postSettings( Request $request )
    {
        $this->validate( $request, [
                'client_id'     => 'integer',
                'admin_email' => 'email'
        ]);
        $settings = mcSettings::first();
//
       if ( !isset( $settings ) )
            mcSettings::create( $request->except( '_token' ) );
        else
        {
            mcSettings::first()->update( $request->except( '_token' ) );
        }

        return redirect()->route('settings')->with( 'msg', 'Сохранено' );
    }

    public function getProposals()
    {
        $proposals = mcProposals::paginate( 15 );

        return view( 'proposals', ['proposals' => $proposals] );
    }

    public function postProposals( Request $request )
    {
        $this->validate( $request, [ 'proposal' => 'max:255'] );

        $proposal = new mcProposals();
        $proposal->text = $request->input( 'proposal' );
        $proposal->save();
        return redirect()->route( 'proposal' );
    }

    public function sendMessage( $id, $message )
    {
        //*https://api.vk.com/method/messages.send?user_id=6269901&message=habrahabr&v=5.37&access_token=000000*/
        //token - 96b974f939195cfd6660abb4073b43f8d3fb41529ffe9b287137953a776a52e36b5e4ee089027548c4842
        $settings = mcSettings::first();

        $response = Curl::to('https://api.vk.com/method/messages.send')
                ->withData([
                    /*'domain' => 'volosenkov',*/
                    'user_id' => $id,
                    'message' => $message,
                    'random_id' => rand( 0, 255 ),
                    'v' => '5.52',
                    'access_token' => $settings->access_token/*'96b974f939195cfd6660abb4073b43f8d3fb41529ffe9b287137953a776a52e36b5e4ee089027548c4842'*/
                ])->post();

        $response = json_decode( $response );

        if ( isset( $response->error ) )
        {
            return false;
        }

        return true;
    }
}
