<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use Want;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;

class WantsController extends AdminController {

	/**
	 * Show a list of all the want wants.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Grab all the want wants
		$wants = Want::orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
		return View::make('backend/wants/index', compact('wants'));
	}

	/**
	 * want want create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		// Show the page
		return View::make('backend/wants/create');
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
			'title'   => 'required|min:3',
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
		$want->title            = e(Input::get('title'));
		$want->slug             = e(Str::slug(Input::get('title')));
		$want->content          = e(Input::get('content'));
		$want->meta_title       = e(Input::get('meta-title'));
		$want->meta_description = e(Input::get('meta-description'));
		$want->meta_keywords    = e(Input::get('meta-keywords'));
		$want->user_id          = Sentry::getId();

		// Was the want want created?
		if($want->save())
		{
			// Redirect to the new want want page
			return Redirect::to("admin/wants/$want->id/edit")->with('success', Lang::get('admin/wants/message.create.success'));
		}

		// Redirect to the want want create page
		return Redirect::to('admin/wants/create')->with('error', Lang::get('admin/wants/message.create.error'));
	}

	/**
	 * want want update.
	 *
	 * @param  int  $wantId
	 * @return View
	 */
	public function getEdit($wantId = null)
	{
		// Check if the want want exists
		if (is_null($want = want::find($wantId)))
		{
			// Redirect to the wants management page
			return Redirect::to('admin/wants')->with('error', Lang::get('admin/wants/message.does_not_exist'));
		}

		// Show the page
		return View::make('backend/wants/edit', compact('want'));
	}

	/**
	 * want want update form processing page.
	 *
	 * @param  int  $wantId
	 * @return Redirect
	 */
	public function postEdit($wantId = null)
	{
		// Check if the want want exists
		if (is_null($want = want::find($wantId)))
		{
			// Redirect to the wants management page
			return Redirect::to('admin/wants')->with('error', Lang::get('admin/wants/message.does_not_exist'));
		}

		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
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

		// Update the want want data
		$want->title            = e(Input::get('title'));
		$want->slug             = e(Str::slug(Input::get('title')));
		$want->content          = e(Input::get('content'));
		$want->meta_title       = e(Input::get('meta-title'));
		$want->meta_description = e(Input::get('meta-description'));
		$want->meta_keywords    = e(Input::get('meta-keywords'));

		// Was the want want updated?
		if($want->save())
		{
			// Redirect to the new want want page
			return Redirect::to("admin/wants/$wantId/edit")->with('success', Lang::get('admin/wants/message.update.success'));
		}

		// Redirect to the wants want management page
		return Redirect::to("admin/wants/$wantId/edit")->with('error', Lang::get('admin/wants/message.update.error'));
	}

	/**
	 * Delete the given want want.
	 *
	 * @param  int  $wantId
	 * @return Redirect
	 */
	public function getDelete($wantId)
	{
		// Check if the want want exists
		if (is_null($want = want::find($wantId)))
		{
			// Redirect to the wants management page
			return Redirect::to('admin/wants')->with('error', Lang::get('admin/wants/message.not_found'));
		}

		// Delete the want want
		$want->delete();

		// Redirect to the want wants management page
		return Redirect::to('admin/wants')->with('success', Lang::get('admin/wants/message.delete.success'));
	}

}
