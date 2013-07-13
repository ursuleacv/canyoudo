<?php

class HomeController extends BaseController {

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
		))->orderBy('created_at', 'DESC')->paginate(5);
		
		// Get all the cans
		$cans = Can::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('created_at', 'DESC')->paginate(5);
		$totalwants = count(Want::all());
		$totalcans = count(Can::all());
		// Show the page
		return View::make('frontend/home/index', compact('wants','cans','totalwants','totalcans'));
	}
}