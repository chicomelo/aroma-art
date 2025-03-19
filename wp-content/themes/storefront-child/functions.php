<?php

require_once get_theme_file_path().'/inc/functions/thumbnail-size.php';
require_once get_theme_file_path().'/inc/functions/featured-posts.php';
require_once get_theme_file_path().'/inc/functions/category-featured-post.php';
require_once get_theme_file_path().'/inc/functions/posts-list.php';
require_once get_theme_file_path().'/inc/functions/sidebar-list.php';
require_once get_theme_file_path().'/inc/functions/breadcrumbs.php';
require_once get_theme_file_path().'/inc/functions/most-read-posts.php';

// Função para limitar tamanho de texto
function max_title_length( $title, $limite = 70 ) {
	$contador = strlen($title);
	if ( $contador >= $limite ) {
		$title = substr($title, 0, strrpos(substr($title, 0, $limite), ' ')) . ' ...';
	  	return $title;
	}
	else{
		return $title;
	}
}


// Muda processador de imagens
function hs_image_editor_default_to_gd( $editors ) {
    $gd_editor = 'WP_Image_Editor_GD';
    $editors = array_diff( $editors, array( $gd_editor ) );
    array_unshift( $editors, $gd_editor );
    return $editors;
}
add_filter( 'wp_image_editors', 'hs_image_editor_default_to_gd' );


if ( ! function_exists( 'custom_assets' ) ) :

	function custom_assets() {

		global $wp_query;


		$theme_version = wp_get_theme()->get( 'Version' );
		$version_string = is_string( $theme_version ) ? $theme_version : false;

		// styles
		wp_register_style( 
			'main-style-child', 
			get_template_directory_uri() . '-child/assets/css/main-style.css',
			array(),
			$version_string
		);

		// scripts
		wp_register_script( 
			'main-scripts', 
			get_template_directory_uri() . '-child/assets/js/main-scripts.js',
			array('jquery'),
			$version_string,
			true
		);
		wp_register_script( 
			'slick-slider', 
			get_template_directory_uri() . '-child/assets/js/slick.min.js',
			array('jquery'),
			$version_string,
			true
		);
		
		wp_enqueue_style( 'main-style-child' );
		wp_enqueue_script( 'main-scripts' );
		wp_enqueue_script( 'slick-slider' );

		wp_localize_script( 'main-scripts', 'load_more_params', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'posts' => json_encode( $wp_query->query_vars ),
			'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
			'max_page' => $wp_query->max_num_pages
		) );

	}

endif;

add_action( 'wp_enqueue_scripts', 'custom_assets' );

// Add Shortcode
function img_url() {
    return get_template_directory_uri().'-child/assets/img/'; 
}
add_shortcode( 'img-url', 'img_url' );

// Register a new navigation menu
function add_Main_Nav() {
	register_nav_menu('header-menu',__( 'Header Menu' ));
}
// Hook to the init action hook, run our navigation menu function
add_action( 'init', 'add_Main_Nav' );


function custom_logo_setup() {
	$defaults = array(
		'height'               => 108,
		'width'                => 160,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true, 
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'custom_logo_setup' );

add_theme_support( 'custom-logo' );

// remove br e p no classic editor
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );


// Reestruturar breadcrumb
add_action( 'init', 'remover_breadcrumb_storefront' );

function remover_breadcrumb_storefront() {
    remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
}
add_action( 'storefront_before_content', 'adicionar_breadcrumb_customizado', 10 );

function adicionar_breadcrumb_customizado() {
    echo '<div class="container">';
    if ( function_exists( 'woocommerce_breadcrumb' ) ) {
        woocommerce_breadcrumb();
    }
    echo '</div>';
}

// move descriçao curta para antes do preço.
add_action( 'wp', 'mover_short_description_antes_do_preco' );

function mover_short_description_antes_do_preco() {
    // Remove a short description da posição padrão
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    
    // Adiciona a short description antes do preço (prioridade 9)
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 9 );
}


// adiciona texto de desconto dpois do preço
add_action( 'woocommerce_single_product_summary', 'exibir_valor_desconto', 11 );

function exibir_valor_desconto() {
    global $product;
    
    // Obtém o preço regular e o preço de venda
    $preco_regular = $product->get_price() ? $product->get_price() : $product->get_regular_price();
    $desconto = 10; // Percentual de desconto
    
	$preco_com_desconto = $preco_regular - ( $preco_regular * ( $desconto / 100 ) );

   	// Exibe o preço com desconto
	if ( $preco_regular ) {
		echo '<div class="preco-com-desconto">';
		echo 'Ou <b>';
		echo wc_price( $preco_com_desconto ); // Formata o valor conforme o padrão do WooCommerce
		echo '</b> à vista no pix ';
		echo '</div>';
	}
}

// desabilita produtos relacionados na página de produto
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


// remove downloads da página minha conta
add_filter( 'woocommerce_account_menu_items', 'remover_aba_downloads_conta', 999 );

function remover_aba_downloads_conta( $items ) {
    unset( $items['downloads'] ); // Remove a aba de downloads
    return $items;
}


add_filter( 'gettext', 'alterar_frase_checkout_guest', 20, 3 );

function alterar_frase_checkout_guest( $translated_text, $text, $domain ) {
    // Verifica se o domínio é o WooCommerce e o texto é o que queremos alterar
    if ( $domain === 'woocommerce' && $text === 'You are currently checking out as a guest.' ) {
        // Substitui pela frase desejada
        $translated_text = 'Você está finalizando a compra como convidado.';
    }

    return $translated_text;
}


function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


function loadmore_ajax_handler(){
    $args = json_decode( stripslashes( $_POST['query'] ), true );

	$page = $_POST['page'] + 1;
    $args['paged'] = $page;
    $args['post_status'] = 'publish';
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
    $args['posts_per_page'] = 5;

	if ($args['category_name'] !== ''): 
		$args['offset'] = 1 + ( ($page - 1) * 5 );
	else: 
		$args['offset'] = 3 + ( ($page - 1) * 5 );
	endif; 

	$args['post_type'] = 'post'; 
	$args['no_found_rows'] = true;
	$args['update_post_meta_cache'] = false; 
	$args['update_post_term_cache'] = false; 

    $query = new WP_Query( $args );

    if( $query->have_posts() ) :
        while( $query->have_posts() ): $query->the_post();
            // Exibe o conteúdo do post
            get_template_part( 'template-parts/layout/posts-list');
        endwhile;
    else :
        //echo 'Nenhum post encontrado';
    endif;

    wp_die(); // Termina a execução para retornar um resultado limpo
}

add_action('wp_ajax_loadmore', 'loadmore_ajax_handler'); // Para usuários logados
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler'); // Para usuários não logados

?>