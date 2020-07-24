<?php 
	add_action( 'wp_enqueue_style', 'et-builder-modules-style', 19 );
	add_action( 'wp_enqueue_scripts', 'divi_child_enqueue_styles', 20 );

	function divi_child_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/dist/css/theme-style.min.css' );
		wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/dist/js/theme.min.js' ); 
	}

	//Remove Projects folder in DIVI
	add_filter( 'et_project_posttype_args', 'ds_et_project_posttype_args', 10, 1 );
	function ds_et_project_posttype_args( $args ) {
		return array_merge( $args, array(
			'public'              => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => false,
			'show_in_nav_menus'   => false,
			'show_ui'             => false
		));
	}	
	
	//Shortcode for get_template_part()
	//Usage [ds_get_template slug="partials/content" name="post"]
	function get_template_shortcode($attr) {
			if(!empty($attr['slug'])){
				if(!empty($attr['name'])){
					$slug = $attr['slug'];
					$name = $attr['name'];
					ob_start();
					get_template_part("{$slug}","{$name}");
					$local_template = ob_get_clean();
				}else{
					$slug = $attr['slug'];
					ob_start();
					get_template_part("{$slug}");
					$local_template = ob_get_clean();
				}
			}else{
				$local_template = 'Error on using the shortcode. Slug should not be empty!';
			}
		return $local_template;
	}

	add_shortcode('ds_get_template', 'get_template_shortcode');
 ?>