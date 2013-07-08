<?php

class CanController extends BaseController {

	/**
	 * Returns all the can cans.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Get all the can cans
		$cans = Can::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('created_at', 'DESC')->paginate();

		// Show the page
		return View::make('frontend/can/index', compact('cans'));
	}

	/**
	 * View a can can.
	 *
	 * @param  string  $slug
	 * @return View
	 * @throws NotFoundHttpException
	 */
	public function getView($slug)
	{
		// Get this can can data
		$can = Can::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
			'comments',
		))->where('slug', $slug)->first();

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

		// Show the page
		return View::make('frontend/can/view-can', compact('can', 'comments'));
	}

	/**
	 * View a can can.
	 *
	 * @param  string  $slug
	 * @return Redirect
	 */
	public function canView($slug)
	{
		// The user needs to be logged in, make that check please
		if ( ! Sentry::check())
		{
			return Redirect::to("can/$slug#comments")->with('error', 'You need to be logged in to can comments!');
		}

		// Get this can can data
		$can = Can::where('slug', $slug)->first();

		// Declare the rules for the form validation
		$rules = array(
			'comment' => 'required|min:3',
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now
		if ($validator->fails())
		{
			// Redirect to this can can page
			return Redirect::to("can/$slug#comments")->withInput()->withErrors($validator);
		}

		// Save the comment
		$comment = new CanComment;
		$comment->user_id = Sentry::getUser()->id;
		$comment->content = e(Input::get('comment'));

		// Was the comment saved with success?
		if($can->comments()->save($comment))
		{
			// Redirect to this can can page
			return Redirect::to("can/$slug#comments")->with('success', 'Your comment was successfully added.');
		}

		// Redirect to this can can page
		return Redirect::to("can/$slug#comments")->with('error', 'There was a problem adding your comment, please try again.');
	}

}
