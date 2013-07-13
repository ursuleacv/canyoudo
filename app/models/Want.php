<?php

class Want extends Eloquent {


	/**
	 * The date fields for the model.
	 *
	 * @var array
	 */
	protected $dates = array(
		'created_at',
		'updated_at',
	);

	/**
	 * Deletes a want want and all the associated comments.
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the comments
		$this->comments()->delete();

		// Delete the want want
		return parent::delete();
	}

	/**
	 * Returns a formatted want content entry, this ensures that
	 * line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->content);
	}

	/**
	 * Return the want's author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/**
	 * Return how many comments this want has.
	 *
	 * @return array
	 */
	public function comments()
	{
		return $this->hasMany('WantComment');
	}

	/**
	 * Return the URL to the want.
	 *
	 * @return string
	 */
	public function url()
	{
		return URL::route('view-want', $this->slug);
	}

	/**
	 * Return the want thumbnail image url.
	 *
	 * @return string
	 */
	public function thumbnail()
	{
		# you should save the image url on the database
		# and return that url here.

		return 'http://lorempixel.com/130/90/business/';
	}

	public function userscan()
	{
		return $this->hasMany('UserCan','want_id');
	}

	
}
