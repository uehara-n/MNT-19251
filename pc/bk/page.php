<?php get_header(); 
$title = apply_filters( 'the_title', get_queried_object()->post_title );
the_post();
?>

<!-- ======================コンテンツここから======================= -->
<div class="main_wrapper base_inner clearfix">
		<!-- ========================================================右コンテンツ ここから -->
	<main class="main_contents">
			
		<ul id="pankuzu" class="clearfix">
			<?php the_pankuzu_keni( ' &gt; ' ); ?>
		</ul>
		<h2 class="main_tit"><?php the_title();?></h2>
		<?php 
		remove_filter('the_content', 'wpautop');
		the_content();
		add_filter('the_content', 'wpautop');
		?>
					
	</main>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>