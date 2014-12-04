<?php

$newContentColumns = array (
	'tx_downloadcenter_add_product_download_button' => Array (
		'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xlf:tx_downloadcenter_add_product_download_button',
		'l10n_mode' => 'exclude',
		'config' => Array (
			'type' => 'check'
		),
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $newContentColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content','tx_downloadcenter_add_product_download_button', 'text,textpic', 'after:rte_enabled');