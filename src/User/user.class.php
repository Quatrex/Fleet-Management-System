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

	/**
	 * Check validity of email and password
	 * 
	 * @param string $email - dafault null
	 * @param string $password dafault null
	 * @return bool
	 */
	private function check($email = null, $password = null): bool
	{
		$_SESSION['user-error'] = '';
		$_SESSION['password-error'] = '';
		if ($email) {
			$viewer = new EmployeeViewer();
			$data = $viewer->getRecordByEmail($email);
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

	/**
	 * Login user
	 * 
	 * @param string $email - dafault null
	 * @param string $password dafault null
	 * @param bool $remember - dafault false
	 * @return bool
	 */
	public function login($email = null, $password = null, $remember = false): bool
	{
		$result = $this->check($email, $password);
		if ($result === true && $this->exists()) {
			$_SESSION['loggedin'] = true;
			$_SESSION['empid'] = $this->_data['EmpID'];
			$_SESSION['position'] = strtolower($this->_data['Position']);
		}
		return $result;
	}
	/**
	 * Check existense of user account
	 * 
	 * @return bool
	 */
	public function exists(): bool
	{
		return (!empty($this->_data)) ? true : false;
	}

	/**
	 * Log out user
	 */
	public function logout(): void
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
