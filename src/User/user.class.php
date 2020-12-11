<?php

namespace User;

use DB\Viewer\EmployeeViewer;

class User
{
	private
		$_data,
		$_isLoggedIn;

	public function __construct($user = null)
	{
	}

	private function check($user = null, $password = null)
	{
		$_SESSION['user-error'] = '';
		$_SESSION['password-error'] = '';
		if ($user) {
			$viewer = new EmployeeViewer();
			$data = $viewer->getRecordByEmail($user);
			if (sizeof($data) > 0) {
				$check = $viewer->checkPasswordByID($data[0]['EmpID'], $password);
				if ($check) {
					$this->_data = $data[0];
					$this->_isLoggedIn = true;
					return true;
				} else {
					$_SESSION['password-error'] = 'Incorrect password!';
					return false;
				}
			} else {
				$_SESSION['user-error'] = 'Incorrect Email!';
				return false;
			}
		}

		$_SESSION['user-error'] = 'Incorrect Email!';
		return false;
	}

	public function login($username = null, $password = null, $remember = false)
	{
		$result = $this->check($username, $password);
		if ($result === true && $this->exists()) {
			$_SESSION['loggedin'] = true;
			$_SESSION['empid'] = $this->_data['EmpID'];
			$_SESSION['position'] = strtolower($this->_data['Position']);
		}
		return $result;
	}

	public function exists()
	{
		return (!empty($this->_data)) ? true : false;
	}

	public function logout()
	{
		session_start();
		session_destroy();
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
