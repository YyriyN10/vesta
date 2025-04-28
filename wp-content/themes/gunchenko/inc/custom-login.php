<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * Редирект на головну із site.com/wp-admin
	 */
	add_action( 'init', function () {
		if ( is_admin() && ! current_user_can( 'administrator' ) &&
		     ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			wp_redirect( home_url() );
			exit;
		}
	});

	/**
	 * Редирект на головну із site.com/wp-login.php
	 */
	add_action( 'init', function () {
		$page_viewed = basename( $_SERVER['REQUEST_URI'] );
		if ( $page_viewed == "wp-login.php" ) {
			wp_redirect( home_url() );
			exit;
		}
	});

	/**
	 * Редирект на головну після виходу із системи
	 */
	add_action( 'wp_logout', function () {
		$login_page  = home_url( 'wp-admin' );
		wp_redirect( $login_page . "?loggedout=true" );
		exit;
	});

	add_filter( 'login_headertext', 'yuna_change_login_logo_text' );

	function yuna_change_login_logo_text( $text ) {
		return 'Вєста Гунченко';
	}

	add_action( 'login_head', 'yuna_no_login_logo' );

	function yuna_no_login_logo() {
		echo '<style>
		#login h1 a {
	    background-image: none;
	    text-indent: 0;
	    height: auto;
	    width: auto;
	    color: #599C12;
	    font-size: 34px;
		}
		
		#login form{
			border-radius: 4px;
			border: 2px solid #599C12;
			background-color: #FCFCFC;
			color: #131313;
		}
		
		#login form input{
			background-color: #ffffff;
			border: 1px solid #384438;
			color: #131313;
			font-size: 14px;
			padding-left: 20px;
		}
		
		#login form input::-webkit-input-placeholder {
        color: #5B6583;
      }
      #login form input:-moz-placeholder {
        color: #5B6583;
      }
      #login form input::-moz-placeholder {
        color: #5B6583;
      }
      #login form input:-ms-input-placeholder {
        color: #5B6583;
      }
		
		#login form input:focus{
			border: 1px solid #FDB62C;
			box-shadow: none !important;
			outline: none;
		}
		
		#login form p.submit{
			width: 100%;
			display: flex;
			padding-top: 20px;
			justify-content: center;
		}
		
		#login form p.submit .button{
			display: inline-block;
			padding: 	5px 30px;
			background-color: #599C12;
			font-size: 18px;
			border: 1px solid #599C12;
			width: 100%;
			color: #FCFCFC;
			transition: all 0.5s;
		
			
			&:hover{
				border: 1px solid rgba(255,255,255,0.7);
			}	
		}
		
		#login #nav,
		#login #nav a,
		#backtoblog a{
			color: #384438;
		}
		
		.login #backtoblog a{
			color: #384438;
		}
		
		.login{
			background-color: #F7FDF8;
		}
		
		.language-switcher{
			display: none;
		}
		</style>';
	}

	add_filter( 'login_headerurl', 'yuna_login_link_to_website' );

	function yuna_login_link_to_website( $url ) {
		return site_url();
	}