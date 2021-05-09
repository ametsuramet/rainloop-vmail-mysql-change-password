<?php

class MysqlChangePasswordDriver implements \RainLoop\Providers\ChangePassword\ChangePasswordInterface
{
	/**
	 * @var string
	 */
	private $sAllowedEmails = '';

	/**
	 * @param string $sAllowedEmails
	 *
	 * @return \ChangePasswordExampleDriver
	 */
	public function SetAllowedEmails($sAllowedEmails)
	{
		$this->sAllowedEmails = $sAllowedEmails;
		return $this;
	}

	/**
	 * @param \RainLoop\Model\Account $oAccount
	 *
	 * @return bool
	 */
	public function PasswordChangePossibility($oAccount)
	{
		return $oAccount && $oAccount->Email() &&
			\RainLoop\Plugins\Helper::ValidateWildcardValues($oAccount->Email(), $this->sAllowedEmails);
	}

	/**
	 * @param \RainLoop\Model\Account $oAccount
	 * @param string $sPrevPassword
	 * @param string $sNewPassword
	 *
	 * @return bool
	 */
	public function ChangePassword(\RainLoop\Account $oAccount, $sPrevPassword, $sNewPassword)
	{
		$bResult = false;

		$config = array (
			'host' => '',
			'user' => '',
			'pass' => '',
			'db'   => '',
			);

		$mysqli = new mysqli ($config['host'], $config['user'], $config['pass'], $config['db']);
		$output = exec("doveadm pw -s 'ssha512' -p '".$sNewPassword."'");
		$output  = str_replace("\n", "", $output);
		$result = $mysqli->query ("update `mailbox` SET `password`='".$output."' WHERE `username`='". $oAccount->Email () ."'");

    if ($result)
      $bResult = true;

		return $bResult;
	}
}