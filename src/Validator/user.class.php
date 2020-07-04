<?php

namespace Validator;

use DB\Viewer\EmployeeViewer;

class User
{
	private
		$_data,
		$_isLoggedIn;

	public function __construct($user = null)
	{
	}

	public function check($user = null, $password = null)
	{
		if ($user) {
			// $field = (is_numeric($user)) ? 'id' : 'username';
			$viewer = new EmployeeViewer();
			$data = $viewer->getRecordByUsername($user);
			if (sizeof($data) > 0) {
				$check = $viewer->checkPassword($user, $password);
				if ($check) {
					$this->_data = $data[0];
					$this->_isLoggedIn=true;
					return true;
				}
				else{
					return 'Incorrect password!';
				}
			}
			else{
				return 'Incorrect username!';
			}
		}

		return 'Incorrect username!';
	}

	public function login($username = null, $password = null, $remember = false)
	{
		$result =$this->check($username, $password);
		if ($result===true && $this->exists()) {
			$_SESSION['loggedin'] = true;
			$_SESSION['empid']=$this->_data['EmpID'];
			$_SESSION['position'] = $this->_data['Position'];
			return 'Layout/'.$_SESSION['position'];
		}
		else{
			return $result;
		}
	}

	public function exists()
	{
		return (!empty($this->_data)) ? true : false;
	}

	public function logout()
	{
		session_start();
		session_destroy();
		// Redirect to the login page:
		header('Location: ../Layout/login.php');
	}

	public function data()
	{
		return $this->_data;
	}

	public function isLoggedIn()
	{
		return $this->_isLoggedIn;
	}
}
