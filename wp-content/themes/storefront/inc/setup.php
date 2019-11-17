<?php

/**

 * Enqueue scripts and styles.

**/
 
function athena_scripts() {

    // Styles

    // wp_enqueue_style( 'main-style', ASSETS_PATH.'css/main.css', array(), null );



    // Scripts

    // wp_enqueue_script( 'main-script', ASSETS_PATH.'js/main.js', array('jquery'), null, true );



    wp_localize_script( 'main-script1', 'wp_localize',

        array(

            'ajaxurl' => admin_url( 'admin-ajax.php' ),

            'homeurl' => get_home_url()

        )

    );

    wp_enqueue_script( 'main-script' );



}

add_action( 'wp_enqueue_scripts', 'athena_scripts' );



/**

 * Register Menu

**/

add_action('init', 'athena_setup');

function athena_setup(){

    register_nav_menus( array(

        'athena_main_menu' => __('Main Menu', DOMAIN)

    ) );


    add_theme_support( 'post-thumbnails' );

    add_post_type_support( 'page', 'excerpt' );

    add_image_size(ITEM_PRODUCT_HOME,270,160,TRUE); 

    add_image_size(ITEM_PRODUCT_MINICART,320,320,TRUE);

    add_image_size(BANNER,1500,420,TRUE);

}
add_action('wp_enqueue_scripts', 'evatheme_scripts',100,100);
function evatheme_scripts() {
    wp_enqueue_style ('theme-style-bostrap',ASSETS_PATH.'vendor/bootstrap/css/bootstrap.min.css'); 
    wp_enqueue_style ('theme-style-awesome',ASSETS_PATH.'fonts/font-awesome-4.7.0/css/font-awesome.min.css'); 
    wp_enqueue_style ('theme-style-themify',ASSETS_PATH.'fonts/iconic/css/material-design-iconic-font.min.css');
    wp_enqueue_style ('theme-style-Linearicons',ASSETS_PATH.'fonts/linearicons-v1.0.0/icon-font.min.css');
    wp_enqueue_style ('theme-style-elegant',ASSETS_PATH.'vendor/animate/animate.css');
    wp_enqueue_style ('theme-style-animate',ASSETS_PATH.'vendor/css-hamburgers/hamburgers.min.css');
    wp_enqueue_style ('theme-style-hamburgers',ASSETS_PATH.'vendor/animsition/css/animsition.min.css');
    wp_enqueue_style ('theme-style-animsition',ASSETS_PATH.'vendor/select2/select2.min.css');
    wp_enqueue_style ('theme-style-daterangepiker',ASSETS_PATH.'vendor/daterangepicker/daterangepicker.css');
    wp_enqueue_style ('theme-style-select2',ASSETS_PATH.'vendor/slick/slick.css');
    wp_enqueue_style ('theme-style-daterangepicker',ASSETS_PATH.'vendor/MagnificPopup/magnific-popup.css');

    wp_enqueue_style ('theme-style-lightbox2',ASSETS_PATH.'vendor/perfect-scrollbar/perfect-scrollbar.css'); 

    wp_enqueue_style ('theme-style-util',ASSETS_PATH.'css/util.css');   

    wp_enqueue_style ('theme-style',ASSETS_PATH.'css/main.css'); 
    // wp_enqueue_style ('theme-style-slick',ASSETS_PATH.'vendor/slick/slick.css');
    // wp_enqueue_script ('slick-jquery',ASSETS_PATH.'js/main.js'); 
        wp_enqueue_script ('jquery-3.2.1',ASSETS_PATH.'vendor/jquery/jquery-3.2.1.min.js');
        wp_enqueue_script ('animsition',ASSETS_PATH.'vendor/animsition/js/animsition.min.js');

        
     wp_enqueue_script ('popper',ASSETS_PATH.'vendor/bootstrap/js/popper.js');
         wp_enqueue_script ('slick-slick',ASSETS_PATH.'vendor/bootstrap/js/bootstrap.min.js');

    wp_enqueue_script ('select2.min',ASSETS_PATH.'vendor/select2/select2.min.js');
      wp_enqueue_script ('slick-countdowntime',ASSETS_PATH.'vendor/daterangepicker/moment.min.js');
       wp_enqueue_script ('slick-lightbox2',ASSETS_PATH.'vendor/daterangepicker/daterangepicker.js');
    //     wp_enqueue_script ('slick-slick2',ASSETS_PATH.'vendor/slick/slick.min.js');

    // wp_enqueue_script ('slick-custom',ASSETS_PATH.'js/slick-custom.js');

    wp_enqueue_script ('slick-animsition',ASSETS_PATH.'vendor/isotope/isotope.pkgd.min.js'); 

    wp_enqueue_script ('slick-bootstrap',ASSETS_PATH.'vendor/sweetalert/sweetalert.min.js');

    wp_enqueue_script ('slick-sweetalert',ASSETS_PATH.'vendor/MagnificPopup/jquery.magnific-popup.min.js');

    // wp_enqueue_script ('slick-main',ASSETS_PATH.'js/main.js');

    wp_enqueue_script ('bootstrap.min',ASSETS_PATH.'vendor/bootstrap/js/bootstrap.min.js');
    wp_enqueue_script ('perfect-scrollbar',ASSETS_PATH.'vendor/perfect-scrollbar/perfect-scrollbar.min.js');  
     wp_enqueue_script ('parallax100',ASSETS_PATH.'vendor/parallax100/parallax100.js');  
     wp_enqueue_script ('main-js',ASSETS_PATH.'js/main-customs.js');  

} 


function callback_function_search() {

    // $wp_ajax = true;

    


    ob_start();

    include( locate_template('template-parts/search-product.php', false, false ));

    $content = ob_get_clean();

    echo  $content;
   
    die();
      
}

add_action( 'wp_ajax_search-product', 'callback_function_search' );    // If called from admin panel
add_action( 'wp_ajax_nopriv_search-product', 'callback_function_search' );

