<?php defined('MW_INSTALLER_PATH') or exit();

// List of requirements (name, required or not, result, used by, memo)
// Based on Yii Framework requirements checker.
$requirements=array(
	array(
		'PHP version',
		true,
		version_compare(PHP_VERSION, "5.2.0", ">="),
		'<a href="http://www.mailwizz.com">MailWizz Core</a>',
		'PHP 5.2.0 or higher is required.'
	),
	array(
		'$_SERVER variable',
		true,
		'' === $message = checkServerVar(),
		'<a href="http://www.mailwizz.com">MailWizz Core</a>',
		$message
	),
	array(
		'Reflection extension',
		true,
		class_exists('Reflection',false),
		'<a href="http://www.mailwizz.com">MailWizz Core</a>',
		''
	),
	array(
		'PCRE extension',
		true,
		extension_loaded("pcre"),
		'<a href="http://www.mailwizz.com">MailWizz Core</a>',
		''
	),
	array(
		'SPL extension',
		true,
		extension_loaded("SPL"),
		'<a href="http://www.mailwizz.com">MailWizz Core</a>',
		''
	),
	array(
		'DOM extension',
		true,
		class_exists("DOMDocument",false),
		'<a href="http://www.yiiframework.com/doc/api/CHtmlPurifier">CHtmlPurifier</a>',
		''
	),
	array(
		'PDO extension',
		true,
		extension_loaded('pdo'),
		'All <a href="http://www.yiiframework.com/doc/api/#system.db">DB-related classes</a>',
		''
	),
	array(
		'PDO MySQL extension',
		true,
		extension_loaded('pdo_mysql'),
		'All <a href="http://www.yiiframework.com/doc/api/#system.db">DB-related classes</a>',
		'Required for MySQL database.'
	),
	array(
		'Multibyte String',
		true,
		extension_loaded('mbstring'),
		'<a href="http://www.mailwizz.com">MailWizz Core</a>',
		''
	),
	array(
		'GD extension',
		true,
		'' === $message = checkCaptchaSupport(),
		'<a href="http://www.mailwizz.com">MailWizz Core</a>',
		$message
	),
	array(
		'Zip Archive', 
		true,
		class_exists('ZipArchive', false),
		'<a href="http://www.mailwizz.com">MailWizz Core</a>',
		'Required to create export archives and to install extensions.'
	),
	array(
		'Ctype extension',
		false,
		extension_loaded("ctype"),
		'<a href="http://www.yiiframework.com/doc/api/CDateFormatter">CDateFormatter</a>, <a href="http://www.yiiframework.com/doc/api/CDateFormatter">CDateTimeParser</a>, <a href="http://www.yiiframework.com/doc/api/CTextHighlighter">CTextHighlighter</a>, <a href="http://www.yiiframework.com/doc/api/CHtmlPurifier">CHtmlPurifier</a>',
		''
	),
	array(
		'Fileinfo extension',
		false,
		extension_loaded("fileinfo"),
		'<a href="http://www.yiiframework.com/doc/api/CFileValidator">CFileValidator</a>',
		'Required for MIME-type validation'
	),
	array(
		'IMAP extension',
		false,
		extension_loaded("imap"),
		'<a href="http://www.mailwizz.com">MailWizz Core</a>',
		'Required to process bounce emails'
	),
);

function checkServerVar()
{
	$vars=array('HTTP_HOST','SERVER_NAME','SERVER_PORT','SCRIPT_NAME','SCRIPT_FILENAME','PHP_SELF','HTTP_ACCEPT','HTTP_USER_AGENT');
	$missing=array();
	foreach($vars as $var) {
		if(!isset($_SERVER[$var])) {
			$missing[]=$var;
		}	
	}
	
	if(!empty($missing)) {
		return '$_SERVER does not have: '. implode(', ',$missing) ;
	}

	if(!isset($_SERVER["REQUEST_URI"]) && isset($_SERVER["QUERY_STRING"])) {
		return 'Either $_SERVER["REQUEST_URI"] or $_SERVER["QUERY_STRING"] must exist.';
	}

	if(!isset($_SERVER["PATH_INFO"]) && strpos($_SERVER["PHP_SELF"], $_SERVER["SCRIPT_NAME"]) !== 0) {
		return 'Unable to determine URL path info. Please make sure $_SERVER["PATH_INFO"] (or $_SERVER["PHP_SELF"] and $_SERVER["SCRIPT_NAME"]) contains proper value.';
	}

	return '';
}

function checkCaptchaSupport()
{
	if(extension_loaded('imagick')) {
		$imagick=new Imagick();
		$imagickFormats=$imagick->queryFormats('PNG');
	}
	
	if(extension_loaded('gd')) {
		$gdInfo=gd_info();
	}

	if(isset($imagickFormats) && in_array('PNG',$imagickFormats)) {
		return '';
	} elseif(isset($gdInfo)) {
		if($gdInfo['FreeType Support']) {
			return '';
		}	
		return 'GD installed,<br />FreeType support not installed';
	}
	return 'GD or ImageMagick not installed';
}

return $requirements;