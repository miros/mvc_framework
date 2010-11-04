<?php
/**
 * Description of Response
 *
 * @author admin
 */
class Mvc_Response
{

	private $_vars = array();
	private $_context = null;
	private $_output = '';
	private $_shouldRender = true;

	public function shouldRender()
	{
		return $this->_shouldRender && $this->isRedirected();
	}

	public function setNoRender()
	{
		$this->_shouldRender = false;
	}

	public function  __set($name,  $value)
	{
		$this->assign($name, $value);
	}

	public function assign($name,  $value, $context = 'main')
	{
		if (!isset($this->_vars[$context])) {
			$this->_vars[$context] = array();
		}

		$this->_vars[$context][$name] = $value;
	}

	public function getVars($context = null)
	{
		if ($context) {
			return $this->_vars[$context];
		} else {
			return $this->getAllVars();
		}
	}

	public function getAllVars()
	{
		$values = array();

		foreach($this->_vars as $context => $vars) {
			$values = array_merge($values, $vars);
		}

		return $values;
	}

	public function  __toString()
	{
		return $this->getOutput();
	}

	public function getOutput()
	{
		return $this->_output;
	}

	public function setOutput($output)
	{
		$this->_output = $output;
	}

	public function appendOutput($output)
	{
		$this->_output .= $output;
	}

	public function echoOutput()
	{
		$this->sendHeaders();
		echo $this->getOutput();
	}

	public function getContext()
	{
		return $this->_context;
	}

	public function setContext($context)
	{
		$this->_context = $context;
	}

	private $_headers = array();
	private $_code = 200;

	public function addHeader($name, $value)
	{
		$this->_headers[$name] = $value;
	}

	public function getHeaders()
	{
		return $this->_headers;
	}

	public function sendHeaders()
	{
		if (!headers_sent()) {
			header('', false, $this->getCode());
			foreach ($this->getHeaders() as $header => $content) {
				header($header . ': ' . $content);
			}
		}
	}

	public function setCode($code)
    {
        $this->_code = (int) $code;
        return $this;
    }

    public function getCode()
    {
        return $this->_code;
    }

	public function isRedirected()
	{
		return array_key_exists('Location', $this->getHeaders());
	}

	public function setCookie($name, $value, $expire = 0, $path = '/')
	{
		setcookie($name, $value, $expire, $path);
	}

}


?>
