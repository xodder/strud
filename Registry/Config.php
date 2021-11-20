<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-10-06
 * Time: 11:38 AM
 */
namespace Strud\Registry
{
	class Config
	{
		private $expiryTime;
		private $path;
		private $domain;
		private $secure;
		private $httpOnly;

		public function getExpiryTime()
		{
			return $this->expiryTime;
		}

		public function setExpiryTime($value)
		{
			$this->expiryTime = $value;
		}

		public function getPath()
		{
			return $this->path;
		}

		public function setPath($value)
		{
			$this->path = $value;
		}

		public function getDomain()
		{
			return $this->domain;
		}

		public function setDomain($value)
		{
			$this->domain = $value;
		}

		public function getSecure()
		{
			return $this->secure;
		}

		public function setSecure($value)
		{
			$this->secure = $value;
		}

		public function getHttpOnly()
		{
			return $this->httpOnly;
		}

		public function setHttpOnly($value)
		{
			$this->httpOnly = $value;
		}

		public function isRestrictAccessToHttpsProtocolOnly()
		{
			return $this->secure;
		}

		public function isAccessibleToScriptingLanguages()
		{
			return $this->httpOnly;
		}
	}
}
