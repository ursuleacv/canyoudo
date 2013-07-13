<?php 

class UserController extends BaseController {

	/**
	 * User update.
	 *
	 * @param  int  $id
	 * @return View
	 */
	public function getUser($id = null)
	{
		// Get the user information
		//$user = User::find($id);
		$user = Sentry::getUserProvider()->findById($id);
		// Get this want want data
		// Get all the can cans
		$wants = Want::with(array(
			'author'
		))->orderBy('created_at', 'DESC')->where('user_id','=',$user->id)->paginate();

		$cans = Can::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('created_at', 'DESC')->where('user_id','=',$user->id)->paginate();

		// Show the page
		return View::make('frontend/account/user', compact('user','wants','cans'));
	}

	

}
