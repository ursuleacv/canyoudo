<?php

class Can extends Eloquent {

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
	 * Deletes a want post and all the associated comments.
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the comments
		$this->comments()->delete();

		// Delete the want post
		return parent::delete();
	}

	/**
	 * Returns a formatted post content entry, this ensures that
	 * line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->content);
	}

	/**
	 * Return the post's author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/**
	 * Return how many comments this post has.
	 *
	 * @return array
	 */
	public function comments()
	{
		return $this->hasMany('CanComment');
	}

	/**
	 * Return the URL to the post.
	 *
	 * @return string
	 */
	public function url()
	{
		return URL::route('view-can', $this->slug);
	}

	/**
	 * Return the post thumbnail image url.
	 *
	 * @return string
	 */
	public function thumbnail()
	{
		# you should save the image url on the database
		# and return that url here.

		return 'http://lorempixel.com/130/90/business/';
	}

	public function userswant()
	{
		return $this->hasMany('UserWant','can_id');
	}

	
}
