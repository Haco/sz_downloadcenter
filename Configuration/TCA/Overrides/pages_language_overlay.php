<?php

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('sz_downloadcenter') . 'Resources/Private/PHP/NewPagesColumns.php');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages_language_overlay', $newPageColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages_language_overlay', '--div--;Download Center, tx_downloadcenter_product_id');