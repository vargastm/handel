<?php get_header(); ?>

<?php
  function format_single_product($id, $img_size = 'medium') {
    $product = wc_get_product($id);

    $gallery_ids = $product -> get_gallery_attachment_ids();
    $gallery = [];
    if($gallery_ids) {
      foreach($gallery_ids as $img_id) {
        $gallery[] = wp_get_attachment_image_src($img_id, $img_size)[0];
      }
    }

    return [
      'id' => $id,
      'name' => $product -> get_name(),
      'price' => $product -> get_price_html(),
      'link' => $product -> get_permalink(),
      'sku' => $product -> get_sku(),
      'description' => $product -> get_description(),
      'img' => wp_get_attachment_image_src($product -> get_image_id(), $img_size)[0],
      'gallery' => $gallery,
    ];
  }
?>

<div class="container breadcrumb">
  <?php woocommerce_breadcrumb(['delimiter' => ' > ']) ?>
</div>

<div class="container notification">
  <?php wc_print_notices(); ?>
</div>

<main class="container product">
  <?php
    if(have_posts()) { while(have_posts()) { the_post();
      $product_format = format_single_product(get_the_ID());
  ?>
  <div class="product-gallery" data-gallery="gallery">
      <div class="product-gallery-list">
        <?php foreach($product_format['gallery'] as $img) { ?>
          <img data-gallery="list" src="<?= $img; ?>" alt="<?= $product_format['name'];?>">
        <?php } ?>
      </div>
      <div class="product-gallery-main">
          <img data-gallery="main" src="<?= $product_format['img'] ?>" alt="<?= $product_format['name'];?>">
      </div>
  </div>
  <div class="product-detail">
    <small><?= $product_format['sku']; ?></small>
    <h1><?= $product_format['name'];?></h1>
    <p class="product-price"><?= $product_format['price'];?></p>
    <?php woocommerce_template_single_add_to_cart(); ?>
    <h2>Descrição</h2>
    <p><?= $product_format['description'];?></p>
  </div>
  <?php } } ?>
</main>

<?php
  $related_ids = wc_get_related_products($product_format['id'], 6);
  $related_products = [];
  foreach($related_ids as $product_id) {
    $related_products[] = wc_get_product($product_id);
  }

  $related = format_products($related_products);
?>

<section class="container-separator">
  <div class="container">
    <h2 class="subtitle">Relacionados</h2>
    <?php handel_product_list($related) ?>
  </div>
</section>

<?php get_footer();?>