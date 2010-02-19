<?php
class Validation
{
	public $post = array();
	public $message = "";
	public $errors = array();

	
	/**
	 * This function should check for Submit
	 * @return unknown_type
	 */
	
	// FIXME: This one should go in a special class that handles
	// FIXME: all type of $_POST $_REQUEST $_GET
	public function isPost($name)
	{
		try
		{
			
			// TODO: This function will work one day for the moment we use normal checkings
			/*
			$this->_method = $_SERVER['REQUEST_METHOD'];
			if($this->_method = 'POST')
			{
				$post = $this->post;
				$this->post = $_POST;
				return true;
			}
			else
			{
				return false;
			}
			
			return;
			*/
			
			if(isset($_POST[$name]))
			{
				$post = $this->post;
				$this->post = $_POST;
				return true;
			}
			else
			{
				return false;
			}
		}
		
		catch(Exception $e)
		{
			trigger_error('Not Quite!', E_USER_ERROR);
		}
	}

	/**
	 * With this function you can get the values from $_POST
	 * @param $value
	 * @return unknown_type
	 */
	
	public function getPost($value)
	{
		return $this->post[$value];
	}
	
	/**
	 * With this function you check if the field is empty
	 * @param $post
	 * @return unknown_type
	 */
	
	public function notEmpty($post)
	{
		return empty($this->post) ? true : false;

	}
	
	/**
	 * With this function you can check if a field is not too short
	 * @param $post
	 * @param $numbers
	 * @return unknown_type
	 */
	
	public function notTooShort($post, $numbers)
	{
		return strlen($this->post) < $numbers ? true : false;
	}
	
	/**
	 * With this function you can check if a field is not too long
	 * @param $post
	 * @param $numbers
	 * @return unknown_type
	 */
	
	public function notTooLong($post, $numbers)
	{
		return (strlen($this->post) > $numbers) ? true : false;
	}	
	
	/**
	 * With this function you can check if a field contains only
	 * Letters
	 * a-z, A-Z
	 * @param $post
	 * @return unknown_type
	 */
	
	public function isAlpha($post)
	{
		return ctype_alpha($this->post) ? true : false;
	}
	
	/**
	 * With this function you can check if a field contains only
	 * digits
	 * N = {0,1,2,3 ... 8,9}
	 * @param $post
	 * @return unknown_type
	 */
	
	public function isDigit($post)
	{
		return ctype_digit($this->post) ? true : false;
	}
	
	/**
	 * With this function you can check if a field is valid
	 * by using preg_match 
	 * Example: preg_match('^[a-zA-Z0-9]*$^', $form->getPost("username")
	 * @param $post
	 * @param $pattern
	 * @return unknown_type
	 */
	
	public function isValid($post, $pattern)
	{
		return preg_match($pattern, $this->post) ? true : false;
	}
	
	/**
	 * With this function you can check if an E-mail is valid
	 * @param $post
	 * @return unknown_type
	 */
	
	public function isEmailValid($post)
	{
		return preg_match('/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i', $this->post) ? true : false;
	}
	
	// FIXME: This functions will go in a different class
	// FIXME: Should stay here since they output the errors from
	// FIXME: the validation like Username Incorrect Password empty..
	
	public function setError($post, $message)
	{
		$errors = $this->errors;
		return $this->errors[$post] = $message;
	}
	
	// FIXME: The getError function doesn't output anything
	// FIXME: still needs a bit of work
	// FIXME: $post should be a string not an array.
	
	public function getError($post)
	{
		if(array_key_exists($post, $this->errors))
		{
			return $this->errors[$post];
		}
	}
	
	/**
	 * With this function you can count if there is any error in the form
	 * Else insert/update db or do other things.
	 * @return unknown_type
	 */
	
	public function noErrors()
	{
		return (count($this->errors) < 1) ? true : false;
	}
}