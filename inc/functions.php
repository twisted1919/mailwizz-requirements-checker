<?php defined('MW_INSTALLER_PATH') or exit();

function formatController($string) 
{
	$controller = str_replace('-', ' ', $string);
	$controller = ucwords(strtolower($controller));
	$controller = str_replace(' ', '', $controller);
	$controller .= 'Controller';
	
	return $controller;
}

function formatAction($string)
{
	$action = str_replace('-', ' ', $string);
	$action = ucwords(strtolower($action));
	$action = str_replace(' ', '', $action);
	$action = 'action'.$action;
	
	return $action;
}

function renderFile($_viewFile_, $_data_=null, $_return_=false)
{
    if(is_array($_data_)) {
    	extract($_data_, EXTR_PREFIX_SAME, 'data');
    } else {
    	$data = $_data_;
    }
    
    if($_return_) {
        ob_start();
        ob_implicit_flush(false);
        require($_viewFile_);
        return ob_get_clean();
    } else {
    	require($_viewFile_);
    }   
}

function getSession($key, $defaultValue = null)
{
	return isset($_SESSION[$key]) ? $_SESSION[$key] : $defaultValue; 
}

function setSession($key, $value)
{
	$_SESSION[$key] = $value;
	return $value;
}

function getPost($key, $defaultValue = null)
{
	return isset($_POST[$key]) ? clean($_POST[$key]) : $defaultValue; 
}

function getQuery($key, $defaultValue = null)
{
	return isset($_GET[$key]) ? clean($_GET[$key]) : $defaultValue; 
}

function clean($key)
{
	if (is_array($key)) {
		$key = array_map('clean', $key);
	} else {
		$key = htmlentities(strip_tags($key), ENT_QUOTES, 'utf-8');
	}
	return $key;
}

function redirect($location)
{
	header('Location: '.$location);
	exit;
}