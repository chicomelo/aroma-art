<?php
	get_header();

	$category = get_queried_object();
	$category_slug = $category->slug;
	$category_description = $category->description;

?>


<div class="container">


	<div class="posts-destaques">
		<a href="<?php echo get_home_url() ?>/blog" class="btn-fechar">
			<?php single_cat_title(); ?>
			<span class="icone-fechar"></span>
		</a>
		<div class="row">
			<div class="col-12 col-md-8">
				<h1 class="titulo"><?php single_cat_title(); ?></h1>
				<p class="paragrafo"><?php echo esc_html($category_description); ?></p>
			</div>
			<div class="col-12 col-md-4">
			</div>
		</div>
		<div class="post-content">
			<div class="row">
				<div class="col-12 col-md-8">
					<?php
						category_featured_posts($category_slug, 0);
					?>
				</div>
				<div class="col-12 col-md-4">
					<aside class="sidebar">
						<?php
							sidebar_list($category_slug);
						?>
					</aside>
				</div>
			</div>
		</div>
	</div>

	<div class="posts-list">
		<?php
			posts_list($category_slug);
		?>
	</div>

</div>


<?php


get_footer();