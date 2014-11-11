<?php
namespace Ecom\SzDownloadcenter;

/***************************************************************
*  Copyright notice
*
*  (c) 2013 Armin Rüdiger Vieweg <armin.vieweg@sunzinet.com>
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
use TYPO3\CMS\Frontend\Utility\EidUtility;

/**
 * Dispatcher for eID
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class EidDispatcher {
	/**
	 * Initializes and runs an extbase controller
	 *
	 * @param string $extensionName Name of extension, in UpperCamelCase
	 * @param string $controller Name of controller, in UpperCamelCase
	 * @param string $action Optional name of action, in lowerCamelCase (without 'Action' suffix). Default is 'index'.
	 * @param string $pluginName Optional name of plugin. Default is 'Pi1'.
	 * @param array $settings Optional array of settings to use in controller and fluid template. Default is array().
	 *
	 * @return string output of controller's action
	 */
	protected function runExtbaseController($extensionName, $controller, $action = 'index', $pluginName = 'Pi1', $settings = array()) {
		EidUtility::connectDB();
		EidUtility::initLanguage('default');
		EidUtility::initTCA();
		EidUtility::initFeUser();


		$GLOBALS['TSFE'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tslib_fe', $GLOBALS['TYPO3_CONF_VARS'], 0, 0);
		$GLOBALS['TSFE']->sys_page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
		$GLOBALS['TSFE']->config['config']['meaningfulTempFilePrefix'] = 100;
		$GLOBALS['TSFE']->initFEuser();
		$GLOBALS['TSFE']->determineId();
		$GLOBALS['TSFE']->initTemplate();
		$GLOBALS['TSFE']->getConfigArray();
		$GLOBALS['TSFE']->connectToDB();
		$GLOBALS['TSFE']->getCompressedTCarray();
		$GLOBALS['TSFE']->fe_user = EidUtility::initFeUser();

		$GLOBALS['TSFE']->sys_language_uid = 7;
		$GLOBALS['TSFE']->config['config']['language'] = 'de';
		$GLOBALS['TSFE']->lang = 'de';

		$bootstrap = new \TYPO3\CMS\Extbase\Core\Bootstrap();
		$bootstrap->cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');

		$extensionTyposcriptSetup = $this->getExtensionTyposcriptSetup();

		$configuration = array(
			'pluginName' => $pluginName,
			'extensionName' => $extensionName,
			'controller' => $controller,
			'action' => $action,
			'mvc' => array('requestHandlers' => array('TYPO3\CMS\Extbase\Mvc\Web\FrontendRequestHandler' => 'TYPO3\CMS\Extbase\Mvc\Web\FrontendRequestHandler')),
			'settings' => $settings,
			'persistence' => $extensionTyposcriptSetup['config']['tx_extbase']['persistence'],
		);

		return $bootstrap->run('', $configuration);
	}

	/**
	 * Gets the typoscript setup defined in ext_typoscript_setup.txt as array
	 * @return array
	 */
	protected function getExtensionTyposcriptSetup() {
		/** @var $TSparser \TYPO3\CMS\Core\TypoScript\Parser\TypoScriptParser */
		$TSparser = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\TypoScript\\Parser\\TypoScriptParser');
		$TSparser->parse(file_get_contents(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('sz_downloadcenter') . 'ext_typoscript_setup.txt'));

		$TypoScriptService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\TypoScriptService')
		return $TypoScriptService->convertTypoScriptArrayToPlainArray($TSparser->setup);
	}

	/**
	 * Dispatches the html partial creation via ajax
	 * @return string the output of controller
	 */
	public function dispatchCategoryRequest() {
		return $this->runExtbaseController('SzDownloadcenter', 'Category', 'getByDivision', 'Pi96');
	}
	/**
	 * Dispatches the html partial creation via ajax
	 * @return string the output of controller
	 */
	public function dispatchProductRequest() {
		return $this->runExtbaseController('SzDownloadcenter', 'Product', 'show', 'Pi97', $settings);
	}

}

/** @var $dispatcher \Ecom\SzDownloadcenter\EidDispatcher */
$dispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Ecom\\SzDownloadcenter\\EidDispatcher');
if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('eID') === 'tx_szdownloadcenter_category') {
	echo $dispatcher->dispatchCategoryRequest();
} else if(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('eID') === 'tx_szdownloadcenter_product') {
	echo $dispatcher->dispatchProductRequest();
}
?>