<?php

function sidebar_list($category_slug){
    global $wp_query;

    if($wp_query->is_single): 
        $args = array(
            'orderby' => 'date',
            'order' => 'DESC',
            'category_name' => $category_slug,
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'no_found_rows' => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false
        );

    elseif($wp_query->is_category): 
        $args = array(
            'meta_key' => 'wpb_post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'category_name' => $category_slug,
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'no_found_rows' => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false
        );
        
    endif; 

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) :
        $category = get_category_by_slug($category_slug);

        if($wp_query->is_single): 
    ?>
        <p class="sidebar-title">Leia também</p>
    <?php 
        elseif($wp_query->is_category): 
    ?>
        <p class="sidebar-title">Mais lidos</p>
    <?php endif; ?>

    <div class="sidebar-posts">
        <div class="row">
            <?php
                while ( $query->have_posts() ) : $query->the_post();
                    get_template_part( 'template-parts/layout/sidebar-list');
                endwhile;
            ?>
        </div>
    </div>

    <?php
        endif;
    }

function category_list(){
?>
    <h2>Tags</h2>

    <div class="lista-assuntos">
        <?php
            $categories = get_the_category(get_the_ID());
            foreach ($categories as $category):
                echo '<a class="tag" href="' . esc_url( get_category_link( $category -> term_id ) ) . '">' . esc_html( $category -> name ) . '</a>';
            endforeach
        ?>
    </div>
<?php 
}
?>