<?php namespace Controllers\Account;

use AuthorizedController;
use Input;
use Lang;
use Want;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;
use Session;
use Hybrid_Auth;
use URL;

class WantsController extends AuthorizedController {


	/**
	 * want want create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		// Show the page
		return View::make('frontend/account/wants/create');
	}

	/**
	 * want want create form processing.
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

		// Create a new want want
		$want = new Want;

		// Update the want want data
		$want->content          = e(Input::get('content'));
		$want->title            = e(Str::limit($want->content, 50));
		$want->slug             = e(Str::slug(rand(10, 999).'-'.$want->title));
		$want->meta_title       = e($want->title);
		$want->meta_description = e(Str::limit($want->content, 150));
		$want->meta_keywords    = str_replace(' ', ',', $want->title);
		$want->user_id          = Sentry::getId();

		$updstatus = e(Input::get('updstatus'));
		$user = Sentry::getUser();
		
		// Was the want want created?		
		if($want->save())
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
				$longUrl = URL::to("/").'/want/'.$want->slug;
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
						"message" => "I want " . $want->title. ' Read more '. $json->id,
						"picture" => "http://canyoudo.ca/public/assets/img/canyoudologo.png",
						"link"    => $longUrl,
						"name"    => "Can You Do It?",
						"caption" => "I want ". Str::limit($want->content, 90). ' Read more '.$json->id
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
					//try catch							
						$adapter->setUserStatus('I #want '. Str::limit($want->content, 90). ' Read more '. $json->id);
						
					}//if
				}//else
			
			}// if not empty provider
			// Redirect to the new want want page
			//return;
			return Redirect::to("/")->with('success', Lang::get('admin/wants/message.create.success'));
		}

		// Redirect to the want want create page
		return Redirect::to('/')->with('error', Lang::get('admin/wants/message.create.error'));
		
	}


}
