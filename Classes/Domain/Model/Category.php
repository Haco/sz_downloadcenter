<?php
namespace Ecom\SzDownloadcenter\Domain\Model;

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
 * @package sz_downloadcenter
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * the localization parent
	 * @var \Ecom\SzDownloadcenter\Domain\Model\Category
	 */
	protected $localization = NULL;


	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Division
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $division;

	/**
	 * products
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Product>
	 */
	protected $products;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->products = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		if ($this->title === NULL) {
			return $this->getLocalization()->getTitle();
		}
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Sets the division
	 *
	 * @param integer $division
	 * @return void
	 */
	public function setDivision($division) {
		$this->division = $division;
	}

	/**
	 * Returns the division
	 *
	 * @return integer $division
	 */
	public function getDivision() {

		return $this->division;
	}

	/**
	 * @param \Ecom\SzDownloadcenter\Domain\Model\Category $localization
	 */
	public function setLocalization($localization) {
		$this->localization = $localization;
	}

	/**
	 * @return \Ecom\SzDownloadcenter\Domain\Model\Category
	 */
	public function getLocalization() {
		return $this->localization;
	}

	/**
	 * Adds a Product
	 *
	 * @param \Ecom\SzDownloadcenter\Domain\Model\Product $product
	 * @return void
	 */
	public function addProduct(\Ecom\SzDownloadcenter\Domain\Model\Product $product) {
		$this->products->attach($product);
	}

	/**
	 * Removes a Product
	 *
	 * @param \Ecom\SzDownloadcenter\Domain\Model\Product $productToRemove The Product to be removed
	 * @return void
	 */
	public function removeProduct(\Ecom\SzDownloadcenter\Domain\Model\Product $productToRemove) {
		$this->products->detach($productToRemove);
	}

	/**
	 * Returns the products
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Product> $products
	 */
	public function getProducts() {
		if ($this->products === NULL) {
			return $this->getLocalization()->getProducts();
		}
		return $this->products;
	}

	/**
	 * Sets the products
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Product> $products
	 * @return void
	 */
	public function setProducts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $products) {
		$this->products = $products;
	}

}
?>