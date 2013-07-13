<?php
Class UserCan extends Eloquent{

	protected $table ='users_can';
	/**
	 * The date fields for the model.
	 *
	 * @var array
	 */
	protected $dates = array(
		'updated_at',
		'created_at',
	);
	/**
	 * Get the comment's author.
	 *
	 * @return User
	 */
	public function getUser()
	{
		return $this->belongsTo('User', 'user_id');
	}
}