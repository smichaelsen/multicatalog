<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_multicatalog_product'] = array(
	'ctrl' => $TCA['tx_multicatalog_product']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,starttime,endtime,fe_group,code,title,description,pictures,price'
	),
	'feInterface' => $TCA['tx_multicatalog_product']['feInterface'],
	'columns' => array(
		'hidden' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
				'default' => '0'
			)
		),
		'starttime' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'date',
				'default' => '0',
			)
		),
		'endtime' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'date',
				'default' => '0',
				'range' => array(
					'upper' => mktime(3, 14, 7, 1, 19, 2038),
					'lower' => mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		'l18n_parent' => Array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => Array(
				'type' => 'select',
				'items' => Array(
					Array('', 0),
				),
				'foreign_table' => 'tx_multicatalog_product',
				'foreign_table_where' => 'AND tx_multicatalog_product.uid=###REC_FIELD_l18n_parent### AND tx_multicatalog_product.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => Array(
			'config' => array(
				'type' => 'passthrough'
			)
		),
		'sys_language_uid' => Array(
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => Array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'AND hidden = 0 ORDER BY sys_language.title',
				'items' => Array(
					Array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					Array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				)
			)
		),
		't3ver_label' => Array(
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => Array(
				'type' => 'none',
				'cols' => 27
			)
		),
		'code' => array(
			'label' => 'LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.code',
			'config' => array(
				'type' => 'input',
				'size' => '10',
			)
		),
		'title' => array(
			'label' => 'LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required',
			)
		),
		'description' => array(
			'label' => 'LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.description',
			'config' => array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '7',
				'wizards' => array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly' => 1,
						'type' => 'script',
						'title' => 'Full screen Rich Text Editing',
						'icon' => 'wizard_rte2.gif',
						'script' => 'wizard_rte.php',
					),
				),
			)
		),
		'teaser' => array(
			'label' => 'LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.teaser',
			'config' => array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '4',
			),
		),
		'pictures' => array(
			'label' => 'LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.pictures',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => 'gif,png,jpeg,jpg',
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/tx_multicatalog',
				'show_thumbs' => 1,
				'size' => 10,
				'minitems' => 0,
				'maxitems' => 10,
			)
		),
		'pictures_alt' => array(
			'label' => 'LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.pictures_alt',
			'config' => array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '4',
			),
		),
		'price' => array(
			'label' => 'LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.price',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'default' => '0.00',
				'eval' => 'double2',
			)
		),
		'category' => array(
			'label' => 'LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_category.category',
			'config' => array(
				'type' => 'select',
				// TODO: Implement user func to display oiginal language id's but current language labels
				'foreign_table' => 'tx_multicatalog_category',
				'foreign_table_where' => 'AND tx_multicatalog_category.pid=###CURRENT_PID### AND tx_multicatalog_category.category=0 AND sys_language_uid = 0 ORDER BY tx_multicatalog_category.name',
				'size' => 4,
				'minitems' => 0,
				'maxitems' => 99,
			)
		),
		'highlight' => array(
			'label' =>'LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.highlight',
			'config' => array(
				'type' => 'check'
			)
		)
	),
	'types' => array(
		'0' => array('showitem' => '
			--div--;LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.tabs.general,
				sys_language_uid;;2,
				code, title;;;;2-2-2,
				highlight,
				description;;;richtext[]:rte_transform[imgpath=uploads/tx_multicatalog/rte/];3-3-3,
				pictures,
				pictures_alt,
				price,
			--div--;LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.tabs.access,
				hidden,starttime,endtime,fe_group
		')
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group'),
		'2' => array('showitem' => 't3ver_label,l18n_parent'),
	)
);

$_EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['multicatalog']);
// Add Articles
if ($_EXTCONF['use_articles']) {
	$tempColumns = array(
		'articles' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.articles',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_multicatalog_article',
				'foreign_sortby' => 'sorting',
				'foreign_field' => 'irre_parentid',
				'foreign_table_field' => 'irre_parenttable',
				'maxitems' => 100,
				'appearance' => array(
					'showSynchronizationLink' => 0,
					'showAllLocalizationLink' => 0,
					'showPossibleLocalizationRecords' => 0,
					'showRemovedLocalizationRecords' => 0,
					'expandSingle' => 0,
					'useSortable' => 1
				),
				'behaviour' => array(
				),
			)
		),
	);
	t3lib_extMgm::addTCAcolumns('tx_multicatalog_product', $tempColumns, 1);
	t3lib_extMgm::addToAllTCAtypes('tx_multicatalog_product', '--div--;LLL:EXT:multicatalog/Resources/Private/Language/locallang_db.xml:tx_multicatalog_product.tabs.articles,articles', '', 'after:price');
}
if ($_EXTCONF['category_records']) {
	t3lib_extMgm::addToAllTCAtypes('tx_multicatalog_product', 'category', '', 'before:code');
}
// Add teaser (RTE or plain)
$teaser = 'teaser';
if ($_EXTCONF['teaser_rte']) {
	$teaser .= ';;;richtext[]:rte_transform[mode=ts_css|imgpath=uploads/tx_multicatalog/rte/];3-3-3';
}
t3lib_extMgm::addToAllTCAtypes('tx_multicatalog_product', $teaser, '', 'before:description');

?>