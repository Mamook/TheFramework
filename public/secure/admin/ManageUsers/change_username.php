<?php /* public/secure/admin/ManageUsers/change_username.php */

ob_start(); # Begin output buffering

try
{
	# Define the location of this page.
	define('HERE_PATH', 'secure/admin/ManageUsers/change_username.php');
	/*
	** In settings we
	** define application settings
	** define system settings
	** start a new session
	** connect to the Database
	*/
	require_once '../../../../settings.php';
	# Get the FormGenerator Class.
	require_once MODULES.'Form'.DS.'FormGenerator.php';
	# Get the FormProcessor Class.
	require_once MODULES.'Form'.DS.'FormProcessor.php';

	# Check if the logged in User is an Admin.
	$login->checkLogin(ADMIN_USERS);

	# Create display variables.
	$display_main1='';
	$display_main2='';
	$display_main3='';
	$display_box1a='';
	$display_box1b='';
	$display_box1c='';
	$display_box2='';

	$display='';

	if(isset($_GET['user']))
	{
		# Create a new User object.
		$user=new User();
		# Set the User ID to the data member; effectively cleaning it.
		$user->setID($_GET['user']);
		$id=$user->getID();
		$current_username=$user->findUsername($id);
		# Instantiate a new FormProcessor object.
		$form_processor=new FormProcessor();
		# Process the username form.
		$form_processor->processUsername($id);

		$username=((isset($_POST['username'])) ? trim(strip_tags($_POST['username'])) : '');
		$checked_value=((isset($_POST['email_username'])) ? 'checked' : '');
		$email_username='Email '.$current_username.' their username';

		# Get the change_username form.
		require TEMPLATES.'forms'.DS.'change_username.php';
	}
	else
	{
		$doc->redirect(ADMIN_URL.'ManageUsers/');
	}

	# Get the page title and subtitle to display in main-1.
	$display_main1=$main_content->displayTitles();

	# Get the main content to display in main-2. The "image_link" variable is defined in data/init.php.
	$display_main2=$main_content->displayContent($image_link);
	# Add any display content to main-2.
	$display_main2.=$display;

	# Get the quote text to display in main-3.
	$display_main3=$main_content->displayQuote();

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