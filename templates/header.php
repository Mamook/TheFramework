<?php /* templates/header.php */

# Define the DOCTYPE. This site is using html5
$header='<!DOCTYPE html>'."\n";

# Open the html tag and define the default language.
$header.='<html xmlns="http://www.w3.org/1999/xhtml"
			xmlns:fog="http://www.facebook.com/2008/fbml"
			xmlns:og="http://ogp.me/ns#"
			xml:lang="en" lang="en">';
	# Open the head tag.
	$header.='<head>';
		# The title for each page is filled by a variable set on each page.
		$header.='<title>'.strip_tags($main_content->getPageTitle()).'</title>';
		# Use a custom favicon.
		$header.='<link rel="shortcut icon" type="image/x-icon" href="'.THEME.'images/favicon.ico" />';
		# Define the character set.
		$header.='<meta http-equiv="content-type" content="text/html; charset='.((isset($charset)) ? $charset : 'utf-8').'" />';
		# Define the default language. If the $meta_language variable is not set on the page, it defaults to "english".
		$header.='<meta http-equiv="content-language" content="'.((!isset($meta_language) || empty($meta_language)) ? 'english' : $meta_language).'" />';
		# Give a description of the page. If the $meta_desc variable is not set on the page, use this default.
		$header.='<meta name="description" content="'.((!isset($meta_desc) OR empty($meta_desc)) ? 'The official website of the '.$main_content->getSiteName().'.' : $meta_desc).'" />';
		# Set keywords for the page. If the $meta_keywords variable is not set on the page, we have none.
		$header.=((!isset($meta_keywords) || empty($meta_keywords)) ? '' : '<meta name="keywords" content="'.$meta_keywords.'" />');
		# Define the author of the page. If the $meta_author variable is not set on the page, use this default.
		$header.='<meta name="author" content="'.((!isset($meta_author) OR empty($meta_author)) ? 'BigTalk Jon R&yuml;ser, JonRyser.com &amp; Michael Delle' : $meta_author).'" />';
		# Define the designer of the page. If the $meta_designer variable is not set on the page, use this default.
		$header.='<meta name="designer" content="'.((!isset($meta_designer) OR empty($meta_designer)) ? 'BigTalk Jon R&yuml;ser, JonRyser.com' : $meta_designer).'" />';
		# Define the copyright of the page.
		$header.='<meta name="copyright" content="Copyright &copy; 1994-'.date('Y').' '.$main_content->getSiteName().'" />';
		# Define the page-topic of the page. Use the page title.
		$header.='<meta name="page-topic" content="'.((isset($page_topic)&&!empty($page_topic)) ? $page_topic : strip_tags($main_content->getPageTitle())).'" />';
		# Facebook meta data.
		$header.='<meta property="fog:app_id" content="'.FB_APP_ID.'" />';
		$header.='<meta property="og:url" content="'.WebUtility::removeIndex(COMPLETE_URL).'" />';
		$header.='<meta property="og:type" content="website" />';
		$header.='<meta property="og:title" content="'.strip_tags($main_content->getPageTitle()).'" />';
		$header.='<meta property="og:image" content="'.((isset($og_image)&&!empty($og_image)) ? $og_image : IMAGES.'logo.jpg').'" />';
		$header.='<meta property="og:description" content="'.((!isset($meta_desc) OR empty($meta_desc)) ? 'The official website of the '.$main_content->getSiteName().'.' : $meta_desc).'" />';
		$header.='<meta property="og:locale" content="EN_US" />';
		$header.='<meta property="og:site_name" content="'.$main_content->getSiteName().'" />';

		if(isset($pingback_url) && !empty($pingback_url))
		{
			$header.='<link rel="pingback" href="'.$pingback_url.'" />';
		}
		if(isset($microformat_url) && !empty($microformat_url))
		{
			$header.='<link rel="profile" href="'.$microformat_url.'" />';
		}

		# Add the CSS for the page.
		$header.=$doc->addStyle();
		# Include IE Style Sheets if that is the user's browser.
		$header.=$doc->addIEStyle('ie8,ie7,ie6,ie5mac');

		# Add the JavaScripts for the page.
		$header.=$doc->addJavaScript();
		echo $header;

		# If this function exists, WordPress is active.
		if((WP_INSTALLED===TRUE) && function_exists('wp_head'))
		{
			//comments_popup_script(500, 400);
			# We add some JavaScript to pages with the comment form
			#		to support sites with threaded comments (when in use).
			if(is_singular() && get_option('thread_comments'))
				wp_enqueue_script('comment-reply');
			# Always have wp_head() just before the closing </head>
			#		tag of your theme, or you will break many plugins, which
			#		generally use this hook to add elements to <head> such
			#		as styles, scripts, and meta tags.
			wp_head();
		}

	# Close the head tag.
	$header2='</head>';
	$header2.='<body>';
		$header2.='<div id="distance"></div>';
		$header2.='<div id="wrapper" class="noscript">';
		echo $header2;