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

    $wp_ajax = true;
   
    ob_start();

    include( locate_template('template-parts/search-product.php', false, false ));

    $content = ob_get_clean();

    echo  $content;
   
    die();
      
}

add_action( 'wp_ajax_search-product', 'callback_function_search' );    // If called from admin panel
add_action( 'wp_ajax_nopriv_search-product', 'callback_function_search' );



function callback_product_detail() {

    $wp_ajax = true;
   
    ob_start();

    include( locate_template('template-parts/popup.php', false, false ));

    $content = ob_get_clean();

    echo  $content;
   
    die();
      
}

add_action( 'wp_ajax_product-detail', 'callback_product_detail' );    // If called from admin panel
add_action( 'wp_ajax_nopriv_product-detail', 'callback_product_detail' );


if( ! function_exists('custom_ajax_add_to_cart_button') && class_exists('WooCommerce') ) {

    function custom_ajax_add_to_cart_button( $atts ) {

        // Shortcode attributes

        $atts = shortcode_atts( array(

            'id' => '0', // Product ID

            'qty' => '1', // Product quantity

            'text' => '', // Text of the button

            'class' => '', // Additional classes

        ), $atts, 'ajax_add_to_cart' );



        if( esc_attr( $atts['id'] ) == 0 ) return; // Exit when no Product ID



        if( get_post_type( esc_attr( $atts['id'] ) ) != 'product' ) return; // Exit if not a Product



        $product = wc_get_product( esc_attr( $atts['id'] ) );



        if ( ! $product ) return; // Exit when if not a valid Product



        $classes = implode( ' ', array_filter( array(

                'button',

                'product_type_' . $product->get_type(),

                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',

                $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',

            ) ) ).' '.$atts['class'];



        $add_to_cart_button = sprintf( '<a rel="nofollow" href="%s" %s %s %s class="%s">%s</a>',

            esc_url( $product->add_to_cart_url() ),

            'data-quantity="' . esc_attr( $atts['qty'] ) .'"',

            'data-product_id="' . esc_attr( $atts['id'] ) .'"',

            'data-product_sku="' . esc_attr( $product->get_sku() ) .'"',

            esc_attr( isset( $classes ) ? $classes : 'button' ),

            esc_html( empty( esc_attr( $atts['text'] ) ) ? $product->add_to_cart_text() : esc_attr( $atts['text'] ) )

        );



        return $add_to_cart_button;

    }

    add_shortcode('ajax_add_to_cart', 'custom_ajax_add_to_cart_button');

}





add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment_mini');


function woocommerce_header_add_to_cart_fragment_mini($fragments)
{

    ob_start();

    ?>
    <div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">

                <?php



                global $woocommerce;

                $items = $woocommerce->cart->get_cart();
               
               
                foreach ($items as $item => $values) {


                    $_product = wc_get_product($values['data']->get_id());


                    $getProductDetail = wc_get_product($values['product_id']);
                    $image = get_the_post_thumbnail_url($values['product_id'], ITEM_PRODUCT_MINICART);

                    $quantity = $values['quantity'];

                    $price = get_post_meta($values['product_id'], '_price', true);

                    ?>


                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="<?= $image ?>" alt="IMG">
                            <div class="remove-item">
                                <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove_mini_cart" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $item ) ), esc_html__( 'Remove this item', 'wpdance' ) ), $item ); ?>
                            </div>
                             
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="<?= get_permalink($values['product_id']) ?>"
                               class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                <?= $_product->get_title() ?>
                            </a>

                            <span class="header-cart-item-info">
                            <?= $quantity ?> x <?= number_format($price) ?>đ
                        </span>
                        </div>
                    </li>
                <?php } ?>

            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: <?= $woocommerce->cart->get_cart_total(); ?>
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="shoping-cart.html"
                       class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        View Cart
                    </a>

                    <a href="shoping-cart.html"
                       class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php $fragments['div.wrap-header-cart'] = ob_get_clean();
    return $fragments;
}