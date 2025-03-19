<?php

function most_read_posts(){

    $args = array(
        'meta_key' => 'wpb_post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'no_found_rows' => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false
    );

	$query = new WP_Query( $args );

    if ( $query->have_posts() ) :
?>

    <h3 class="titulo">Mais lidos</h3>
    <div class="most-read-list">
        <div class="row">
            <?php
                while ( $query->have_posts() ) : $query->the_post();
                    get_template_part( 'template-parts/layout/most-read-posts');
                endwhile;
            ?>
        </div>
    </div>
<?php 
    endif;
}
?>