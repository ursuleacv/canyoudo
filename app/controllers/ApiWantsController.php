<?php

class ApiWantsController extends BaseController {

	public function __construct()
	{
		//$this->beforeFilter('api.auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Want::all();

		return Response::json(array(
        'error' => false,
        'articles' => $articles->toArray()),
        200
    	);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$article = new Article;
		$article->user_id = Auth::user()->id;
		$article->title = Request::get('title');
		$article->content = Request::get('content');

		$article->save();

		return Response::json(array(
        'error' => false,
        'articles' => $article->toArray()),
        200
    	);
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$article = Want::find($id);

		return Response::json(array(
        'error' => false,
        'articles' => $article->toArray()),
        200
    	);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		// Find article
		$article = Want::find($id);

		return Response::json(array(
        'error' => false,
        'articles' => $article->toArray()),
        200
    	);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$article = Want::find($id);

		return Response::json(array(
        'error' => false,
        'articles' => $article->toArray()),
        200
    	);
	}

}