<?php

	namespace KobiLab\Http\Controllers\Auth;

	use Illuminate\Routing\Controller;

	use KobiLab\ProductionOrders;
	use Illuminate\Support\Facades\Input;
	use Illuminate\Support\Facades\Session;
	use KobiLab\Users;

	class AuthController extends Controller
	{
		/**
		 * İtemleri listelemeye yarayan method
		 * 
		 * @return view
		 */
		public function login()
		{
			return view('zahmetsizce::auth.login');
		}

		public function doLogin()
		{
			$check = Users::where('username', Input::get('username', ''))->where('password', Input::get('password', ''))->first();

			if($check !== null) {
				Session::put('loggedIn', true);
				Session::put('uId', $check['id']);

				return redirectTo('homePage');
			} else {
				return redirectTo('login');
			}
		}

		public function logout()
		{
			Session::forget('uId');
			Session::put('loggedIn', false);

			return redirectTo('login');
		}

	}
