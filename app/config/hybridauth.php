<?php
return array(	
	"base_url"   => "http://canyoudo.ca/social/auth",
	"providers"  => array (
		"google"     => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "1051319998905.apps.googleusercontent.com", "secret" => "xwlLSKnf3ldgLf3damxF4TQo" ),
			),
		"facebook"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "344475255680974", "secret" => "1a7d7d9668ee2d751acec9416f1278c4" ),
			"scope" 	=> "email",
			),
		"twitter"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "5U39rFP42SZ8sIicRXHvw", "secret" => "JQDxI8voWZeEwmPM5XLxjtzXIfmBhiuTthnMnmeohI" ),
			"scope" 	=> "email",
			"display" => "popup", // optional
			),
		"LinkedIn"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "wjvt2e3kxuys", "secret" => "sySpE4h8rgwMBsJV" )
			)
	),
);