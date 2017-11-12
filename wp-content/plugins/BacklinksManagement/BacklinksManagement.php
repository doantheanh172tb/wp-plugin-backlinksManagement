<?php

/**
 *
 * @since             1.0.0
 * @package           BacklinksManagement
 *
 * @wordpress-plugin
 * Plugin Name:       BacklinksManagement
 * Description:       BacklinksManagement.
 * Version:           1.0.0
 * Author:            doantheanh172tb@gmail.com
 */

if ( ! class_exists('BacklinksManagement') ) :

class BacklinksManagement {
    public function __construct() {
        if ( !defined( 'WPINC' )) {
            die;
        }

        foreach ( glob( plugin_dir_path( __FILE__ ) . 'includes/*.php' ) as $file ) {
            include_once $file;
        }

        add_action( 'plugins_loaded' , array($this, 'backlinksManagement_loaded'));
    }

    public function backlinksManagement_loaded(){
    	$serializer = new Serializer();
        $serializer->init();

        $deserializer = new Deserializer();
        $submenu = new Submenu( new Submenu_View( $deserializer) );
        $submenu->init();

        add_action('rest_api_init', function(){
			register_rest_route('api-bm', '/allProject', array(
				'methods' => 'GET',
				'callback' => array($this, 'loadAllProject')
			));
        });
        
        add_action('rest_api_init', function(){
			register_rest_route('api-bm', '/projectForm', array(
				'methods' => 'GET',
                'callback' => array($this, 'projectForm')
			));
        });
        
        add_action('rest_api_init', function(){
			register_rest_route('api-bm', '/addOrEditProject', array(
				'methods' => 'POST',
				'callback' => array($this, 'addOrEditProject')
			));
		});
        
        add_action('rest_api_init', function(){
			register_rest_route('api-bm', '/deleteProject', array(
				'methods' => 'POST',
				'callback' => array($this, 'deleteProject')
			));
		});
    }

    function loadAllProject(){
        global $wpdb;
        $projects = $wpdb->get_results( 'SELECT * FROM bm_projects', ARRAY_A );
        //remove empty device
        $projects = array_filter($projects, function($project) { return !empty($project) || $project == ""; });
        return array("data"=>$projects);
    }

    function projectForm($data){
        // var_dump
        if($data['id']){
            global $wpdb;
            $results = $wpdb->get_row( 'SELECT * FROM bm_projects WHERE id = '.$data['id'], ARRAY_A );
            return $results;
        }
        return $data['id'];
    }

    function addOrEditProject($request){
        $data = $request->get_params();

        global $wpdb;
        if($data['id']){
            $result = $wpdb->update( 
                'bm_projects', 
                array(
                    'url' => $data['url'],
                    'name' => $data['name'],
                    'description' => $data['description'],
                    // 'modifytime' => $now->getTimestamp()
                ),
                array( 'id' => $data['id'] )
            );
        }else{
            $result = $wpdb->insert( "bm_projects", array(
                'url' => $data['url'],
                'name' => $data['name'],
                'description' => $data['description'],
                // 'createtime' => $now->getTimestamp(),
                // 'modifytime' => $now->getTimestamp()
            ));
        }

	    if ( ! $result )
			return array(
                "success" => false,
                "data" => null
            );

            return array(
                "success" => true,
            );
    }

    function deleteProject($request){
        $id_arr = $request->get_param("id");
        global $wpdb;
        $result = $wpdb->query( "DELETE FROM bm_projects WHERE id IN($id_arr)" );
        
        if ( ! $result )
        return array(
            "success" => false,
            "data" => null
        );

        return array(
            "success" => true,
        );
    }


}

new BacklinksManagement;
endif;