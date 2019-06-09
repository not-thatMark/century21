<?php

/**
 * Main backend controller for View.
 *
 * @since 2.6.4
 */
final class WPV_Admin {
	/**
	 * Initialize Views for backend.
	 *
	 * This is expected to be called during init.
	 *
	 * @since 2.6.4
	 */
	public static function initialize() {
		new self();
	}

	private function __construct() {
		$this->on_init();
	}

	private function __clone() { }


	private function on_init() {

		\OTGS\Toolset\Views\Controller\Upgrade::initialize();

		$admin_help = new WPV_Controller_Admin_Help();
		$admin_help->init();

		$this->init_view_editor_sections();
	}

	/**
	 * Initialize the View Editor sections when needed.
	 */
	private function init_view_editor_sections() {
		if (
			false !== toolset_getget( 'page', false ) &&
			in_array(
				toolset_getget( 'page', false ),
				array(
					'views-editor',
					'view-archives-editor',
				),
				true
			)
		) {
			// Create View editor section instances.
			$wpv_editor_section_view_wrapper = new WPV_Editor_Section_View_Wrapper();

			// Initialize View editor sections.
			$wpv_editor_section_view_wrapper->add_hooks();
		}
	}
}
