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
class File extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * sys_language_uid
	 *
	 * @var integer
	 */
	protected $sysLanguageUid;

	/**
	 * @param int $sysLanguageUid
	 */
	public function setSysLanguageUid($sysLanguageUid) {
		$this->sysLanguageUid = $sysLanguageUid;
	}

	/**
	 * @return int
	 */
	public function getSysLanguageUid() {
		return $this->sysLanguageUid;
	}

	/**
	 * File
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $file;

	/**
	 * falFile
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy
	 * @lazy
	 */
	protected $falFile = NULL;

	/**
	 * Last editation
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $lastedit;

	/**
	 * Revision
	 *
	 * @var string
	 */
	protected $revision;

	/**
	 * fileCategory
	 *
	 * @var \Ecom\SzDownloadcenter\Domain\Model\FileCategory
	 */
	protected $fileCategory;

	/**
	 * products
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Product>
	 */
	protected $products;

	/**
	 * approval
	 *
	 * @var \Ecom\SzDownloadcenter\Domain\Model\Approval
	 */
	protected $approval;

	/**
	 * __construct
	 *
	 * @return void
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
	 * @param \Ecom\SzDownloadcenter\Domain\Model\Approval $approval
	 */
	public function setApproval($approval) {
		$this->approval = $approval;
	}

	/**
	 * @return \Ecom\SzDownloadcenter\Domain\Model\Approval
	 */
	public function getApproval() {
		return $this->approval;
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
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
	 * Returns the file
	 *
	 * @return string $file
	 */
	public function getFile() {
		if ($this->getFalFile() instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy)
			return $this->getFalFile()->_loadRealInstance()->getOriginalResource()->getPublicUrl();
		if ($this->getFalFile() instanceof \TYPO3\CMS\Extbase\Domain\Model\FileReference)
			return $this->getFalFile()->getOriginalResource()->getPublicUrl();
		return $this->file;
	}

	/**
	 * Sets the file
	 *
	 * @param string $file
	 * @return void
	 */
	public function setFile($file) {
		$this->file = $file;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy
	 */
	public function getFalFile() {
//		if (!is_object($this->falFile)) {
//			return null;
//		} elseif ($this->falFile instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
//			$this->falFile->_loadRealInstance();
//		}

//		return $this->falFile->getOriginalResource();
		return $this->falFile;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $falFile
	 */
	public function setFalFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $falFile = NULL) {
		$this->falFile = $falFile;
	}

	/**
	 * Returns the lastedit
	 *
	 * @return \DateTime $lastedit
	 */
	public function getLastedit() {
		return $this->lastedit;
	}

	/**
	 * Sets the lastedit
	 *
	 * @param \DateTime $lastedit
	 * @return void
	 */
	public function setLastedit($lastedit) {
		$this->lastedit = $lastedit;
	}

	/**
	 * Returns the revision
	 *
	 * @return string $revision
	 */
	public function getRevision() {
		return $this->revision;
	}

	/**
	 * Sets the revision
	 *
	 * @param string $revision
	 * @return void
	 */
	public function setRevision($revision) {
		$this->revision = $revision;
	}

	/**
	 * Returns the fileCategory
	 *
	 * @return \Ecom\SzDownloadcenter\Domain\Model\FileCategory $fileCategory
	 */
	public function getFileCategory() {
		return $this->fileCategory;
	}

	/**
	 * Sets the fileCategory
	 *
	 * @param \Ecom\SzDownloadcenter\Domain\Model\FileCategory $fileCategory
	 *
*@return void
	 */
	public function setFileCategory(\Ecom\SzDownloadcenter\Domain\Model\FileCategory $fileCategory) {
		$this->fileCategory = $fileCategory;
	}

	/**
	 * Returns the products
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\SzDownloadcenter\Domain\Model\Product> $products
	 */
	public function getProducts() {
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
