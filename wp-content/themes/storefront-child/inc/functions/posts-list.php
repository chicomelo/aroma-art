<?php

function posts_list($category_slug = 'todos'){
    if($category_slug == 'todos'){
 
        $args = array(
            'offset' => 3,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'no_found_rows' => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false
        );
    }else{
        $args = array(
            'offset' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'category_name' => $category_slug,
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'no_found_rows' => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false
        );
    }
	
	$query = new WP_Query( $args );

    if ( $query->have_posts() ) :
?>

    <div class="titulo-lista">
        <?php if($category_slug == 'todos'): ?>
            <h2>Últimas Publicações</h2>
            <a href="<?php echo get_home_url(); ?>/blog/ultimas-publicacoes/" class="btn-outline-purple" title="Ver todos">
                ver todas
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 14.73" xml:space="preserve"><path d="M28.71 6.66 22.35.3c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41l4.66 4.66H0v2h25.59l-4.66 4.66c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l6.36-6.36c.4-.4.4-1.03.01-1.42z"/></svg>
            </a>
        <?php 
            else: 
            $category = get_category_by_slug($category_slug);
        ?>
            <h2><?php echo $category->name; ?></h2>
            <a href="<?php the_permalink(); ?>" class="btn-outline-purple" title="Ver todos">
                ver todas
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 14.73" xml:space="preserve"><path d="M28.71 6.66 22.35.3c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41l4.66 4.66H0v2h25.59l-4.66 4.66c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l6.36-6.36c.4-.4.4-1.03.01-1.42z"/></svg>
            </a>
        <?php endif; ?>

    </div>
    <div class="lista-posts">
        <div class="row">
            <?php
                while ( $query->have_posts() ) : $query->the_post();
                    get_template_part( 'template-parts/layout/posts-list');
                endwhile;
            ?>
            <div id="posts-container"></div>
            <a id="load-more" href="javascript: void(0);" class="btn-outline-purple btn-mais" title="Saiba mais">
                carregar mais
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" xml:space="preserve"><path d="M18 8h-8V0H8v8H0v2h8v8h2v-8h8z"/></svg>
            </a>

        </div>
    </div>
<?php 
    endif;
}
?>