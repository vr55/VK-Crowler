<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Sentinel;
use Reminder;
use Storage;
use DB;
use Validator;
use Mail;

use App\Http\Modes\mcSettings as mcSettings;

class mcUserController extends mcBaseController
{
    protected $users;
    protected $user;

    public function __construct()
	{
		parent::__construct();

		$this->user = Sentinel::getUser();
		$this->users = Sentinel::getUserRepository();

		//создаем роли для пользователей
		//$role = Sentinel::findRoleByName( 'Administrators' );

		if ( Sentinel::findRoleByName( 'Administrators' ) == null )
		{
			$role = Sentinel::getRoleRepository()->createModel()->create([
    				'name' => 'Administrators',
    				'slug' => 'administrators',
					]);

			$role->permissions = [
		        'user.create' => true,
		        'user.delete' => true,
		        'user.view'   => true,
		        'user.update' => true,
			];

			$role->save();
		}

		if ( Sentinel::findRoleByName( 'Users' ) == null )
		{
			$role = Sentinel::getRoleRepository()->createModel()->create([
    				'name' => 'Users',
    				'slug' => 'users',
					]);

			$role->permissions = [
		        "user.create" => false,
		        "user.delete" => false,
		        "user.view"   => true,
		        "user.update" => false,
			];

			$role->save();
		}

	}

    public function getLogin()
    {
        return view( 'login' );
    }

    public function postLogin( Request $request )
    {
        $this->validate( $request, [
            'uName' => 'required|email',
            'uPassword' => 'required|max:64'
        ]);

    	$credentials = [
    		'email'    => $request->input( 'uName' ),
    		'password' => $request->input( 'uPassword' )
			];

		try
		{
			if ( Sentinel::authenticateAndRemember( $credentials ) )
			{
				$user = Sentinel::check();

//Пользователя с id=1 добавляем в администраторы
				if ( $user->id == 1 )
				{
					if ( !Sentinel::inRole('administrators') )
					{
						$role = Sentinel::findRoleByName( 'Administrators' );
						$role->users()->attach( $user );
					}
				}

                return redirect()->route('home')->with('msg', 'Добро пожаловать' );

			}

            return redirect()->back()->withInput()->with( 'msg', 'Неверное имя пользователя или пароль' );

		}

		catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e)
		{
            return redirect()->back()->withInput()->withErrorMessage('User Not Activated.');
        }

        catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e)
        {
            return redirect()->back()->withInput()->withErrorMessage($e->getMessage());
        }

    	return view( 'home' );
    }

    public function getLogout( Request $request )
    {
        Sentinel::logout();
        return redirect()->route('home');
    }

    public function postRegister( Request $request )
    {
        $settings = mcSettings::firstOrFail();
        if ( isset( $settings->register_deny ) )
            return redirect()->route( 'login' )->with( 'msg', 'Регистрация новых пользователей запрещеена' );
            
        $this->validate( $request, [
                'uName' => 'required|email',
                'uPassword' => 'required',
                'uPasswordConfirm' =>'same:uPassword'
        ]);

        if (  $user = Sentinel::findByCredentials( [ 'email' => $request->input( 'uName' ) ] ) )
        {
            return redirect()->back()->withInput()->with( 'msg', 'Пользователь уже существует' );
        }

        $credentials = [
        'email'    => $request->input( 'uName' ),
        'password' => $request->input( 'uPassword' ),
        ];

        if ( $user = Sentinel::registerAndActivate( $credentials ))
        {
            // Find the role using the role name
            $usersRole = Sentinel::findRoleByName( 'Users' );

            // Assign the role to the users
            $usersRole->users()->attach( $user );

            Sentinel::login( $user );

            return redirect()->route( 'home' );

        }



    }
}
