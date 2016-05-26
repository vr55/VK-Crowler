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
}
