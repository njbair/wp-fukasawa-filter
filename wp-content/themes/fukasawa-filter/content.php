<?php
	$data_terms = "";

	if ( has_term( 'category', get_the_ID() ) ) {
		foreach ( get_the_terms(get_the_ID(), 'category' ) as $term) {
			$data_terms .= " data-category-" . $term->term_id . "=\"" . $term->name . "\"";
		}
	}
	if ( has_term( 'post_tag', get_the_ID() ) ) {
		foreach ( get_the_terms(get_the_ID(), 'post_tag' ) as $term) {
			$data_terms .= " data-tag-" . $term->term_id . "=\"" . $term->name . "\"";
		}
	}

	/*
	$the_terms = htmlspecialchars(json_encode((object) array(
		"categories" => get_the_terms(get_the_ID(), 'category'),
		"tags" => get_the_terms(get_the_ID(), 'post_tag')
	)));
	*/
?>
<div class="post-container">

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php echo $data_terms; ?>>

		<?php 

		$post_format = get_post_format();
		
		// Video format specific featured media
		if ( $post_format == 'video' && strpos( $post->post_content, '<!--more-->' ) ) : ?>

			<div class="featured-media">

				<?php
						
				// Fetch post content
				$content = get_post_field( 'post_content', get_the_ID() );
				
				// Get content parts
				$content_parts = get_extended( $content );
				
				// oEmbed part before <!--more--> tag
				$embed_code = wp_oembed_get( $content_parts['main'] ); 
				
				echo $embed_code;
				
				?>

			</div><!-- .featured-media -->

			<?php 
		
		// Gallery format specific featured media
		elseif ( $post_format == 'gallery' ) : ?>

			<div class="featured-media">
			
				<?php fukasawa_flexslider( 'post-thumb' ); ?>
				
			</div><!-- .featured-media -->
	
		<?php 
		
		// Image format specific featured media
		elseif ( $post_format == 'image' && has_post_thumbnail() ) : ?>

			<div class="featured-media">

				<?php the_post_thumbnail( 'post-thumb' ); ?>

				<a class="post-overlay" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
						
					<p class="view"><?php _e( 'View', 'fukasawa' ); ?> &rarr;</p>
				
				</a>

			</div><!-- .featured-media -->

		<?php 
		
		// Standard format featured media
		elseif ( has_post_thumbnail() ) : ?>
		
			<a class="featured-media" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">	
				
				<?php the_post_thumbnail( 'post-thumb' ); ?>
				
			</a><!-- .featured-media -->
				
			<?php 
		endif;
		
		// Hide the post title and excerpt for image format posts with post thumbnail
		if ( $post_format !== 'image' || $post_format == 'image' && ! has_post_thumbnail() ) :
		
			if ( get_the_title() ) : ?>
						
				<div class="post-header">
					
					<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							
				</div><!-- .post-header -->
			
				<?php 
			endif;
			
			if ( get_the_excerpt() ) : ?>
			
				<div class="post-excerpt">
				
					<?php 
					if ( $post_format == 'video' && strpos( $post->post_content, '<!--more-->' ) ) {
						echo '<p>' . mb_strimwidth( $content_parts['extended'], 0, 160, '...' ) . '</p>';
					} else {
						the_excerpt();
					}
					?>
				
				</div>

				<?php 
			endif;
			
			if ( ! get_the_title() ) : ?>
					
				<div class="posts-meta">
				
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_time(get_option('date_format')); ?></a>
					
				</div>
			
				<?php 
			endif;
			
		endif;
		
		?>
	
	</div><!-- .post -->

</div><!-- .post-container -->