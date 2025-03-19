<?php
function featured_posts($post_number = 0) {

    $args = array(
        'posts_per_page' => 1,
        'offset' => $post_number,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'no_found_rows' => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

            $categories = get_the_category();

            @$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "featured-post" );
            @$thumbnail_src_big = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "big-featured-post" );
            @$bg_image="background-image:url('$thumbnail_src[0]')";
            @$bg_image_big="background-image:url('$thumbnail_src_big[0]')";
            ?>
                <?php if($post_number == 0): ?>
                    <article <?php post_class('post-item post-item-big') ?> style="<?php echo esc_attr($bg_image_big);?>">
                <?php else: ?>
                    <article <?php post_class('post-item') ?> style="<?php echo esc_attr($bg_image);?>">
                <?php endif; ?>
					<div>
                        <?php
                            if ( ! empty( $categories ) ) :
                                echo '<a class="tag" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                            endif;
                        ?>
                        <header>
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php echo max_title_length(strip_tags(get_the_title()), 100 ); ?>
                                </a>
                            </h2>
                        </header>
					</div>
					<a href="<?php the_permalink(); ?>" class="btn-outline" title="Saiba mais">
						saiba mais
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 14.73" xml:space="preserve"><path d="M28.71 6.66 22.35.3c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41l4.66 4.66H0v2h25.59l-4.66 4.66c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l6.36-6.36c.4-.4.4-1.03.01-1.42z"/></svg>
					</a>
				</article>
            <?php
        endwhile;
    endif;
}

?>
