<?php
$newPageColumns = array(
	'tx_downloadcenter_product_id' => array (
		'exclude' => 1,
		'label' => 'Link DownloadCenter Product',
		'config' => array (
			'type' => 'select',
			'items' => array(
				array('', -1)
			),
			'foreign_table' => 'tx_szdownloadcenter_domain_model_product',
			'size' => '10',
			'maxitems' => '1',
			'minitems' => '0',
			'wizards' => Array(
				'_PADDING' => 12,
				'_VALIGN' => 'middle',
				'suggest' => array(
					'type' => 'suggest'
				),
			),
		),
	),
);