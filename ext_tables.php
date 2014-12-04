<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

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

// Add static typoscript file
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Downloadcenter');

// Convert Extkey
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);

// Register FlexForm XML Files
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