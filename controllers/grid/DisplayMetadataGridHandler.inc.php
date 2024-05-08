<?php

/**
 * @file plugins/generic/displayMetadata/controllers/grid/DisplayMetadataGridHandler.inc.php
 *
 * Copyright (c) 2024 Universitätsbibliothek Freie Universität Berlin
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class displayMetadataGridHandler
 * @ingroup plugins_generic_displayMetadata
 *
 * @brief Handle displayMetadata management grid requests.
 */

import('lib.pkp.classes.controllers.grid.GridHandler');
import('plugins.generic.displayMetadata.controllers.grid.DisplayMetadataGridRow');
import('plugins.generic.displayMetadata.controllers.grid.DisplayMetadataGridCellProvider');

class DisplayMetadataGridHandler extends GridHandler {
	static $plugin;

	/**
	 * Constructor
	 */
	function __construct() {		
		parent::__construct();
		$this->addRoleAssignment(
			array(ROLE_ID_MANAGER),
			array('fetchGrid', 'fetchRow')
		);
	}

	//
	// Getters/Setters
	//
	/**
	 * Set the DisplayMetadata plugin.
	 * @param $plugin DisplayMetadataPlugin
	 */
	static function setPlugin($plugin) {
		self::$plugin = $plugin;
	}

	//
	// Overridden template methods
	//
 	/**
	 * @copydoc PKPHandler::authorize()
	 */
	function authorize($request, &$args, $roleAssignments) {
		import('lib.pkp.classes.security.authorization.ContextAccessPolicy');
		$this->addPolicy(new ContextAccessPolicy($request, $roleAssignments));
		return parent::authorize($request, $args, $roleAssignments);
	}

	/**
	 * @copydoc Gridhandler::initialize()
	 */
	function initialize($request, $args = null) {
		parent::initialize($request, $args);
		$context = $request->getContext();

		// Set the grid details.
		$this->setTitle('plugins.generic.displayMetadata.management.gridTitle');
		$this->setEmptyRowText('plugins.generic.displayMetadata.noneCreated');

		$gridData = null;
		
		$publishedSubmissions = Services::get('submission')->getMany([
			'contextId' => $context->getId(),
			'status' => STATUS_PUBLISHED,
		]);	
				
		$gridData = array();
		foreach ($publishedSubmissions as $submission) {
			$publicationDao = DAORegistry::getDAO('PublicationDAO');
			$publication = $publicationDao->getById($submission->getData('currentPublicationId'));
			//$publicationLocale = ($submission->getData('locale')) ? $submission->getData('locale') : 'en_US';
			//$locale = AppLocale::getLocale() ? AppLocale::getLocale() : 'en_US';
			
			$gridData[] = array(
				'submissionId' => $submission->getId(),
				'doi' => $publication->getData('pub-id::doi') ? $publication->getData('pub-id::doi') : '---',
				'licenseUrl' => $publication->getData('licenseUrl') ? $publication->getData('licenseUrl') : '---',
				'locale' => $submission->getData('locale') ,
				'datePublished' => $submission->getDatePublished() 				

			);
		}	
		//krsort($gridData);

		$this->setGridDataElements($gridData);

		// Columns
		$cellProvider = new DisplayMetadataGridCellProvider();
		$this->addColumn(new GridColumn(
			'submissionId',
			'plugins.generic.displayMetadata.itemSubmissionId',
			null,
			'controllers/grid/gridCell.tpl',
			$cellProvider
		));
		$this->addColumn(new GridColumn(
			'doi',
			'plugins.generic.displayMetadata.itemDOI',
			null,
			'controllers/grid/gridCell.tpl',
			$cellProvider
		));
		$this->addColumn(new GridColumn(
			'licenseUrl',
			'plugins.generic.displayMetadata.itemLicenseUrl',
			null,
			'controllers/grid/gridCell.tpl',
			$cellProvider
		));		
		$this->addColumn(new GridColumn(
			'datePublished',
			'plugins.generic.displayMetadata.itemDatePublished',
			null,
			'controllers/grid/gridCell.tpl',
			$cellProvider
		));
		$this->addColumn(new GridColumn(
			'locale',
			'plugins.generic.displayMetadata.itemLocale',
			null,
			'controllers/grid/gridCell.tpl',
			$cellProvider
		));

	}

	//
	// Overridden methods from GridHandler
	//
	/**
	 * @copydoc Gridhandler::getRowInstance()
	 */
	function getRowInstance() {
		return new DisplayMetadataGridRow();
	}
	
}

?>
