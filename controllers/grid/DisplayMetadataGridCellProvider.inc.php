 <?php

/**
 * @file plugins/generic/displayMetadata/controllers/grid/DisplayMetadataGridCellProvider.inc.php
 *
 * Copyright (c) 2024 Universitätsbibliothek Freie Universität Berlin
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class DisplayMetadataGridCellProvider
 * @ingroup plugins_generic_displayMetadata
 *
 * @brief Class for a cell provider to display information about DisplayMetadata items
 */

import('lib.pkp.classes.controllers.grid.GridCellProvider');

class DisplayMetadataGridCellProvider extends GridCellProvider {

	//
	// Template methods from GridCellProvider
	//

	/**
	 * Extracts variables for a given column from a data element
	 * so that they may be assigned to template before rendering.
	 *
	 * @copydoc GridCellProvider::getTemplateVarsFromRowColumn()
	 */
	function getTemplateVarsFromRowColumn($row, $column) {
		$displayMetadataItem = $row->getData();
		switch ($column->getId()) {
			case 'submissionId':
				return array('label' => $displayMetadataItem['submissionId']);
			case 'doi':
				return array('label' => $displayMetadataItem['doi']);
			case 'licenseUrl':
				return array('label' => $displayMetadataItem['licenseUrl']);
			case 'datePublished':
				return array('label' => $displayMetadataItem['datePublished']);
			case 'locale':
				return array('label' => $displayMetadataItem['locale']);				
		}
	}
}

?>
