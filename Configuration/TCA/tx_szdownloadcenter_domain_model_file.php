<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_file',
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
		'searchFields' => 'title,fal_file,lastedit,revision,file_category,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('sz_downloadcenter') . 'Resources/Public/Icons/tx_szdownloadcenter_domain_model_file.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, fal_file, file, file_category, lastedit, revision',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,
			title, fal_file;;2, lastedit, revision, file_category, approval, products,
			--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'2' => array('showitem' => 'file')
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
				'foreign_table' => 'tx_szdownloadcenter_domain_model_file',
				'foreign_table_where' => 'AND tx_szdownloadcenter_domain_model_file.pid=###CURRENT_PID### AND tx_szdownloadcenter_domain_model_file.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_file.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'file' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_file.file',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file_reference',
				'allowed' => '*',
				'disallowed' => 'php',
				'size' => 5,
			),
		),
	'fal_file' => array(
		'label'   => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_file.fal_file',
		'exclude' => 0,
		'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'fal_file',
			array(
				'minitems' => 1,
				'maxitems' => 1,
				'appearance' => array(
					'enabledControls' => array(
						'dragdrop' => FALSE,
						'localize' => FALSE,
					),
				),
			)
		),
	),
		'lastedit' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_file.lastedit',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'revision' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_file.revision',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'file_category' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_file.file_category',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_szdownloadcenter_domain_model_filecategory',
				'foreign_table_where' => 'AND tx_szdownloadcenter_domain_model_filecategory.sys_language_uid IN (-1,0) AND tx_szdownloadcenter_domain_model_filecategory.deleted=0 ORDER BY tx_szdownloadcenter_domain_model_filecategory.title',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'products' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_file.products',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_szdownloadcenter_domain_model_product',
				'MM' => 'tx_szdownloadcenter_file_product_mm',
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
				)
			),
		),

		'approval' => array(
			'l10n_mode' => 'mergeIfNotBlank',
			'exclude' => 0,
			'label' => 'LLL:EXT:sz_downloadcenter/Resources/Private/Language/locallang_db.xml:tx_szdownloadcenter_domain_model_attestation.approval',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_szdownloadcenter_domain_model_approval',
				'items' => array(
					array('', 0),
				),
				'size' => 1,
				'autoSizeMax' => 1,
				'maxitems' => 1,
				'multiple' => 0,
			),
		),
	),
);

?>
