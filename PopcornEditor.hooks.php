<?php
/**
 * PopcornEditor extension: hooks
 * @copyright 2010-2016 Brion Vibber <brion@pobox.com>
 */

class PopcornEditorHooks {
	/* Static Methods */

	/**
	 * BeforePageDisplay hook
	 *
	 * Adds the modules to the page
	 *
	 * @param $out OutputPage output page
	 * @param $skin Skin current skin
	 */
	public static function beforePageDisplay( $out, $skin ) {
		$title = $out->getTitle();
		$modules = array();
		if( self::trigger( $title ) ) {
			$modules[] = 'ext.popcorn.editButton';
		}
		if ($modules) {
			$out->addModules($modules);
		}
		return true;
	}

	/**
	 * MakeGlobalVariablesScript hook
	 *
	 * Exports a setting if necessary.
	 *
	 * @param $vars array of vars
	 */
	public static function makeGlobalVariablesScript( &$vars ) {
		global $wgPopcornEditorUrl;
		$vars['wgPopcornEditorUrl'] = $wgPopcornEditorUrl;
		return true;
	}

	/**
	 * Should the editor links trigger on this page?
	 *
	 * @param Title $title
	 * @return boolean
	 */
	private static function trigger( $title ) {
		return $title && $title->getNamespace() == NS_FILE &&
			$title->userCan( 'edit' ) && $title->userCan( 'upload' ) &&
			preg_match( '/\.popcorn$/', $title->getText() );
	}

}
