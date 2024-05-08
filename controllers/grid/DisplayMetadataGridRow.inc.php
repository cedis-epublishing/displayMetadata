<?php

/**
 * @file plugins/generic/displayMetadata/controllers/grid/DisplayMetadataGridRow.inc.php
 *
 * Copyright (c) 2024 Universitätsbibliothek Freie Universität Berlin
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class DisplayMetadataGridRow
 * @ingroup plugins_generic_displayMetadata
 *
 * @brief Handle DisplayMetadata grid row requests.
 */

import('lib.pkp.classes.controllers.grid.GridRow');

class DisplayMetadataGridRow extends GridRow {

	/**
	 * Constructor
	 */
	function __construct($readOnly = false) {
		parent::__construct();
	}

	//
	// Overridden template methods
	//
	/**
	 * @copydoc GridRow::initialize()
	 */
	function initialize($request, $template = null) {
		parent::initialize($request, $template);
		$objectId = $this->getId();
		if (!empty($objectId)) {
			$router = $request->getRouter();
		}
	}
}

?>
