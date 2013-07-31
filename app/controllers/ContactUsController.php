<?php

class ContactUsController extends BaseController {

	/**
	 * Contact us page.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		return View::make('frontend/contact-us');
	}

	/**
	 * Contact us form processing page.
	 *
	 * @return Redirect
	 */
	public function postIndex()
	{
		// Declare the rules for the form validation
		$rules = array(
			'name'        => 'required',
			'email'       => 'required|email',
			'description' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			return Redirect::route('contact-us')->withErrors($validator);
		}
		
		// to do sending the message to email
		DB::table('messages')->insert(
  		  	array(
  		  		'name' =>  Input::get('name'),
  		  		'email' => Input::get('email'),
  		  		'description' => Input::get('description'),
  		  		'created_at' => date('Y-m-d H:i:s')
  		  	));

		return Redirect::route('contact-us')->with('success', 'The message has been sent successfully');
	}

	public function postEmail()
	{
		// Declare the rules for the form validation
		$rules = array(			
			'email'       => 'required|email'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			return Redirect::to('/')->withErrors($validator);
		}

		DB::table('landing')->insert(
  		  array('email' => Input::get('email'))
		);
		return Redirect::to('/')->with('success', 'The email address has been sent successfully. We will let you know when you can try the beta version. Thank You!');
	}

}
