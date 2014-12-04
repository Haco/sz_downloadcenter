<?php
namespace Ecom\SzDownloadcenter\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Björn Christopher Bresser <bjoern.bresser@sunzinet.com>, sunzinet AG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

/**
 * @package SzDownloadcenter
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ProductController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * productRepository
	 *
	 * @var \Ecom\SzDownloadcenter\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository;

	/**
	 * productRepository
	 *
	 * @var \Ecom\SzDownloadcenter\Domain\Repository\FileRepository
	 * @inject
	 */
	protected $fileRepository;

	/**
	 * action show
	 *
	 * @return mixed
	 */
	public function showAction() {
		$productId = $this->request->getArguments('productId');
		$product = $this->productRepository->findByUid($productId);

		$files = $this->fileRepository->findByProduct($product);
		$fileCategories = array();

		/** @var \Ecom\SzDownloadcenter\Domain\Model\File $file */
		foreach ($files as $file) {
			/** @var \Ecom\SzDownloadcenter\Domain\Model\FileCategory $category */
			$category = $file->getFileCategory();
			if ($category instanceof \Ecom\SzDownloadcenter\Domain\Model\FileCategory) {
				$sorting = $category->getSorting();
				$fileCategories[$sorting]['title'] = $category->getTitle();
				$fileCategories[$sorting]['files'][] = $file;
			}
		}
		ksort($fileCategories);

		$this->view->assignMultiple(array(
			'product' => $product,
			'fileCategories' => $fileCategories
		));

		$content = $this->view->render();

		return json_encode(array(
			'success' => TRUE,
			'content' => $content
		));

	}

	/**
	 * action showSetcard
	 * @return void
	 */
	public function showSetcardAction() {
		$productId = $this->settings['productId'];
		$product = $this->productRepository->findByUid($productId);
		$files = $this->fileRepository->findByProduct($product);

		$certAppro = $this->getApprovals($product->getCertifications(), 'certifications');
		$attestAppro = $this->getApprovals($product->getAttestations(), 'attestations', $certAppro);
		$approvals = $this->getApprovals($files, 'files', $attestAppro);

		$this->view->assign('approvals', $approvals);
		$this->view->assign('product', $product);
	}

	/**
	 * action showSetcardAdd
	 *
	 * @return void
	 */
	public function showSetcardAddAction() {
		$productId = $this->settings['productId'];
		$product = $this->productRepository->findByUid($productId);
		$files = $this->fileRepository->findByProduct($product);

		$certAppro = $this->getApprovals($product->getCertifications(), 'certifications');
		$attestAppro = $this->getApprovals($product->getAttestations(), 'attestations', $certAppro);
		$approvals = $this->getApprovals($files, 'files', $attestAppro);

		$this->view->assign('language', $GLOBALS['TSFE']->sys_language_uid);
		$this->view->assign('approvals', $approvals);
	}

	/**
	 * action showDownloadButton
	 *
	 * @return void
	 */
	public function showDownloadButtonAction() {
		$productId = '';
		$pluginPageId = (!empty($this->settings['pluginPagePid'])) ? $this->settings['pluginPagePid'] : $this->addFlashMessage('Please set the Plugin PID in the constants.', 'Missing Constant Value', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);

		// Get the product ID from the current page.
		// Else from included plugin
		if ($GLOBALS['TSFE']->page['tx_downloadcenter_product_id'] > 0 && !$this->settings['overrideProductId']) {
			$productId = $GLOBALS['TSFE']->page['tx_downloadcenter_product_id'];
		} elseif(is_array($this->settings) && $this->settings['downloadProductId'] > 0) {
			$productId = $this->settings['downloadProductId'];
		}
		// Custom Classes from plugin
		$customClasses = $this->settings['customClasses'] ? str_replace(',', ' ', str_replace(' ', '', $this->settings['customClasses'])) : false;

		// Get product by selected ID from BE
		$product = $productId ? $this->productRepository->findByUid($productId) : '';

		$this->view->assignMultiple(array(
			'product' => ($product instanceof \Ecom\SzDownloadcenter\Domain\Model\Product) ? $product : '',
			'pluginPageId' => $pluginPageId,
			'customClasses' => $customClasses,
		));
	}

	/**
	 * @param  \ArrayAccess $data
	 * @param  string $key
	 * @param  array $approvals
	 * @return array
	 */
	private function getApprovals(\ArrayAccess $data, $key, $approvals = array()) {

		/** @var \Ecom\SzDownloadcenter\Domain\Model\File $value */
		foreach($data as $value) {
			$approval = $value->getApproval();
			if ($approval !== NULL && $approval != '') {
				$approvals[$approval->getSorting()]['data'] = $approval; // Approval Entity
				$approvals[$approval->getSorting()][$key][$value->getUid()] = $value;
			}
		}
		ksort($approvals);

		return $approvals;
	}
}
?>
