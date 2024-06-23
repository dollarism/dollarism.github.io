<?php
function studiare_webdenj_ajax_filter_products_scripts() {
  // Enqueue script
  wp_register_script('studiare_product_ajax_script', plugin_dir_url( __FILE__ ) . 'ajax.js', false, null, false);
  wp_enqueue_script('studiare_product_ajax_script');

  wp_localize_script( 'studiare_product_ajax_script', 'studiare_ajax_products_obj', array(
        'studiare_product_ajax_nonce' => wp_create_nonce( 'studiare_product_ajax_nonce' ),
        'studiare_product_ajax_url' => admin_url( 'admin-ajax.php' ),
      )
  );
}
add_action('wp_enqueue_scripts', 'studiare_webdenj_ajax_filter_products_scripts');


// Script for getting posts
function studiare_webdenj_ajax_filter_get_products( $taxonomy ) {

  // Verify nonce
  if( !isset( $_POST['studiare_product_ajax_nonce'] ) || !wp_verify_nonce( $_POST['studiare_product_ajax_nonce'], 'studiare_product_ajax_nonce' ) )
    die('Permission denied');

  $taxonomy = $_POST['taxonomy'];

  // WP Query
  $args = array(
    'product_cat' => $taxonomy,
    'post_type' => 'product',
    'posts_per_page' => 9,
    'tax_query'     => array(
      array(
         'taxonomy' =>   'product_visibility',
         'field'    =>   'name',
         'terms'    =>   array('exclude-from-search', 'exclude-from-catalog'),
         'operator' =>   'NOT IN'
      )
    )
  );

  // If taxonomy is not set, remove key from array and get all posts
  if( !$taxonomy ) {
    unset( $args['tag'] );
  }

  $query = new WP_Query( $args );


	if ( $query->have_posts() ): ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
      <div class="col-lg-4 col-md-6">
        <?php get_template_part( 'woocommerce/content-product-carousel' ); ?>
      </div>
			<?php endwhile; ?>
  <?php else: ?>
    <p class="not-found"><?php echo esc_html__('No item found','studiare-core' ); ?></p>
  <?php endif;

  die();
}

add_action('wp_ajax_filter_products', 'studiare_webdenj_ajax_filter_get_products');
add_action('wp_ajax_nopriv_filter_products', 'studiare_webdenj_ajax_filter_get_products');
