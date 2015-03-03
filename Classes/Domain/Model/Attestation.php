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
class Attestation extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Identification
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $identification;

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Approval
	 * @var \Ecom\SzDownloadcenter\Domain\Model\Approval
	 */
	protected $approval;

	/**
	 * @param \Ecom\SzDownloadcenter\Domain\Model\Approval $approval
	 */
	public function setApproval(\Ecom\SzDownloadcenter\Domain\Model\Approval $approval) {
		$this->approval = $approval;
	}

	/**
	 * @return \Ecom\SzDownloadcenter\Domain\Model\Approval
	 */
	public function getApproval() {
		return $this->approval;
	}

	/**
	 * @param string $identification
	 */
	public function setIdentification($identification) {
		$this->identification = $identification;
	}

	/**
	 * @return string
	 */
	public function getIdentification() {
		return $this->identification;
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