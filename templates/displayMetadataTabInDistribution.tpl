{**
 * plugins/generic/displayMetadata/templates/settingsForm.tpl
 *
 * Copyright (c) 2024 Universitätsbibliothek Freie Universität Berlin
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Display metadata plugin settings form template
 *
 *}

<tab id="displayMetadata" label="{translate key="plugins.generic.displayMetadata.tabTitle"}">

	{capture assign="displayMetadataGridUrl"}
	{url router=$smarty.const.ROUTE_COMPONENT component="plugins.generic.displayMetadata.controllers.grid.DisplayMetadataGridHandler" op="fetchGrid" escape=false}
	{/capture}
	
	{load_url_in_div id="displayMetadataGridContainer" url=$displayMetadataGridUrl}
	
</tab>
