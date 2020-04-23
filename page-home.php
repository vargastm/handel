<?php 
//Template name: Home
get_header(); ?>
<pre>

<?php 
function format_products($products, $img_size) {
  $products_final = [];
  foreach($products as $product) {
    $products_final[] = [
      'name' => $product->get_name(),
      'price' => $product->get_price_html(),
      'link' => $product->get_permalink(),
      'img' => wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],
    ];
  }
  return $products_final;
}

$products_slide = wc_get_products ([
  'limit' => 6,
  'tag' => ['slide'],
]);

$products_new = wc_get_products ([
  'limit' => 9,
  'orderby' => 'date',
  'order' => 'DESC',
]);

$products_sales = wc_get_products ([
  'limit' => 9,
  'meta_key' => 'total_sales',
  'orderby' => 'meta_value_num',
  'order' => 'DESC',
]);

$data = [];


$data['slide'] = format_products($products_slide, 'slide');
$data['releases'] = format_products($products_new, 'medium');
$data['sales'] = format_products($products_sales, 'medium');

?>
</pre>

<?php if (have_posts()) { while (have_posts()) { the_post(); ?>

<ul class="benefits">
  <li>Frete Grátis</li>
  <li>Troca Fácil</li>
  <li>Até 12x</li>
</ul>

<section class="slide-wrapper">
  <ul class="slide">
    <?php foreach($data['slide'] as $product) { ?>
    <li class="slide-item">
      <img src="<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
      <div class="slide-info">
        <span class="slide-price"><?= $product['price']; ?></span>
        <h2 class="slide-name"><?= $product['name']; ?></h2>
        <a class="btn-link"href="<?= $product['link']; ?>">Ver Produto</a>
    </div>
    <?php } ?>
  </ul>
</section>

<section class="container">
  <h1 class="subtitle">Lançamentos</h1>
  <?php handel_product_list($data['releases']); ?>
</section>

<section class="container">
  <h1 class="subtitle">Mais Vendidos</h1>
  <?php handel_product_list($data['sales']); ?>
</section>

<?php } } ?>

<?php get_footer(); ?>