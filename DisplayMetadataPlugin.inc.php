<?php

/**
 * @file plugins/generic/displayMetadata/DisplayMetadataPlugin.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class DisplayMetadataPlugin
 * @ingroup plugins_generic_displayMetadata
 * @brief Add displayMetadata data to the submission metadata and display them on the submission view page.
 *
 */

import('lib.pkp.classes.plugins.GenericPlugin');

class DisplayMetadataPlugin extends GenericPlugin {

	/**
	 * @copydoc Plugin::getName()
	 */
	function getName() {
		return 'DisplayMetadataPlugin';
    }

	/**
	 * @copydoc Plugin::getDisplayName()
	 */
    function getDisplayName() {
		return __('plugins.generic.displayMetadata.displayName');
    }

	/**
	 * @copydoc Plugin::getDescription()
	 */
    function getDescription() {
		return __('plugins.generic.displayMetadata.description');
    }

	/**
	 * @copydoc Plugin::register()
	 */
    function register($category, $path, $mainContextId = null) {

		$success = parent::register($category, $path, $mainContextId);
		if ($success && $this->getEnabled($mainContextId)) {

			$request = Application::get()->getRequest();
			$context = $request->getContext();

			HookRegistry::register('LoadComponentHandler', array($this, 'setupGridHandler'));
			HookRegistry::register('Template::Settings::distribution', array($this, 'callbackShowDistributionSettingsTabs'));

		}
		return $success;
	}

	/**
	 * Extend the website settings tabs to include objects for review tab
	 * @param $hookName string The name of the invoked hook
	 * @param $args array Hook parameters
	 * @return boolean Hook handling status
	 */
	function callbackShowDistributionSettingsTabs($hookName, $args) {
		$output =& $args[2];
		$templateMgr =& $args[1];
		$output .= $templateMgr->fetch($this->getTemplateResource('displayMetadataTabInDistribution.tpl'));	
		return false;
	}

	/**
	 * Permit requests to the DisplayMetadata grid handler
	 * @param $hookName string The name of the hook being invoked
	 * @param $args array The parameters to the invoked hook
	 */
	function setupGridHandler($hookName, $params) {
		$component =& $params[0];		
		if ($component == 'plugins.generic.displayMetadata.controllers.grid.DisplayMetadataGridHandler') {
			import($component);
			DisplayMetadataGridHandler::setPlugin($this);
			return true;
		}
		return false;
	}

}
?>
