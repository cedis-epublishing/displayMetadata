<?php

/**
 * @defgroup plugins_generic_displayMetadata DisplayMetadataPlugin plugin
 */

/**
 * @file plugins/generic/displayMetadata/index.php
 *
 * Copyright (c) 2024 Universitätsbibliothek Freie Universität Berlin
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_generic_displayMetadata
 *
 * @brief Wrapper for DisplayMetadataPlugin plugin.
 *
 */

require_once('DisplayMetadataPlugin.inc.php');

return new DisplayMetadataPlugin();

?>
