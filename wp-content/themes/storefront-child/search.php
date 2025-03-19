<?php
// Chama o cabeçalho padrão
get_header();

// Verifica se existem resultados de busca
if ( have_posts() ) : ?>

    <header class="page-header">
        <h1 class="page-title">
            <?php
            /* Título da página de resultados de busca */
            printf( __( 'Resultados da busca para: %s', 'storefront' ), '<strong>' . get_search_query() . '</strong>' );
            ?>
        </h1>
    </header>

    <?php
    // Inicia a listagem de produtos da busca
    woocommerce_product_loop_start();

    // Loop pelos resultados de busca
    while ( have_posts() ) : the_post();

        // Exibe os produtos em grid como nas categorias
        wc_get_template_part( 'content', 'product' );

    endwhile;

    woocommerce_product_loop_end();

else :

    // Exibe mensagem se nenhum produto for encontrado
    get_template_part( 'content', 'none' );

endif;

// Chama o rodapé padrão
get_footer();