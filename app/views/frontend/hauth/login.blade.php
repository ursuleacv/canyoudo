<?php
	// access user profile data
		echo "Connected with: <b>{$provider->id}</b><br />";
		echo "As: <b>{$userProfile->displayName}</b><br />";
		echo "<pre>" . print_r( $userProfile, true ) . "</pre><br />";
		echo "<pre>" . print_r( $userExists, true ) . "</pre><br />";
	
