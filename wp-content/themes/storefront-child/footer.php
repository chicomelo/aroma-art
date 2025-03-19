<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">

			<div class="row">
				<div class="col-12 col-md-12 col-lg-6">
					<div class="row">
						<div class="col-12 col-md-6">
							<h4>Produtos</h4>
							<nav>
								<?php
									wp_nav_menu( array('container_class' => 'menu-footer', 'theme_location' => 'primary') ); 
								?>
							</nav>
						</div>
						<div class="col-12 col-md-6">
							<h4>Institucional</h4>
							<nav>
								<?php
									wp_nav_menu( array('container_class' => 'menu-footer', 'theme_location' => 'secondary') ); 
								?>
							</nav>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-6 d-flex flex-column justify-content-between">
					<div class="row">
						<div class="col-12 col-md-6">
							<h4>Social</h4>
							<div class="social__wrapper">
								<!-- <a href="" title="" target="_blank">
									<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 800 800"><path d="M554.5 400h-98.3v358.6H321.9V400h-89.6V276.4l89.6-.2-.2-72.5c0-101.1 27.4-162.3 146.2-162.3h99v123.7H505c-46.1 0-48.8 17.5-48.8 49.3v61.8h111.5L554.5 400zm0 0"/></svg>
								</a> -->
								<a href="https://www.instagram.com/aroma_artbr/" title="" target="_blank">
									<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 800 800"><path d="M400 215.3c-101.8 0-184.7 82.8-184.7 184.6S298.1 584.6 400 584.6c101.8 0 184.7-82.8 184.7-184.7 0-101.7-82.9-184.6-184.7-184.6zm0 305.8c-66.8 0-121.1-54.3-121.1-121.1 0-66.7 54.3-121.1 121.1-121.1S521.1 333.3 521.1 400c0 66.8-54.3 121.1-121.1 121.1zM592.4 161.4c-12.3 0-24.3 5-32.9 13.7-8.7 8.7-13.7 20.7-13.7 33s5 24.3 13.7 33c8.6 8.6 20.7 13.6 32.9 13.6 12.3 0 24.3-5 33-13.6 8.7-8.7 13.7-20.8 13.7-33 0-12.3-5-24.3-13.7-33-8.6-8.7-20.7-13.7-33-13.7z"/><path d="M560.6 41.7H239.5c-109 0-197.8 88.7-197.8 197.8v321.1c0 109 88.7 197.8 197.8 197.8h321.1c109.1 0 197.8-88.7 197.8-197.8V239.4c-.1-109-88.8-197.7-197.8-197.7zm134.2 518.9c0 74-60.2 134.2-134.2 134.2H239.5c-74 0-134.2-60.2-134.2-134.2V239.4c0-74 60.2-134.2 134.2-134.2h321.1c74 0 134.2 60.2 134.2 134.2v321.2z"/></svg>
								</a>
								<!-- <a href="" title="" target="_blank">
									<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 800 800"><path d="M345.4 305.2v123.9s-130.3-10.6-130.3 116.5c0 118.3 196 99.6 196-5.3V41.4h128.2S529.8 213 709.8 208.8v133.3s-108 .1-168.4-53.9v290.2s-27.5 180.1-223.5 180.1S90.2 609.2 90.2 529.8c0-79.5 52.9-224.6 255.2-224.6z"/></svg>
								</a> -->
							</div>
						</div>
						<div class="col-12 col-md-6">
							<h4>Formas de pagamento</h4>
							<img src="<?php echo do_shortcode("[img-url]"); ?>footer-formas-pagamento.png" alt="" />
						</div>
					</div>
					<div class="copy">
						Aroma Art. © Todos os direitos reservados. <?php echo date('Y'); ?>
					</div>
				</div>
			</div>
			
		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
