<?php /* framework/application/modules/API/FacebookAPI.php */

# Make sure the script is not accessed directly.
if(!defined('BASE_PATH')) exit('No direct script access allowed');

/**
 * FacebookAPI
 *
 * The FacebookAPI accesses Facebook data info.
 *
 */
class FacebookAPI
{
	/*** data members ***/

	private $facebook_obj;

	/*** End data members ***/



	/*** mutator methods ***/

	/**
	 * setFacebookObj
	 *
	 * Sets the data member $facebook_obj.
	 *
	 * @param	obj $facebook_obj
	 * @access	public
	 */
	public function setFacebookObj($facebook_obj)
	{
		# Check if the passed value is empty.
		if(!empty($facebook_obj))
		{
			# Set the data member.
			$this->facebook_obj=$facebook_obj;
		}
		else
		{
			# Explicitly set the data member to NULL.
			$this->facebook_obj=NULL;
		}
	} #==== End -- setFacebookObj

	/*** End mutator methods ***/



	/*** accessor methods ***/

	/**
	 * getFacebookObj
	 *
	 * Returns the data member $facebook_obj.
	 *
	 * @access	private
	 */
	private function getFacebookObj()
	{
		return $this->facebook_obj;
	} #==== End -- getFacebookObj

	/*** End accessor methods ***/



	/*** magic methods ***/

	/**
	 * __contruct
	 *
	 * Description.
	 *
	 * @access	public
	 */
	public function __construct()
	{
		# Get the Facebook API Class.
		require_once Utility::locateFile(MODULES.'Social'.DS.'Facebook'.DS.'autoload.php');
		# Check if there is a YouTube object.
		if(empty($this->facebook_obj) OR !is_object($this->facebook_obj))
		{
			# Instantiate a new Facebook object.
			$facebook_obj=new Facebook\Facebook([
				'app_id'=>FB_APP_ID,
				'app_secret'=>FB_APP_SECRET,
				'default_graph_version'=>'v2.5',
				'default_access_token'=>FB_PAGE_ACCESS_TOKEN
			]);
			$this->setFacebookObj($facebook_obj);
		}
		return $this->getFacebookObj();
	} #==== End -- __construct

	/*** End magic methods ***/



	/*** public methods ***/

	/**
	 * post
	 *
	 * Wrapper function for the Facebook API.
	 * Posts content to Facebook.
	 *
	 * @param	array $data				Array of data to post on Facebook.
	 *										Example:
	 * 											$data=array(
	 *												'link'=>'http://www.example.com',
	 *												'message'=>'User provided message',
	 *											);
	 * @access	public
	 */
	public function post($data)
	{
		try
		{
			$this->getFacebookObj()->post('/me/feed', $data);
		}
		catch(Facebook\Exceptions\FacebookResponseException $e)
		{
			throw new Exception('Graph returned an error: '.$e->getMessage(), E_RECOVERABLE_ERROR);
		}
		catch(Facebook\Exceptions\FacebookSDKException $e)
		{
			throw new Exception('Facebook SDK returned an error: '.$e->getMessage(), E_RECOVERABLE_ERROR);
		}
		catch(Exception $e)
		{
			throw $e;
		}
	} #==== End -- post

	/*** End public methods ***/

} #=== End FacebookAPI class.