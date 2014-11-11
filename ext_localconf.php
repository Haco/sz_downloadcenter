<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Ecom.' . $_EXTKEY,
	'Downloadcenter',
	array(
		'Division' => 'list,show,showStaticResult',
		'Category' => 'list,show',
		'Product' => 'list,show',
		'File' => 'list,show',
	),
	// non-cacheable actions
	array(
		'Division' => '',
		'Category' => '',
		'Product' => '',
		'File' => '',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Ecom.' . $_EXTKEY,
	'Setcard',
	array(
		'Product' => 'list,show',
		'File' => 'list,show',
	),
	// non-cacheable actions
	array(
		'Product' => '',
		'File' => '',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Ecom.' . $_EXTKEY,
	'DownloadButton',
	array(
		'Product' => 'showDownloadButton,show,',
		'Division' => 'showStaticResult,list'
	),
	// non-cacheable actions
	array(
		'Product' => '',
		'Division' => '',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Ecom.' . $_EXTKEY,
	'Pi96',
	array(
		'Category' => 'getByDivision,getProductList',
	),
	array(
		'Category' => 'getByDivision,getProductList',
	)
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Ecom.' . $_EXTKEY,
	'Pi97',
	array(
		'Product' => 'show',
	),
	array(
		'Product' => 'show',
	)
);

// eID
$TYPO3_CONF_VARS['FE']['eID_include']['tx_szdownloadcenter_category'] = 'EXT:' . $_EXTKEY . '/Classes/EidDispatcher.php';
$TYPO3_CONF_VARS['FE']['eID_include']['tx_szdownloadcenter_product'] = 'EXT:' . $_EXTKEY . '/Classes/EidDispatcher.php';



?>