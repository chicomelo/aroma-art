<aside class="sidebar">
<?php
  $categories = get_the_category();
  if ( ! empty( $categories ) ) {
      global $wp_query;      // Pega a primeira categoria (ou a principal)
      $category = $categories[0];

      // Obtém o slug da categoria
      $category_slug = $category->slug;

      sidebar_list($category_slug);

      // category_list();
  }
?>
</aside>
