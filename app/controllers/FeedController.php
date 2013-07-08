<?php

class FeedController extends BaseController {

	/**
	 * Returns all the can cans.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// creating rss feed with our most recent 20 posts
    $cans = Can::orderBy('created_at', 'DESC')->take(10)->get();
    $wants = Want::orderBy('created_at', 'DESC')->take(10)->get();

    foreach ($cans as $can)
    {
        $can->title = $can->author->first_name.' can '. $can->title;
        $can->slug = 'can/'. $can->slug;
        $can->content = $can->author->first_name.' can '. $can->content;
    }
    foreach ($wants as $want)
    {
        $want->title = $want->author->first_name.' wants '. $want->title;
        $want->slug = 'want/'. $want->slug;
        $want->content = $want->author->first_name.' wants '. $want->content;
    }
    $posts = array();
    if ((count($cans)<=10)||(count($wants)<=10))
    {
        foreach ($cans as $can ) {
            array_push($posts, $can);
        }
        foreach ($wants as $want ) {
            array_push($posts, $want);
        }

    } 
    else
    {
        for ($i=0;$i<10; $i++)
        {
        	if ($cans[$i]->created_at > $wants[$i]->created_at)
        	{
        		array_push($posts, $cans[$i]);
        	} else
        		{    			
        			array_push($posts, $wants[$i]);
        		}
        }
    }
    $feed = App::make("feed");

    // set your feed's title, description, link, pubdate and language
    $feed->title = 'I can, I want';
    $feed->description = 'Tell us about your wishes and find somebody who can realize them. Or tell us about your capabilities and help someone who wants what you can do! Accomplish the dreams and help others.';
    $feed->link = URL::to('feed');
    $feed->pubdate = date("Y-m-d H:i:s", time());
    $feed->lang = 'en';
    
    foreach ($posts as $post)
    {
	   // set item's title, author, url, pubdate and description
	   $feed->add($post->title, $post->author->fullName(), URL::to($post->slug), $post->created_at, $post->content);
    }

    // show your feed (options: 'atom' (recommended) or 'rss')
    return $feed->render('atom');
	}

	
}
