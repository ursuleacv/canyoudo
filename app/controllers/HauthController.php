<?php

class HauthController extends BaseController {

	/**
	 * Account sign in.
	 *
	 * @return View
	 */
	public function getSignin($action=null)
	{
		
		// Is the user logged in?
		if (Sentry::check())
		{
			return Redirect::route('account');
		}
		
		// check URL segment
		if ($action == "auth") {
			// process authentication
			try {
				Hybrid_Endpoint::process();
			}
			catch (Exception $e) {
			// redirect back to http://URL/social/
				return Redirect::route('hybridauth');
			}
			return;
		}
		
		try {
			// create a HybridAuth object
			$socialAuth = new Hybrid_Auth(__DIR__ . '/../config/hybridauth.php');
			// authenticate with Facebook
			$provider = $socialAuth->authenticate($action);
			// fetch user profile
			$userProfile = $provider->getUserProfile();
			
			Session::put('provider',strtolower($provider->id));
			//Hybrid_Auth::logoutAllProviders();
			//$provider->logout();
			//check if user exists
			
			$userExists = User::where('identifier', '=', $userProfile->identifier)->first();
			//search user by email
			$userExists = User::where('email', '=', $userProfile->email)->first();
			if($userExists){
				// Try to log the user in
				Sentry::login($userExists,false);

				// Get the page we were before
				$redirect = Session::get('loginRedirect', 'account');

				// Unset the page we were before from the session
				Session::forget('loginRedirect');

				// Redirect to the users page
				return Redirect::to($redirect)->with('success', Lang::get('auth/message.signin.success'));
			}
			//search user by social network identifier
			$userExists = User::where('identifier', '=', $userProfile->identifier)->first();
			if($userExists){
				// Try to log the user in
				Sentry::login($userExists,false);

				// Get the page we were before
				$redirect = Session::get('loginRedirect', 'account');

				// Unset the page we were before from the session
				Session::forget('loginRedirect');

				// Redirect to the users page
				return Redirect::to($redirect)->with('success', Lang::get('auth/message.signin.success'));
			} else {
				try	{
					
					if(empty($userProfile->email)) {
						
						$userProfile->email = $userProfile->identifier;
					}
					// Register the user
					$user = Sentry::register(array(
						'first_name' => $userProfile->firstName,
						'last_name'  => $userProfile->lastName,
						'email'      => $userProfile->email,
						'password'   => substr(md5(rand()), 0, 8),
						'activated'  => 1,
						'identifier' => $userProfile->identifier,
						'profileURL' => $userProfile->profileURL,
						'network'    => $action,
						'website'    => $userProfile->webSiteURL,
						'gravatar' 	 => $userProfile->photoURL,
						));

					Sentry::login($user,false);

					// Get the page we were before
					$redirect = Session::get('loginRedirect', 'account');

					// Unset the page we were before from the session
					Session::forget('loginRedirect');

					// Redirect to the users page
					return Redirect::to($redirect)->with('success', Lang::get('auth/message.signin.success'));

				}
				catch (Cartalyst\Sentry\Users\UserExistsException $e)
				{
					$this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
				}

					// Ooops.. something went wrong
				//return $e->getMessage();
				//return Redirect::back()->withErrors($this->messageBag);
				//return Redirect::to('auth/signup')->withErrors($this->messageBag);
			}
		}
		catch( Exception $e ){
			// Display the recived error
			switch( $e->getCode() ){ 
				case 0 : $error = "Unspecified error."; break;
				case 1 : $error = "Hybriauth configuration error."; break;
				case 2 : $error = "Provider not properly configured."; break;
				case 3 : $error = "Unknown or disabled provider."; break;
				case 4 : $error = "Missing provider application credentials."; break;
				case 5 : $error = "Authentication failed. The user has canceled the authentication or the provider refused the connection."; break;
				case 6 : $error = "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again."; 
				$adapter->logout(); 
				break;
				case 7 : $error = "User not connected to the provider."; 
				$adapter->logout(); 
				break;
			} 

			// well, basically your should not display this to the end user, just give him a hint and move on..
			$error .= "<br /><br /><b>Original error message:</b> " . $e->getMessage(); 
			$error .= "<hr /><pre>Trace:<br />" . $e->getTraceAsString() . "</pre>"; 

			return $error;
		}

		// logout
		$provider->logout();

		// Show the page
		return View::make('frontend.hauth.login', compact('userProfile','provider','userExists'));
	}


}
