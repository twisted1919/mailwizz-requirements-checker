<?php defined('MW_INSTALLER_PATH') or exit();

class Controller 
{
	public $data = array();
	
	public $layout = 'layout';
	
	public function actionNot_found()
	{
		$this->render('not-found');
	}
	
	public function actionIndex()
	{
		$this->actionNot_found();
	}
	
	public function render($viewName, $data = array(), $return = false)
	{
		if (!is_file($layout = MW_INSTALLER_PATH . '/views/' . $this->layout . '.php')) {
			return;
		}
		if (!is_file($view = MW_INSTALLER_PATH . '/views/' . $viewName . '.php')) {
			return;
		}
 
		$data = array_merge($this->data, (array)$data);
		$data['context'] = $this;
		$layout = renderFile($layout, $data, true);
		$view = renderFile($view, $data, true);
		
		$content = str_replace('{{CONTENT}}', $view, $layout);
		
		if ($return) {
			return $content;
		}
		echo $content;
	}
	
	public function addError($key, $value)
	{
		if (!isset($this->data['errors']) || !is_array($this->data['errors'])) {
			$this->data['errors'] = array();
		}
		
		$this->data['errors'][$key] = $value;
		return $this;
	}
	
	public function getError($key)
	{
		return isset($this->data['errors'][$key]) ? $this->data['errors'][$key] : null;
	}
	
	public function hasErrors()
	{
		return isset($this->data['errors']) && count($this->data['errors']) > 0;
	}
	
	public function resetErrors()
	{
		$this->data['errors'] = array();
		return $this;
	}
}