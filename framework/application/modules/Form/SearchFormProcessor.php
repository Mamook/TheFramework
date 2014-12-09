<?php /* Requires PHP5+ */

# Make sure the script is not accessed directly.
if(!defined('BASE_PATH')) exit('No direct script access allowed');


# Get the FormValidator Class.
require_once Utility::locateFile(MODULES.'Form'.DS.'FormValidator.php');

# Get the FormProcessor Class.
require_once Utility::locateFile(MODULES.'Form'.DS.'FormProcessor.php');


/**
 * SearchFormProcessor
 *
 * The SearchFormProcessor Class is used to create and process search forms.
 *
 */
class SearchFormProcessor extends FormProcessor
{
	/*** public methods ***/

	/**
	 * processSearch
	 *
	 * Processes a submitted search for upload.
	 *
	 * @param	$data					An array of values to populate the form with.
	 * @access	public
	 * @return	string
	 */
	public function processSearch($data)
	{
		try
		{
			# Bring the alert-title variable into scope.
			global $alert_title;
			# Set the Database instance to a variable.
			$db=DB::get_instance();
			# Set the Document instance to a variable.
			$doc=Document::getInstance();
			# Get the SearchFormPopulator Class.
			require_once Utility::locateFile(MODULES.'Form'.DS.'SearchFormPopulator.php');

			# Remove any un-needed CMS session data.
			# This needs to happen before populateSearchForm is called but AFTER the Populator has been included so that the getCurrentURL method will be available.
			$this->loseSessionData('search');

			# Reset the form if the "reset" button was submitted.
			//$this->processReset('search', 'search');

			# Instantiate a new instance of the SearchFormPopulator class.
			$populator=new SearchFormPopulator();
			# Populate the form and set the Search data members for this post.
			$populator->populateSearchForm($data);
			# Set the Populator object to the data member.
			$this->setPopulator($populator);

			# Get the Search object from the SearchFormPopulator object and set it to a variable for use in this method.
			$search_obj=$populator->getSearchObject();

			# Create empty results variable.
			$search_results=NULL;
			# Set the search terms to a variable.
			$search_terms=$search_obj->getSearchTerms();

			# Check if the form has been submitted.
			if(array_key_exists('_submit_check', $_POST) && (isset($_POST['search'])))
			{
				# Create a session that holds all the POST data (it will be destroyed if it is not needed.)
				$this->setSession();

				# Instantiate FormValidator object
				$fv=new FormValidator();
				# Check if the title field was empty (or less than 2 characters or more than 1024 characters long).
				$empty_title=$fv->validateEmpty('searchterms', 'Please enter a search term.', 2, 255);

				# Check for errors to display so that the script won't go further.
				if($fv->checkErrors()===TRUE)
				{
					# Create a variable to the error heading.
					$alert_title='Resubmit the form after correcting the following errors:';
					# Set the FormValidator class errors to a variable.
					$error=$fv->displayErrors();
					# Set the error message to the Document object data member so that it me be displayed on the page.
					$doc->setError($error);
				}
				# The post is considered "unique" and may be added to the database.
				else
				{
					if($search_terms!==NULL)
					{
						$search_results='results';
					}
					else
					{
						$search_results='no results';
					}
				}
			}
			# Unset the CMS session data.
			unset($_SESSION['form']);
			return $search_results;
		}
		catch(Exception $e)
		{
			throw $e;
		}
	} #==== End -- processSearch

	/*** End public methods ***/



	/*** private methods ***/

	/**
	 * setSession
	 *
	 * Creates a session that holds all the POST data (it will be destroyed if it is not needed.)
	 *
	 * @access	private
	 */
	private function setSession()
	{
		try
		{
			# Get the Populator object and set it to a local variable.
			$populator=$this->getPopulator();
			# Get the Search object and set it to a local variable.
			$search_obj=$populator->getSearchObject();

			# Set the form URL's to a variable.
			$form_url=$populator->getFormURL();
			# Set the current URL to a variable.
			$current_url=FormPopulator::getCurrentURL();
			# Check if the current URL is already in the form_url array. If not, add the current URL to the form_url array.
			if(!in_array($current_url, $form_url)) $form_url[]=$current_url;

			# Create a session that holds all the POST data (it will be destroyed if it is not needed.)
			$_SESSION['form']['search']=
				array(
					'FormURL'=>$form_url,
					'SearchTerms'=>$search_obj->getSearchTerms()
				);
		}
		catch(Exception $e)
		{
			throw $e;
		}
	} #==== End -- setSession

	/*** End private methods ***/

} # End SearchFormProcessor class.