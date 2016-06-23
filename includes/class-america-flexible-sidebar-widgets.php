<?php
/**
	* The file that defines custom widgets
	*
	* @link       https://github.com/USStateDept/Flexibile-Sidebar
	* @since      3.0.0
	*
	* @package    America_Flexible_Sidebar
	* @subpackage America_Flexible_Sidebar/includes
	*/



/**
  * The custom promoted links widget
	*
	* @todo Make this more generic, and less specific to the `link` post_format
  *
	* @since      3.0.0
	* @package    America_Flexible_Sidebar
	* @subpackage America_Flexible_Sidebar/includes
	* @author     Office of Design, U.S. Department of State
  */

class America_Promoted_Links_Widget extends WP_Widget {

	/**
		* Initialize the class and set its properties.
		*
		* @since 3.0.0
		*/

	public function __construct() {
		$widget_ops = array(
			'classname' => 'promoted_links',
			'description' => __( 'A list of promoted links related to the current category', 'america' ),
		);

		parent::__construct( 'promoted_links', 'Promoted Links', $widget_ops );
	}


	/**
		* Outputs the content of the widget to the front-end
		*
		* @param $args Array - Widget arguments
		* @param $instance Array - Saved values from the DB
		*
		* @see WP_Widget::widget()
		* @since 3.0.0
		*/

	public function widget( $args, $instance ) {
		$posts = $this->get_posts();

		if ( empty( $posts ) ) {
			return;
		}

		$html = $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			$html .= $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$html .= '<ul>';

			foreach ( $posts as $post ) {

				// ACF stores its data in the post_meta, so retrieve it from the DB
				$post_meta = get_post_meta( $post->ID );

				// Get the link from the custom field `america_link_post_format`
				$link = $post_meta['america_link_post_format'][0];

				// Build the link item and link to the resource
				$html .= sprintf( '<li class="link-item"><a href="%s">%s</a></li>', esc_url( $link ), $post->post_title );
			}

		$html .= '</ul>';

		$html .= $args['after_widget'];

		echo $html;
	}


	/**
		* Widget form found in Appearance > Widgets
		*
		* @param $instance Array - Previously saved values from database.
		*
		* @see WP_Widget::form()
		* @since 3.0.0
		*/

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'america' ); ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
		<?php
	}


	/**
		* Sanitize widget form values as they are saved.
		*
		* @param $new_instance Array - Values just sent to be saved.
		* @param $old_instance Array - Previously saved values from database.
		*
		* @return array Updated safe values to be saved.
		*
		* @see WP_Widget::update()
		* @since 3.0.0
		*/

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}


	/**
		* Get the the `link` post_format from the same category as the current post
		*
		* @return $posts Array - An array of post objects
		* @since 3.0.0
		*/

	private function get_posts() {
		Global $wp_query;

		// Only get `link` post_formats from the categories of the current post
		if ( is_single() ) {
			$post_id = $wp_query->get_queried_object_id();
			$categories = wp_get_post_categories( $post_id );
		}

		// Only get `link` post_formats from the current category
		if ( is_archive() ) {
			$categories[] = get_query_var('cat');
		}

		// Pass an array with an empty string to get all `link` post_formats from all categories
		if ( is_home() ) {
			$categories = array( '' );
		}

		$posts = $this->query_posts( $categories );

		return $posts;
	}


	/**
		* Query for matching posts
		*
		* @param $categories Array - An array of category ids
		*
		* @return $pots Array - An array of post objects
		* @since 3.0.0
		*/

	private function query_posts( $categories ) {
		$posts = array();

		if ( empty( $categories ) ) {
			return $posts;
		}

		foreach( $categories as $category ) {
			$args = array(
				'category' => $category,
				'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array( "post-format-link" ),
					),
				)
			);

			// Merge the query results at each iteration with the $posts array to keep the array flat for easier manipulation
			$posts = array_merge( $posts, get_posts( $args ) );
		}

		return $posts;
	}
}
