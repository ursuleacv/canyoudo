<?php

class WantController extends BaseController {

	/**
	 * Returns all the want wants.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Get all the wants
		$wants = Want::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('created_at', 'DESC')->paginate(10);
		
		// Show the page
		return View::make('frontend/want/index', compact('wants'));
	}

	/**
	 * View a want want.
	 *
	 * @param  string  $slug
	 * @return View
	 * @throws NotFoundHttpException
	 */
	public function getView($slug)
	{
		// Get this want want data
		$want = Want::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
			'comments',
		))->where('slug', $slug)->first();

		// Check if the want want exists
		if (is_null($want))
		{
			// If we ended up in here, it means that a page or a want want
			// don't exist. So, this means that it is time for 404 error page.
			return App::abort(404);
		}

		// Get this want comments
		$comments = $want->comments()->with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('created_at', 'DESC')->get();

		// Show the page
		return View::make('frontend/want/view-want', compact('want', 'comments'));
	}

	/**
	 * View a want want.
	 *
	 * @param  string  $slug
	 * @return Redirect
	 */
	public function wantView($slug)
	{
		// The user needs to be logged in, make that check please
		if ( ! Sentry::check())
		{
			return Redirect::to("want/$slug#comments")->with('error', 'You need to be logged in to want comments!');
		}

		// Get this want want data
		$want = Want::where('slug', $slug)->first();

		// Declare the rules for the form validation
		$rules = array(
			'comment' => 'required|min:3',
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now
		if ($validator->fails())
		{
			// Redirect to this want want page
			return Redirect::to("want/$slug#comments")->withInput()->withErrors($validator);
		}

		// Save the comment
		$comment = new WantComment;
		$comment->user_id = Sentry::getUser()->id;
		$comment->content = e(Input::get('comment'));

		// Was the comment saved with success?
		if($want->comments()->save($comment))
		{
			// Redirect to this want want page
			return Redirect::to("want/$slug#comments")->with('success', 'Your comment was successfully added.');
		}

		// Redirect to this want want page
		return Redirect::to("want/$slug#comments")->with('error', 'There was a problem adding your comment, please try again.');
	}

}
