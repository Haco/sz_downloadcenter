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
 * @package SzDownloadcenter
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Approval extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Sort
	 *
	 * @var int
	 */
	protected $sorting;

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Label
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $label;

	/**
	 * Icon
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $icon;

	/**
	 * Image
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $image;

	/**
	 * falIcon
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy
	 * @lazy
	 */
	protected $falIcon = NULL;

	/**
	 * falImage
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy
	 * @lazy
	 */
	protected $falImage = NULL;

	/**
	 * @param integer $sort
	 */
	public function setSorting($sort) {
		$this->sorting = $sort;
	}

	/**
	 * @return integer
	 */
	public function getSorting() {
		return $this->sorting;
	}

	/**
	 * @param string $icon
	 */
	public function setIcon($icon) {
		$this->icon = $icon;
	}

	/**
	 * @return string
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getFalIcon() {
		return $this->falIcon;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $falIcon
	 */
	public function setFalIcon(\TYPO3\CMS\Extbase\Domain\Model\FileReference $falIcon = NULL) {
		$this->falIcon = $falIcon;
	}

	/**
	 * @param string $image
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * @return string
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getFalImage() {
		return $this->falImage;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $falImage
	 */
	public function setFalImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $falImage = NULL) {
		$this->falImage = $falImage;
	}

	/**
	 * @param string $label
	 */
	public function setLabel($label) {
		$this->label = $label;
	}

	/**
	 * @return string
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

}
?>