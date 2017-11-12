<?php
class Submenu {
 
    private $submenu_view;

    public function __construct( $submenu_view ) {
        $this->submenu_view = $submenu_view;
    }

    public function init() {    
        add_action( 'admin_menu', array( $this, 'add_options_page' ) );
    }

    public function add_options_page() {
        add_management_page(
            'Backlinks Projects',
            'BM Projects',
            'manage_options',
            'bm-projects',
            array( $this->submenu_view, 'renderBMProjects' )
        );
    }
}