<?php
namespace Ecom\SzDownloadcenter\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Georg Ringer <typo3@ringerge.org>
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
 * This view helper returns the url of current page
 *
 * @copyright  2012-2013 Copyright belongs to the respective authors
 * @license    http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FilesizeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Renders the size of a file using t3lib_div::formatSize
     *
     * @param string  $file          Path to the file
     * @param integer $size          File size if known (@FAL)
     * @param string  $labels        Labels for bytes, kilo, mega and giga separated by vertical bar (|) and possibly encapsulated in "". Eg: " | K| M| G" (which is the default value)
     * @param string  $decPoint      Sets the separator for the decimal point.
     * @param string  $thousandsSep  Sets the thousands separator.
     * @param boolean $hideError     Define if an error should be displayed if file not found
     *
     * @return string
     *
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException
     */
    public function render ($file = '', $size = 0, $labels = '', $decPoint = '.', $thousandsSep = ',', $hideError = FALSE) {
        if (!is_file($file) && $size === 0) {
            $errorMessage = sprintf('Given file "%s" for %s is not valid', htmlspecialchars($file), get_class());
            \TYPO3\CMS\Core\Utility\GeneralUtility::devLog($errorMessage, 'news', \TYPO3\CMS\Core\Utility\GeneralUtility::SYSLOG_SEVERITY_WARNING);

            if (!$hideError) {
                throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException('Given file is not a valid file: ' . htmlspecialchars($file));
            }
        }

        $fileSize = $this->formatSize($size ?: filesize($file), $labels, $decPoint, $thousandsSep);

        return $fileSize;
    }

    /**
     * Formats the input integer $sizeInBytes as bytes/kilobytes/megabytes (-/K/M)
     *
     * @param integer $sizeInBytes   Number of bytes to format.
     * @param string  $labels        Labels for bytes, kilo, mega and giga separated by vertical bar (|) and possibly encapsulated in "". Eg: " | K| M| G" (which is the default value)
     * @param string  $decPoint      Sets the separator for the decimal point.
     * @param string  $thousandsSep  Sets the thousands separator.
     *
     * @return string Formatted representation of the byte number, for output.
     */
    public static function formatSize($sizeInBytes, $labels = '', $decPoint = '.', $thousandsSep = ',') {
        // Set labels:
        if (strlen($labels) === 0) {
            $labels = ' | K| M| G';
        } else {
            $labels = str_replace('"', '', $labels);
        }
        $labelArr = explode('|', $labels);

        // Find size:
        if ($sizeInBytes > 900) {
            if ($sizeInBytes > 900000000) {   // GB
                $val = $sizeInBytes / (1024 * 1024 * 1024);
                return number_format($val, (($val < 20) ? 1 : 0), $decPoint, $thousandsSep) . $labelArr[3];
            }
            elseif ($sizeInBytes > 900000) {  // MB
                $val = $sizeInBytes / (1024 * 1024);
                return number_format($val, (($val < 20) ? 1 : 0), $decPoint, $thousandsSep) . $labelArr[2];
            } else { // KB
                $val = $sizeInBytes / (1024); // KB
                return number_format($val, (($val < 20) ? 1 : 0), $decPoint, $thousandsSep) . $labelArr[1];
            }
        } else { // Bytes
            return $sizeInBytes . $labelArr[0];
        }
    }

}
?>