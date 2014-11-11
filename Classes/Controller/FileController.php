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
class FileController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * fileRepository
	 *
	 * @var \Ecom\SzDownloadcenter\Domain\Repository\FileRepository
	 * @inject
	 */
	protected $fileRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$files = $this->fileRepository->findAll();
		$this->view->assign('files', $files);
	}

	/**
	 * action show
	 *
	 * @param \Ecom\SzDownloadcenter\Domain\Model\File $file
	 * @return void
	 */
	public function showAction(\Ecom\SzDownloadcenter\Domain\Model\File $file) {
		$this->view->assign('file', $file);
	}

}
?>