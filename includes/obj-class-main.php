<?php
/**
 * Main Class
 *
 * @since 1.0
 */
class Obj_Main {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
        add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'cgd_add_product_heart' ), 15 );
        add_action( 'wp_ajax_favorite_callback', array( $this, 'favorite_callback' ) );
        add_action( 'wp_ajax_nopriv_favorite_callback', array( $this, 'favorite_callback' ) );
    }

    /**
     * Enqueue scripts
     *
     * @since 1.0
     */
    public function scripts() {
        wp_enqueue_script( 'main', PLUGIN_URL . 'assets/js/main.js', array('jquery'), VERSION, true );
        wp_localize_script( 'main', 'favorite_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }

    /**
     * Add product heart
     *
     * @since 1.0
     */
    public function cgd_add_product_heart() {
        global $product;
        $saved_products = get_user_meta( get_current_user_id(), 'saved_products', false );
        print_r($saved_products);
    	echo '<div class="favorite-product"><a rel="nofollow" href="#" data-product-id="' . $product->id . '"><img src="' . get_stylesheet_directory_uri() . '/assets/images/heart.png"></a></div>';
    }

    /**
     * Favorite callback
     *
     * @since 1.0
     */
    public function favorite_callback() {
        $new_product_id = $_POST['product_id'];
        $user_id = get_current_user_id();
        $saved_products = get_user_meta( $user_id, 'saved_products', false );

        update_user_meta( $user_id, 'saved_products', $new_product_id );

        echo 'done';

        die();
    }

}
