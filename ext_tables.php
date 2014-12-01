<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
// PAGES
$newPageColumns = array(
	'tx_downloadcenter_product_id' => array (
		'exclude' => 1,
		'label' => 'Link DownloadCenter Product',
		'config' => array (
			'type' => 'select',
			'items' => array(
				array('', -1)
			),
			'foreign_table' => 'tx_szdownloadcenter_domain_model_product',
			'size' => '10',
			'maxitems' => '1',
			'minitems' => '0',
			'wizards' => Array(
				'_PADDING' => 12,
				'_VALIGN' => 'middle',
				'suggest' => array(
					'type' => 'suggest'
				),
			),
		),
	),
);

// TT_CONTENT
$newContentColumns = array (
	'tx_downloadcenter_add_product_download_button' => Array (
		'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xlf:tx_downloadcenter_add_product_download_button',
		'l10n_mode' => 'exclude',
		'config' => Array (
			'type' => 'check'
		),
	),
);

// REGISTER PLUGINS
TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Downloadcenter',
	'Downloadcenter'
);

TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Setcard',
	'Setcard'
);

TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'DownloadButton',
	'Download Center: Download Button'
);
// ADD TS FILE
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Downloadcenter');

// Add the extended page fields
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $newPageColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages_language_overlay', $newPageColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', '--div--;Download Center, tx_downloadcenter_product_id');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages_language_overlay', '--div--;Download Center, tx_downloadcenter_product_id');

// Add TT_CONTENT Fields
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $newContentColumns, 1);
$TCA['tt_content']['palettes']['sz_downloadcenter'] = array(
	'showitem' => 'tx_downloadcenter_add_product_download_button',
	'canNotCollapse' => 1
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content','--palette--;SZ Download Center;sz_downloadcenter', 'text,textpic', 'after:rte_enabled');

	/**
 * Allow tables on standard pages
 */
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_szdownloadcenter_domain_model_approval');
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_szdownloadcenter_domain_model_attestation');
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_szdownloadcenter_domain_model_category');
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_szdownloadcenter_domain_model_certification');
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_szdownloadcenter_domain_model_division');
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_szdownloadcenter_domain_model_file');
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_szdownloadcenter_domain_model_filecategory');
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_szdownloadcenter_domain_model_product');

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_downloadcenter';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/downloadcenter.xml');

$pluginSignatureEvent_Pi1 = strtolower($extensionName) . '_setcard';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignatureEvent_Pi1] = 'select_key,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignatureEvent_Pi1] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignatureEvent_Pi1, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/setcard.xml');

$pluginSignatureDownloadButton = strtolower($extensionName) . '_downloadbutton';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignatureDownloadButton] = 'select_key,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignatureDownloadButton] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignatureDownloadButton, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/downloadbutton.xml');


?>