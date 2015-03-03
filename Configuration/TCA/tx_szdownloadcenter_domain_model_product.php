<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,image,text,link,linktext,discontinued,files,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('sz_downloadcenter') . 'Resources/Public/Icons/tx_szdownloadcenter_domain_model_product.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, image, text, link, linktext, discontinued',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,
			title, fal_image;;2, text, link, linktext, discontinued,
			--div--;LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:setcard, certifications, attestations, zone, division,
			--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'2' => array('showitem' => 'image')
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_szdownloadcenter_domain_model_product',
				'foreign_table_where' => 'AND tx_szdownloadcenter_domain_model_product.pid=###CURRENT_PID### AND tx_szdownloadcenter_domain_model_product.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'fal_image' => array(
			'label'   => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.fal_image',
			'exclude' => 0,
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('fal_image', array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
				// custom configuration for displaying fields in the overlay/reference table
				// to use the imageoverlayPalette instead of the basicoverlayPalette
				'foreign_types' => array(
					'0' => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					)
				),
				'maxitems' => 1
			), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
		),
		'image' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.image',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_szdownloadcenter',
				'show_thumbs' => 1,
				'size' => 5,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
			),
		),
		'text' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.text',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
		'link' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.link',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
				'wizards'  => array(
					'_PADDING' => 5,
					'link'	 => array(
						'type'		 => 'popup',
						'title'		=> 'Link',
						'icon'		 => 'link_popup.gif',
						'script'	   => 'browse_links.php?mode=wizard',
						'params' => array (
							'target' => '_blank',
							'blindLinkOptions' => 'file,mail,spec,folder,upload,media_upload',
						),
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				),
			),
		),
		'linktext' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.linktext',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'discontinued' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.discontinued',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'file' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		'attestations' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.attestations',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_szdownloadcenter_domain_model_attestation',
				'foreign_table_where' => 'AND NOT tx_szdownloadcenter_domain_model_attestation.deleted AND tx_szdownloadcenter_domain_model_attestation.sys_language_uid IN (-1,0) ORDER BY tx_szdownloadcenter_domain_model_attestation.approval, tx_szdownloadcenter_domain_model_attestation.identification',
				'MM' => 'tx_szdownloadcenter_product_attestation_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems'	  => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 10,
					'_VALIGN' => 'middle',
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1
						)
					)
				),
			),
		),
		'certifications' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.certifications',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_szdownloadcenter_domain_model_certification',
				'foreign_table_where' => 'AND NOT tx_szdownloadcenter_domain_model_certification.deleted AND tx_szdownloadcenter_domain_model_certification.sys_language_uid IN (-1,0) ORDER BY tx_szdownloadcenter_domain_model_certification.approval, tx_szdownloadcenter_domain_model_certification.identification',
				'MM' => 'tx_szdownloadcenter_product_certification_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems'	  => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 10,
					'_VALIGN' => 'middle',
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1
						)
					)
				),
			),
		),

		'zone' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.zone',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-', -1),
					array('0', 0),
					array('1', 1),
					array('2', 2),
					array('0/20', 3),
					array('1/21', 4),
					array('2/22', 5),
				),
				'size' => 1,
				'maxitems' => 1,
			),
		),
		'division' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_product.division',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-', -1),
					array('1', 1),
					array('2', 2),
				),
				'size' => 1,
				'maxitems' => 1,
			),
		),
	),
);

?>
