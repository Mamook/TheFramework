<?php /* public/webSupport/index.php */

ob_start(); # Begin output buffering

try
{
	# Define the location of this page.
	define('HERE_PATH', 'webSupport/index.php');
	/*
	** In settings we
	** define application settings
	** define system settings
	** start a new session
	** connect to the Database
	*/
	require_once '../../settings.php';
	# Get the FormGenerator Class.
	require_once MODULES.'Form'.DS.'FormGenerator.php';
	# Get the EmailFormProcessor Class.
	require_once MODULES.'Form'.DS.'EmailFormProcessor.php';

	# Get the email form default values.
	require TEMPLATES.'forms'.DS.'email_form_defaults.php';

	# Create display variables.
	$display_main1='';
	$display_main2='';
	$display_main3='';
	$display_box1a='';
	$display_box1b='';
	$display_box1c='';
	$display_box2='';

	$address='';
	$display='';
	$good_url=APPLICATION_URL.WebUtility::removeIndex(HERE).'?success';
	$bad_url=APPLICATION_URL.WebUtility::removeIndex(HERE).'?mail_error';
	$head='<p>If you are having trouble with the website, please use the form below and send us an email!</p>';
	$recipients='webmaster';

	if(isset($_GET['success']))
	{
		$doc->setError('Thank you for helping make '.DOMAIN_NAME.' better. Your message has been sent to the webmaster. They will look into your case as soon as they can.');
	}
	if(isset($_GET['mail_error']))
	{
		$doc->setError('<h3>There was an error sending you\'re email...</h3>
		Please make sure you entered your name and a valid email address. If it still isn\'t working, rest assured that the webmaster has received an email and will work out the issue as soon as possible. You may try again later. Thanks.');
	}

	# Instantiate a new FormProcessor object.
	$fp=new EmailFormProcessor();
	$fp->setFormAction(APPLICATION_URL.WebUtility::removeIndex(HERE));
	$fp->setUpload(FALSE);

	# Get the form mail template.
	require TEMPLATES.'forms'.DS.'email_form.php';

	# Get the page title and subtitle to display in main-1.
	$display_main1=$main_content->displayTitles();

	# Get the main content to display in main-2. The "image_link" variable is defined in data/init.php.
	$display_main2=$main_content->displayContent($image_link);
	# Add any display content to main-2.
	$display_main2.=$display;

	# Get the quote text to display in main-3.
	$display_main3=$main_content->displayQuote();

	# Get the web support navigation template.
	require TEMPLATES.'webSupport_nav.php';
	# Set the "websupport_nav" variable from the webSupport_nav template to the display_box2 variable for display in the view.
	$display_box2=$websupport_nav;

	/*
	** In the page template we
	** get the header
	** get the masthead
	** get the subnavbar
	** get the navbar
	** get the page view
	** get the quick registration box
	** get the footer
	*/
	require TEMPLATES.'page.php';
}
catch(Exception $e)
{
	$exception=new ExceptionHandler($e->getCode(),$e->getMessage(),$e->getFile(),$e->getLine(),$e->getTrace());
}

ob_flush(); # Send the buffer to the user's browser.