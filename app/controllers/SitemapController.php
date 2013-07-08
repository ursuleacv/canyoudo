<?php

class SitemapController extends BaseController {

	/**
	 * Returns all the can cans.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// creating rss feed with our most recent 20 posts
        $cans = Can::orderBy('created_at', 'DESC')->get();
        $wants = Want::orderBy('created_at', 'DESC')->get();
        $users = User::orderBy('created_at', 'DESC')->get();

        $sitemap = App::make("sitemap");

    // set item's url, date, priority, freq
        $sitemap->add(URL::to('/'), date("Y-m-d H:i:s", time()), '1.0', 'daily');
        $sitemap->add(URL::to('about-us'), date("Y-m-d H:i:s", time()), '0.9', 'monthly');


        foreach ($cans as $can)
        {
            $sitemap->add(URL::to('can/'.$can->slug), $can->updated_at, '0.9', 'daily');
        }

        foreach ($wants as $want)
        {
            $sitemap->add(URL::to('want/'.$want->slug), $want->updated_at, '0.9', 'daily');
        }

        foreach ($users as $user)
        {
            $sitemap->add(URL::to('user/'.$user->id), $user->updated_at, '0.9', 'daily');
        }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }
}
