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
class CategoryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * categoryRepository
	 *
	 * @var \Ecom\SzDownloadcenter\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$categories = $this->categoryRepository->findAll();
		$this->view->assign('categories', $categories);
	}

	/**
	 * action show
	 *
	 * @param \Ecom\SzDownloadcenter\Domain\Model\Category $category
	 * @return void
	 */
	public function showAction(\Ecom\SzDownloadcenter\Domain\Model\Category $category) {
		$this->view->assign('category', $category);
	}

	/**
	 * action getByDivision
	 * @return mixed
	 */
	public function getByDivisionAction() {
		$divisionId = $this->request->getArgument('divisionId');
		$categories = $this->categoryRepository->findByDivision($divisionId);

		$this->view->assign('categories', $categories);

		$content = $this->view->render();

		return json_encode(array(
			'success' => TRUE,
			'content' => $content
		));
	}

	/**
	 * action getProductList
	 * @return mixed
	 */
	public function getProductListAction() {
		$arguments = $this->request->getArguments();
		$categoryId = $arguments['categoryId'];
		$discontinued = $arguments['discontinued'];

		$categories = $this->categoryRepository->findByUid($categoryId);
		$products = $categories->getProducts();

		if (count($products) === 0)
			$products = $categories->getLocalization()->getProducts();

		$productActiveArr = array();
		$productDiscontinued = array();
		foreach ($products as $k => $product) {
			if ($product->isDiscontinued()) {
				$productDiscontinued[ $product->getSorting() ] = $product;
			} else {
				$productActiveArr[ $product->getSorting() ] = $product;
			}
		}
		ksort($productActiveArr);
		ksort($productDiscontinued);
		$productArr = array_merge($productActiveArr, $productDiscontinued);

		$this->view->assign('products', $productArr);
		$this->view->assign('discontinued', $discontinued);
		$content = $this->view->render();

		return json_encode(array(
			'success' => TRUE,
			'content' => $content
		));

	}

}
?>