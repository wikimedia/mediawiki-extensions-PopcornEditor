<?php
/**
 * Wrapper to integrate SVG-edit in-browser vector graphics editor in MediaWiki.
 * http://www.mediawiki.org/wiki/Extension:PopcornEditor
 *
 * Currently using a lot of base code form old SVGEdit extension.
 *
 * @copyright 2010-2016 Brion Vibber <brion@pobox.com>
 *
 * MediaWiki-side code is GPL
 */

$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'name'           => 'PopcornEditor',
	'author'         => array( 'Brion Vibber' ),
	'url'            => 'https://www.mediawiki.org/wiki/Extension:PopcornEditor',
	'descriptionmsg' => 'popcorn-desc',
);

$wgMessagesDirs['PopcornEditor'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['PopcornEditor'] =  dirname(__FILE__) . '/PopcornEditor.i18n.php';

$wgHooks['BeforePageDisplay'][] = 'PopcornEditorHooks::beforePageDisplay';
$wgHooks['MakeGlobalVariablesScript'][] = 'PopcornEditorHooks::makeGlobalVariablesScript';

$wgAutoloadClasses['PopcornEditorHooks'] = dirname( __FILE__ ) . '/PopcornEditor.hooks.php';

$myResourceTemplate = array(
	'localBasePath' => dirname( __FILE__ ) . '/modules',
	'remoteExtPath' => 'PopcornEditor/modules',
	'group' => 'ext.popcorn',
);
$wgResourceModules += array(
	'ext.popcorn.editor' => $myResourceTemplate + array(
		'scripts' => array(
			'ext.popcorn.embedapi.js',
			'ext.popcorn.formmultipart.js',
			'ext.popcorn.io.js',
			'ext.popcorn.editor.js',
		),
		'styles' => array(
			'ext.popcorn.editButton.css',
		),
		'messages' => array(
			'popcorn-summary-label',
			'popcorn-summary-default',
			'popcorn-editor-save-close',
			'popcorn-editor-close',
		),
		'dependencies' => array(
			'jquery.ui.resizable'
		)
	),
);
$wgResourceModules += array(
	'ext.popcorn.editButton' => $myResourceTemplate + array(
		'scripts' => array(
			'ext.popcorn.editButton.js',
		),
		'messages' => array(
			'popcorn-editbutton-edit',
			'popcorn-edit-tab',
			'popcorn-edit-tab-tooltip'
		),
		'dependencies' => array(
			'ext.popcorn.editor'
		)
	),
);

// Set this to point to editor.html
//
$wgPopcornEditorUrl = 'http://popcorn-editor.wmflabs.org/PopcornEditor/editor.html';

// Allow saving the popcorn JSON files
$wgFileExtensions[] = 'popcorn';

// @todo?
//$wgMediaHandlers['application/popcorn+json'] = 'PopcornEditorHandler';
