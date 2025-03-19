<?php
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "post-list" );

    if(isset($thumbnail_src[0])){
        $thumb = $thumbnail_src[0];
    }
    $post_cat = get_the_category( $post->ID )[0];

?>

<article <?php post_class('post-item post-list'); ?>>
    <div class="row">
        <div class="col-12 col-sm-6">
            <?php if(has_post_thumbnail()) : ?>
                <a class="thumb-post" href="<?php echo get_permalink() ?>" title="<?php echo get_the_title(); ?>">
                    <img class="img-fluid" src="<?php echo esc_attr($thumb);?>" alt="<?php echo get_the_title(); ?>">
                </a>
            <?php endif;?>
        </div>
        <div class="col-12 col-sm-6">
            <div class="article-content">
                <div>
                    <a class="tag" href="<?php echo esc_url( get_category_link($post_cat) ); ?>" title="<?php echo $post_cat->name; ?>" rel="bookmark">
                        <?php echo $post_cat->name; ?>
                    </a>
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php echo strip_tags(get_the_title()); ?>
                            </a>
                        </h2>
                    </header>
                    <div class="entry-content">
                        <?php echo strip_tags(strip_shortcodes(get_the_content())); ?>
                    </div>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn-purple" title="Saiba mais">
                    saiba mais
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 14.73" xml:space="preserve"><path d="M28.71 6.66 22.35.3c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41l4.66 4.66H0v2h25.59l-4.66 4.66c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l6.36-6.36c.4-.4.4-1.03.01-1.42z"/></svg>
                </a>
            </div>
        </div>
    </div>
</article>
