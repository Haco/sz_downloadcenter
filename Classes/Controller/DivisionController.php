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
 *
 *
 * @package SzDownloadcenter
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class DivisionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * divisionRepository
	 *
	 * @var \Ecom\SzDownloadcenter\Domain\Repository\DivisionRepository
	 * @inject
	 */
	protected $divisionRepository;

	/**
	 * categoryRepository
	 *
	 * @var \Ecom\SzDownloadcenter\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;

	/**
	 * action list
	 * @return void
	 */
	public function listAction() {
		// Get the arguments of the downloadButton plugin (UID of selected Product)
		if($this->request->hasArgument('dlProductId')) {
			$dlProductId = (int) $this->request->getArgument('dlProductId');
			if (empty($dlProductId) || $dlProductId <= 0) {
				$this->redirect('list');
			}
			// Get the first returning category ('setLimit => 1' in Repo)
			$productCategory = (!$this->categoryRepository->findCategoryByProduct($dlProductId)[0] instanceof \Ecom\SzDownloadcenter\Domain\Model\Category) ? $this->addFlashMessage('No Category found for the Product with ID: ' . $dlProductId, '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING) : $this->categoryRepository->findCategoryByProduct($dlProductId)[0];
			// Get the division by category
			$productDivision = ($productCategory instanceof \Ecom\SzDownloadcenter\Domain\Model\Category) ? ($this->divisionRepository->findByUid($productCategory->getDivision()) instanceof \Ecom\SzDownloadcenter\Domain\Model\Division ? $this->divisionRepository->findByUid($productCategory->getDivision()) : $this->addFlashMessage('No Division found for the Category: ' . $productCategory->getTitle() , '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING)) : '';

			$this->view->assignMultiple(array(
				'downloadButtonPlugin' => array(
					'dlProductId' => $dlProductId,
					'productCategory' => $productCategory,
					'productDivision' => $productDivision,
				),
			));
		}
		$divisions = $this->divisionRepository->findAllByLang($GLOBALS['TSFE']->sys_language_uid);
		$this->view->assign('divisions', $divisions);
	}

	/**
	 * action show
	 *
	 * @param \Ecom\SzDownloadcenter\Domain\Model\Division $division
	 * @return void
	 */
	public function showAction(\Ecom\SzDownloadcenter\Domain\Model\Division $division) {
		$this->view->assign('division', $division);
	}
}
?>