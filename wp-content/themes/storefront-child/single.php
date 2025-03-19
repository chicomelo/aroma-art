<?php
    get_header(); 

    if (function_exists('wpb_set_post_views')) {
        wpb_set_post_views(get_the_ID());
    }
?>

<div class="single-post__wrapper">

        <?php
            // Start the loop.
            while ( have_posts() ) : the_post();

            # pega pagina atual com seus parametros
            $url_page = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $post_cat = get_the_category( $post->ID )[0];
        ?>

            <article id="post-<?php the_ID(); ?>" <?php  post_class();?>>

                <header class="entry-header">
                    <h1 class="titulo"><?php  the_title(); ?></h1>
                    <div class="post-details">
                        <div>
                            <div class="icone">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19" xml:space="preserve"><path d="M19 16.29c0 1.5-1.23 2.71-2.74 2.71H2.74C1.23 19 0 17.78 0 16.29V4.07c0-1.5 1.23-2.71 2.74-2.71h1.37V.68c0-.38.3-.68.68-.68.38 0 .68.3.68.68v.68h8.05V.68c0-.38.31-.68.69-.68.38 0 .68.3.68.68v.68h1.37c1.51 0 2.74 1.22 2.74 2.71v12.22zM4.11 3.39c0 .38.31.68.68.68.38 0 .68-.3.68-.68v-.68h8.05v.68c0 .38.31.68.68.68.38 0 .68-.3.68-.68v-.68h1.37c.76 0 1.37.61 1.37 1.36v1.02H1.37V4.07c0-.75.61-1.36 1.37-1.36h1.37v.68zM1.37 6.45v9.84c0 .75.61 1.36 1.37 1.36h13.52c.76 0 1.37-.61 1.37-1.36V6.45H1.37z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                            </div>
                            <p>
                                <?php
                                    $dia = get_the_date('d');
                                    $mes = get_the_date('M');
                                    $ano = get_the_date('Y');
                                    echo $dia." de ".$mes." de ".$ano;
                                ?>
                            </p>
                        </div>
                        <div>
                            <div class="icone">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19" xml:space="preserve"><path d="M9.5 10.26c2.7 0 4.89-2.3 4.89-5.13S12.2 0 9.5 0C6.8 0 4.61 2.3 4.61 5.13s2.2 5.13 4.89 5.13zm0-8.78c1.92 0 3.47 1.63 3.47 3.65S11.42 8.78 9.5 8.78 6.03 7.14 6.03 5.13 7.58 1.48 9.5 1.48zM15.75 11.72H3.25c-1.5 0-2.72 1.28-2.72 2.86V19h1.41v-4.43c0-.76.59-1.37 1.3-1.37h12.5c.72 0 1.3.61 1.3 1.37V19h1.41v-4.43c.02-1.57-1.2-2.85-2.7-2.85z"/></svg>
                            </div>
                            <p>
                                Por: <?php echo get_the_author_meta('first_name', get_the_author_meta( 'ID' ) ); ?>
                            </p>
                        </div>

                    </div>
                </header>

                <div class="post-img">
                    <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail('single-featured-post');
                        }
                    ?>
                </div>


                <div class="row content__wrapper">
                    <div class="col-12 col-md-8">
                        <div class="entry-content">
                            <?php 
                                the_content();
                            ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <?php get_sidebar(); ?>
                    </div>
                </div>

            </article>

            <?php
            // Talvez você também goste
            //get_template_part('templates/related_posts');
            //wp_reset_postdata();
            endwhile;
        ?>


</div>

<?php get_footer(); ?>
