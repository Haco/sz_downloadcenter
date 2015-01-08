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
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * the localization parent
	 * @var \Ecom\SzDownloadcenter\Domain\Model\Product
	 */
	protected $localization = NULL;

	/**
	 * the localization parent
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Certification> $certifications
	 */
	protected $certifications;

	/**
	 * the localization parent
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Attestation> $attestations
	 */
	protected $attestations;

	/**
	 * @var integer
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
	 * falImage
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy
	 * @lazy
	 */
	protected $falImage = NULL;

	/**
	 * Pagelink
	 *
	 * @var string
	 */
	protected $image;

	/**
	 * Text
	 *
	 * @var string
	 */
	protected $text;

	/**
	 * Zone
	 *
	 * @var integer
	 */
	protected $zone;

	/**
	 * Division
	 *
	 * @var integer
	 */
	protected $division;

	/**
	 * Pagelink
	 *
	 * @var string
	 */
	protected $link;

	/**
	 * Linktext
	 *
	 * @var string
	 */
	protected $linktext;

	/**
	 * Discontinued
	 *
	 * @var boolean
	 */
	protected $discontinued = FALSE;

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
		$this->certifications = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->attestations = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * @param \Ecom\SzDownloadcenter\Domain\Model\Product $localization
	 */
	public function setLocalization(\Ecom\SzDownloadcenter\Domain\Model\Product $localization) {
		$this->localization = $localization;
	}

	/**
	 * @return \Ecom\SzDownloadcenter\Domain\Model\Product
	 */
	public function getLocalization() {
		return $this->localization;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Attestations> $attestations
	 */
	public function setAttestations(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attestations) {
		$this->attestations = $attestations;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Attestations> $attestations
	 */
	public function getAttestations() {
		return $this->attestations;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Certification> $certification
	 */
	public function setCertifications(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $certifications) {
		$this->certifications = $certifications;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Certification>
	 */
	public function getCertifications() {
		return $this->certifications;
	}

	/**
	 * @param int $zone
	 */
	public function setZone($zone) {
		$this->zone = $zone;
	}

	/**
	 * @return int
	 */
	public function getZone() {
		return $this->zone;
	}

	/**
	 * @param int $division
	 */
	public function setDivision($division) {
		$this->division = $division;
	}

	/**
	 * @return int
	 */
	public function getDivision() {
		return $this->division;
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
	 * Returns the image
	 *
	 * @return string $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param string $image
	 * @return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * Returns the text
	 *
	 * @return string $text
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * Sets the text
	 *
	 * @param string $text
	 * @return void
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * Returns the link
	 *
	 * @return string $link
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Sets the link
	 *
	 * @param string $link
	 * @return void
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	/**
	 * Returns the linktext
	 *
	 * @return string $linktext
	 */
	public function getLinktext() {
		return $this->linktext;
	}

	/**
	 * Sets the linktext
	 *
	 * @param string $linktext
	 * @return void
	 */
	public function setLinktext($linktext) {
		$this->linktext = $linktext;
	}

	/**
	 * Returns the discontinued
	 *
	 * @return boolean $discontinued
	 */
	public function getDiscontinued() {
		return $this->discontinued;
	}

	/**
	 * Sets the discontinued
	 *
	 * @param boolean $discontinued
	 * @return void
	 */
	public function setDiscontinued($discontinued) {
		$this->discontinued = $discontinued;
	}

	/**
	 * Returns the boolean state of discontinued
	 *
	 * @return boolean
	 */
	public function isDiscontinued() {
		return $this->getDiscontinued();
	}

	/**
	 * @param int $sorting
	 */
	public function setSorting($sorting) {
		$this->sorting = $sorting;
	}

	/**
	 * @return int
	 */
	public function getSorting() {
		return $this->sorting;
	}

}
?>