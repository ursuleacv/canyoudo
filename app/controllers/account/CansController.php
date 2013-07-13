<?php namespace Controllers\Account;

use AuthorizedController;
use Input;
use Lang;
use Can;
use DB;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;
use Session;
use Hybrid_Auth;
use URL;

class CansController extends AuthorizedController {


	/**
	 * can can create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		// Show the page
		return View::make('frontend/account/cans/create');
	}

	/**
	 * can can create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'content' => 'required|min:3',
			);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new can can
		$can = new Can;

		// Update the can can data
		$can->content          = e(Input::get('content'));
		$can->title            = e(Str::limit($can->content, 50));
		$can->slug             = e(Str::slug(rand(10, 999).'-'.$can->title));
		
		$can->meta_title       = e($can->title);
		$can->meta_description = e(Str::limit($can->content, 150));
		$can->meta_keywords    = str_replace(' ', ',', $can->title);
		$can->user_id          = Sentry::getId();

		$updstatus = e(Input::get('updstatus'));
		$user = Sentry::getUser();

		// Was the can can created?
		if($can->save())
		{
			$hybridauth = new Hybrid_Auth(__DIR__ . '/../../config/hybridauth.php');
			$providers  = Hybrid_Auth::getConnectedProviders();
			
			//daca providerul sa deconectat dar userul nu 
			//daca userul sa logat prin email dar provider = empty
			// nu trebuie sa faca logout
			// put in session loged by social
			//if empty prov and loged by social 
			if (!empty($providers))
			{ 
			 //return Redirect::to('auth/logout');

				$adapter = Hybrid_Auth::getAdapter( $providers[0] );

				//Google URL shortener
				$longUrl = URL::to("/").'/can/'.$can->slug;
				$apiKey = 'AIzaSyAR2CnGza1oQVJUtQlcAW-0yJ6O68yp1m4';
				//Get API key from : http://code.google.com/apis/console/

				$postData = array('longUrl' => $longUrl, 'key' => $apiKey);
				$jsonData = json_encode($postData);

				$curlObj = curl_init();

				curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
				curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curlObj, CURLOPT_HEADER, 0);
				curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
				curl_setopt($curlObj, CURLOPT_POST, 1);
				curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

				$response = curl_exec($curlObj);

				//change the response json string to object
				$json = json_decode($response);

				curl_close($curlObj);

				// If user checked to tell friends
				if (($updstatus) &&($adapter->id =='facebook'))
				{


					$adapter->api()->api("/me/feed", "post", array(
						"message" => "I can " . $can->title. ' Read more '. $json->id,
						"picture" => "http://canyoudo.ca/public/assets/img/canyoudologo.png",
						"link"    => $longUrl,
						"name"    => "Do you want?",
						"caption" => "I can ". Str::limit($can->content, 90). ' Read more '.$json->id
						));
				//$provider->logout();
				}
				else
				{
					if (($updstatus) && ($adapter->id=='google'))
					{	
						//Google doesn't support wall posting
						return Redirect::to("/")->with('success', Lang::get('admin/cans/message.create.success'));
					}//if
					if (($updstatus) && ($adapter->id!=''))
					{	
					//try catch	 ?
						$adapter->setUserStatus('I #can '. Str::limit($can->content, 90) . ' Read more '.$json->id);

					}//if
				}//else

			}// if not empty provider

			// Redirect to the new can can page
			return Redirect::to("/")->with('success', Lang::get('admin/cans/message.create.success'));
		}

		// Redirect to the can can create page
		return Redirect::to('/')->with('error', Lang::get('admin/cans/message.create.error'));
	}

	/**
	*	A user clicked IWant 
	*	The user wants a specific Can
	**/
	public function getCan ($can_id)
	{
		
		// Save what the user want
		$user_id = Sentry::getUser()->id;

		//Check if the user and the current want exist
		$UserAndWantExist = DB::table('users_want')// ?? table want
		->where('user_id','=',$user_id)
		->where('can_id','=',$can_id)->get(); // ?? id for can
		
		if (empty($UserAndWantExist)){
			//insert user_id  and can_id in users_want table
			DB::table('users_want')->insert(
				array(
					'user_id' => $user_id, 
					'can_id' => $can_id)
				);
		}	
			// Get this can can data
		$can = Can::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
			'comments'
			))->where('id', $can_id)->first();

			// Check if the can can exists
		if (is_null($can))
		{
				// If we ended up in here, it means that a page or a can can
				// don't exist. So, this means that it is time for 404 error page.
			return App::abort(404);
		}

			// Get this can comments
		$comments = $can->comments()->with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
			))->orderBy('created_at', 'DESC')->get();


			//print_r($userswant);
			// Show the page
		return View::make('frontend/account/cans/view-can', compact('can', 'comments'));
		
	}
}
