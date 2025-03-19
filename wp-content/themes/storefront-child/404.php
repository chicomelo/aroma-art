<?php
// Chama o cabeçalho do tema
get_header(); ?>

<div class="error-404 not-found">
    <h1><?php _e( 'Página não encontrada', 'storefront' ); ?></h1>
    <p><?php _e( 'A página que você está tentando acessar não existe.', 'storefront' ); ?></p>
    <a class="button" href="<?php echo home_url(); ?>"><?php _e( 'Voltar', 'storefront' ); ?></a>
</div>

<?php
// Chama o rodapé do tema
get_footer();