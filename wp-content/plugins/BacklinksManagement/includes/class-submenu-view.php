<?php

class Submenu_View {
	public function __construct( ) {
	}

    public function renderBMProjects() {
        include_once plugin_dir_path( __FILE__ ).'../admin/views/bmProjects.php';
    }
}