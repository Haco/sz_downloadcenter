<?php
namespace Ecom\SzDownloadcenter\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012-2013 Björn Christopher Bresser <bjoern.bresser@bjobre.de>
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

/**
 * This view helper handles parameter strings using typolink function of TYPO3.
 * It returns just the URL.
 *
 * @copyright  2012-2013 Copyright belongs to the respective authors
 * @license    http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class LanguageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


    /**
     * languageRepository
     *
     * @var \Ecom\SzDownloadcenter\Domain\Repository\LanguageRepository
     * @inject
     */
    protected $languageRepository;

    /**
     * Create a typolink with the given language.
     *
     * @param integer $languageId ID of the given language
     * @return string url
     */
    public function render($languageId) {
        $language = $this->languageRepository->findByUid($languageId);

        $flag = ($language !== NULL) ? $language->getFlag() : ($languageId == -1 ? 'multi' : 'default');

        return $flag;
    }
}
?>