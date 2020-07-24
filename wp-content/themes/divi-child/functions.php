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
	/***
*
* Change WordPress defaul login logo and link
*/
 
add_filter('login_headerurl' , function(){
    return home_url();
});
 
add_action( 'login_enqueue_scripts', function(){
  
    $style = ' <style>
                    body.login.login-action-login{
                        background: #332E2D;
                    }
                    #login h1 a, .login h1 a {
                        background-image: url('.(!empty(et_get_option( 'divi_logo' )) ? et_get_option( 'divi_logo' ) : '').');
                        width: 100%;
                        height: 50px;
                        background-size: contain;
                        background-repeat: no-repeat;
                        padding-bottom: 0;
                    }
                </style>';
    echo $style;
});	
	
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