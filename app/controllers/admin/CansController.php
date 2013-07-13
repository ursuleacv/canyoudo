<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use Can;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;

class CansController extends AdminController {

	/**
	 * Show a list of all the can cans.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Grab all the can cans
		$cans = Can::orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
		return View::make('backend/cans/index', compact('cans'));
	}

	/**
	 * can can create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		// Show the page
		return View::make('backend/cans/create');
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

		// Create a new can can
		$can = new can;

		// Update the can can data
		$can->title            = e(Input::get('title'));
		$can->slug             = e(Str::slug(Input::get('title')));
		$can->content          = e(Input::get('content'));
		$can->meta_title       = e(Input::get('meta-title'));
		$can->meta_description = e(Input::get('meta-description'));
		$can->meta_keywords    = e(Input::get('meta-keywords'));
		$can->user_id          = Sentry::getId();

		// Was the can can created?
		if($can->save())
		{
			// Redirect to the new can can page
			return Redirect::to("admin/cans/$can->id/edit")->with('success', Lang::get('admin/cans/message.create.success'));
		}

		// Redirect to the can can create page
		return Redirect::to('admin/cans/create')->with('error', Lang::get('admin/cans/message.create.error'));
	}

	/**
	 * can can update.
	 *
	 * @param  int  $canId
	 * @return View
	 */
	public function getEdit($canId = null)
	{
		// Check if the can can exists
		if (is_null($can = can::find($canId)))
		{
			// Redirect to the cans management page
			return Redirect::to('admin/cans')->with('error', Lang::get('admin/cans/message.does_not_exist'));
		}

		// Show the page
		return View::make('backend/cans/edit', compact('can'));
	}

	/**
	 * can can update form processing page.
	 *
	 * @param  int  $canId
	 * @return Redirect
	 */
	public function postEdit($canId = null)
	{
		// Check if the can can exists
		if (is_null($can = can::find($canId)))
		{
			// Redirect to the cans management page
			return Redirect::to('admin/cans')->with('error', Lang::get('admin/cans/message.does_not_exist'));
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

		// Update the can can data
		$can->title            = e(Input::get('title'));
		$can->slug             = e(Str::slug(Input::get('title')));
		$can->content          = e(Input::get('content'));
		$can->meta_title       = e(Input::get('meta-title'));
		$can->meta_description = e(Input::get('meta-description'));
		$can->meta_keywords    = e(Input::get('meta-keywords'));

		// Was the can can updated?
		if($can->save())
		{
			// Redirect to the new can can page
			return Redirect::to("admin/cans/$canId/edit")->with('success', Lang::get('admin/cans/message.update.success'));
		}

		// Redirect to the cans can management page
		return Redirect::to("admin/cans/$canId/edit")->with('error', Lang::get('admin/cans/message.update.error'));
	}

	/**
	 * Delete the given can can.
	 *
	 * @param  int  $canId
	 * @return Redirect
	 */
	public function getDelete($canId)
	{
		// Check if the can can exists
		if (is_null($can = can::find($canId)))
		{
			// Redirect to the cans management page
			return Redirect::to('admin/cans')->with('error', Lang::get('admin/cans/message.not_found'));
		}

		// Delete the can can
		$can->delete();

		// Redirect to the can cans management page
		return Redirect::to('admin/cans')->with('success', Lang::get('admin/cans/message.delete.success'));
	}

}
