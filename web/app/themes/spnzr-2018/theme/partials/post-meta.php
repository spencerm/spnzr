<?php
/**
 * Displays the post date/time, author, tags, categories and comments link.
 *
 * Should be called only within The Loop.
 *
 * It will be displayed only for post type "post".
 */

if ( empty( $post ) || get_post_type() !== 'post' ) {
	return;
}
?>

<div class="article-meta">
	<p>
		<?php
		the_time( 'F jS, Y ' );
		/* translators: post author attribution */
		printf( __( 'by %s', 'app' ), get_the_author() );
		?>
	</p>

	<p>
		<?php
		_e( 'Posted in ', 'app' );
		the_category( ', ' );
		if ( comments_open() ) {
			echo ' | ';
			comments_popup_link( __( 'No Comments', 'app' ), __( '1 Comment', 'app' ), __( '% Comments', 'app' ) );
		}
		?>
	</p>

	<?php the_tags( '<p>' . __( 'Tags:', 'app' ) . ' ', ', ', '</p>' ); ?>
</div><!-- /.article-meta -->
