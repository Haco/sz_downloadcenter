<?php
	/**
	 * Created by PhpStorm.
	 * User: sebo
	 * Date: 07.07.14
	 * Time: 08:31
	 */

	$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('sz_downloadcenter') . 'Classes/';

	return array(
		'Ecom\SzDownloadcenter\EidDispatcher' => $extensionClassesPath . 'EidDispatcher.php'
	);

?>