<?php 

function handel_add_woocommerce_support() {
  add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'handel_add_woocommerce_support');

function handel_css() {
  wp_register_style('handel-style', get_template_directory_uri() . '/style.css', [], '1.0.0');
  wp_enqueue_style('handel-style');
}

add_action('wp_enqueue_scripts', 'handel_css');

function handel_custom_images() {
  add_image_size('slide', 1000, 800, ['center', 'top']);
  update_option('medium_crop', 1);
}

add_action('after_setup_theme', 'handel_custom_images');

function handel_loop_shop_per_page() {
  return 6;
}

add_filter('loop_shop_per_page', 'handel_loop_shop_per_page');

function handel_product_list($products) { ?>
  <ul class="products-list">
    <?php foreach ($products as $product) { ?>
    <li class="product-item">
      <a href="<?= $product['link']; ?>">
        <div class="product-info">
          <img src="<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
          <h2><?= $product['name']; ?>" - <span><?= $product['price']; ?>"</span></h2>
        </div>
        <div class="product-overlay">
          <span class="btn-link">Ver Mais</span>
        </div>
      </a>
    </li>
    <?php } ?>
  </ul>
<?php
}

?>