<?php

class UserController extends Controller
{
	private $user;
	private $session;

	public function __construct()
	{
		parent::__construct();

		$this->user    = new UserModel();
		$this->session = new Session();
	}

	public function index()
	{
		$this->displayForm();	
	}

	public function logout()
	{
		$_SESSION = array();

		if (ini_get("session.use_cookies"))
		{
	    	$params = session_get_cookie_params();
		    setcookie(
				session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}

		session_destroy();

		// Temp output
		echo 'logged out...';
	}

	public function login()
	{
		if ($this->session->getVar('logged_in'))
		{
			$this->success();
		}

        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $remember = isset($_POST['remember']) ? true : false;

		try
		{
			$result = $this->user->login($username, $password);

			// update last user action, etc.
		}
		catch (Exception $e)
		{
			switch ($e->getMessage())
			{
				case 'INVALID_USERNAME_PASSWORD':
				default:
					$this->template->assign('error', 'Invalid username / password!');
					$this->displayForm();
			}
		}

		$this->session->setVar('user_data', $result);
		$this->session->setVar('logged_in', true);

		if ($remember)
		{
			$hash    = $this->user->db->hash($username.$password.USER_IP);
			$expires = date("U", strtotime("now + 1 month"));

			if ($this->user->addRemember($hash, $result['user_id'], $expires))
			{
				setcookie('remember', $hash, $expires);
			}
		}

		$this->success();
	}

	public function register()
	{
	}

	private function success()
	{
		//FIXME
		echo 'logged in!!';
	}

	private function displayForm()
	{
		$this->template->assign('username', isset($_POST['username']) ? $_POST['username'] : '');
		$this->template->assign('remember', isset($_POST['remember']) ? $_POST['remember'] : false);

		$this->template->display('user/loginform.tpl');
	}
}

// EOF
