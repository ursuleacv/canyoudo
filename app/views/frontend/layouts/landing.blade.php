<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
		@section('title')
		I want I can - tell the world what you can do or what you want from somebody
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
<meta name="keywords" content="I want, can you do it, I wish, I can do it, make, to do, realize, desire, help" />
		@show
		
		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/bootstrap-responsive.min.css') }}" rel="stylesheet">

		<link rel="stylesheet" href="{{ asset('assets/css/zocial.css') }}" >
		<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
		<link id="change" href="{{ asset('assets/css/style-responsive-red.css') }}" rel="stylesheet">
    
    <!-- Google Web Font-->
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
    <!--[if IE 7]><link rel="stylesheet" href="assets/css/font-awesome-ie7.css"><![endif]-->
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
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
	 <!-- Notifications -->
      @include('frontend/notifications')

	<div class="container">
      <div class="row" id="header">
      	<div class="span12">

       	 <h1><a href="#" > <img src="assets/img/canyoudologo.png" width="86" style="position:relative; float:left"> <span id="it">I want </span><span id="beta">I can</span></a></h1>
        </div><!--end span12-->        
      </div><!--end row-->
      
      <div class="row" id="catchycontent">
      	<div class="span12">
        <h2>Stay tuned, we are launching very soon... </h2>        
        <p>Accomplish the dreams and help others. Share your wishes and find somebody who can realize them. Or tell people about your capabilities and help someone who wants what you can do!</p>
        </div><!--end span12-->            
      </div><!--end row-->
      
      <div class="row" id="subscribe">
      
      	<div id="mc_embed_signup">
            
            <form method="post" action="landing" class="validate form-inline">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="email" value="" name="email" class="span4 input-large email" id="mce-EMAIL" placeholder="email address" required>
            <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-success btn-large">
        </form>
        </div>
      </div><!--end row-->
      
      <div class="row" id="features">
      	<div class="span3 divider">
        	<div class="featureicon"><i class="icon-user"></i></div>
            <h3>Register for free </h3>
            <p>You can register filling out a form or through social media in one click </p>
        </div>        
        <div class="span3 divider">
        	<div class="featureicon"><i class="icon-share"></i></div>
            <h3>Share your wishes</h3>
            <p>The right people will help you and make your wishes come true.</p>
        </div>       
        <div class="span3 divider">
        	<div class="featureicon"><i class="icon-group"></i></div>
            <h3>Help others</h3>
            <p>Tell people what you can do for them and help someone who wants, what you can do</p>
        </div>
         <div class="span3">
        	<div class="featureicon"><i class="icon-gift"></i></div>
            <h3>You decide</h3>
            <p>Give thanks for the execution of your wishes, saying "Thank you", give a real gift or a payment.</p>
        </div>
      </div><!--end row-->
      
      <div class="row" id="footer">
      <h4>For more details regarding our launch <br/>follow us on Facebook, Google plus and Twitter</h4>
      <div class="footericon">
        <a href="https://twitter.com/IcanIwant"><i class="icon-twitter-sign"></i></a>
        <a href="https://plus.google.com/100291871629614592993/"><i class="icon-google-plus-sign"></i></a>
        <a href="https://www.facebook.com/IWantbutYouCan"><i class="icon-facebook-sign"></i></a>
      </div>
      <p>&copy; Can you do {{ date('Y') }}. All rights reserved.</p>
      </div><!--end row-->      
      </div><!--end container-->    
       <!-- Javascripts
		================================================== -->
      
      <script src="{{ asset('assets/js/respond.js') }}" async></script>
      <script src="{{ asset('assets/js/jquery.v1.9.1.min.js') }}" async></script>
	  
  </body>
</html>			

		<!-- Javascripts
		================================================== -->
		
	</body>
</html>
