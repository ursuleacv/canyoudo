<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
		@section('title')
		Can You Do It?
		@show
		</title>
<meta name="google-site-verification" content="7vzZQEbVDEPIdxKSr-jk2B-93NRqQW5OzGvnXZgZaYs" />
		@section('author')
<meta name="author" content="I want, I can" />
		@show
		@section('meta_description')
<meta name="description" content="Tell us about your wishes and find somebody who can realize them. Or tell us about your capabilities and help someone who wants!" />
		@show
		@section('meta_keywords')
<meta name="keywords" content="I want, can you do it, I wish, I can do it, make, do, realize, desire" />
		@show
		
		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/bootstrap-responsive.min.css') }}" rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/zocial.css') }}" />
		<link href='http://fonts.googleapis.com/css?family=Pompiere' rel='stylesheet' type='text/css'>
		
		<style>
		@section('styles')
		body {
			padding: 10px 0;
		}
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js" async></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}">
		<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.png') }}">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41781134-1', 'canyoudo.ca');
  ga('send', 'pageview');

</script>
	</head>

	<body>
		<!-- Container -->
		<div class="container">
			<div class="head">
            	<div class="row-fluid">
                	<div class="span12">

                    	<div class="span6">
                        	<h1 class="muted"><a href="http://canyoudo.ca" class="muted" style="text-decoration:none;">Can You Do it? </a></h1>
                        </div>
                        <div class="span2 pull-right" style="margin-top:10px;">
                        	
                        	<div class="span4 pull-right"> 
                        		<a href="{{ URL::to('feed') }}" class="pull-right"><img src="{{ asset('assets/ico/feed-icon.png')}}" width= "48"></a>
                        		
                        	</div>
                        		
                        	
                        </div>
                    </div>
                </div>				
			</div>
			<!-- Navbar -->
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>

						<div class="nav-collapse collapse">
							<ul class="nav">
								<li {{ (Request::is('/') ? 'class="active"' : '') }}><a href="{{ route('home') }}"><i class="icon-home icon-black"></i> Home</a></li>
								<li {{ (Request::is('about-us') ? 'class="active"' : '') }}><a href="{{ URL::to('about-us') }}"><i class="icon-file icon-black"></i> How it works</a></li>
								<li {{ (Request::is('contact-us') ? 'class="active"' : '') }}><a href="{{ URL::to('contact-us') }}"><i class="icon-file icon-black"></i> Contact us</a></li>
							</ul>

							<ul class="nav pull-right">
								@if (Sentry::check())
								@if (Session::get('provider'))
								<li><i  class="zocial icon {{ Session::get('provider') }}" style="margin-top:4px; margin-right:4px;"></i></li>
								@endif
								<li class="dropdown{{ (Request::is('account*') ? ' active' : '') }}">
									<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="{{ route('account') }}">										
										Welcome, {{ Sentry::getUser()->first_name }}
										<b class="caret"></b>
									</a>

									<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
										@if(Sentry::getUser()->hasAccess('admin'))
										<li><a href="{{ route('admin') }}"><i class="icon-cog"></i> Administration</a></li>
										@endif
										<li{{ (Request::is('account/profile') ? ' class="active"' : '') }}><a href="{{ route('profile') }}"><i class="icon-user"></i> Your profile</a></li>
										<li class="divider"></li>
										<li><a href="{{ route('logout') }}"><i class="icon-off"></i> Logout</a></li>
									</ul>
								</li>
								
								<li><a href="{{ route('create/want') }}"  style="color:red"><strong>Add I Want</strong></a></li>
								<li> &nbsp; </li>
								<li><a href="{{ route('create/can') }}"  style="color:blue"><strong>Add I can</strong></a></li>
							
								@else
								<li {{ (Request::is('auth/signin') ? 'class="active"' : '') }}><a href="{{ route('signin') }}">Sign in</a></li>
								<li {{ (Request::is('auth/signup') ? 'class="active"' : '') }}><a href="{{ route('signup') }}">Sign up</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- Notifications -->
			@include('frontend/notifications')

			<!-- Content -->
			@yield('content')

			<hr />

			<!-- Footer -->
			<footer>
				<p>&copy; Can You Do it? {{ date('Y') }} | <a href="http://canyoudo.ca">http://canyoudo.ca</a> was crafted by <a href="https://sites.google.com/site/ursuleacv/" target="_blank">Valentin Ursuleac</a> | Built with <a href="http://laravel.com" target="_blank" title="laravel php framework"><img src="http://bootsnipp.com/img/laravel.jpg" alt="laravel php framework"></a> Hosted on <a href="http://appfog.com" target="_blank" title="Appfog cloud hosting">Appfog cloud hosting </a>

				</p>
				
			</footer>
		</div>

		<!-- Javascripts
		================================================== -->
		<script src="{{ asset('assets/js/jquery.v1.9.1.min.js') }}" async></script>
		<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}" async></script>
	</body>
</html>
