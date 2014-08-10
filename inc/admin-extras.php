<?php
/**
 * Code Reference admin extras
 *
 * @package wporg-developer
 */

/**
 * Class to handle admin extras for the Function-, Class-, Hook-,
 * and Method-editing screens.
 */
class WPORG_Admin_Extras {

	/**
	 * Post types array.
	 *
	 * Includes the Code Reference post types.
	 *
	 * @access public
	 * @var array
	 */
	public $post_types;

	/**
	 * Constructor.
	 *
	 * @access public
	 */
	public function __construct() {
		$this->post_types = array( 'wp-parser-function', 'wp-parser-class', 'wp-parser-hook', 'wp-parser-method' );

		add_action( 'add_meta_boxes',                   array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post',                        array( $this, 'save_post'      ) );
		add_action( 'admin_print_scripts-post-new.php', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_print_scripts-post.php',     array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Add meta boxes.
	 *
	 * @access public
	 */
	public function add_meta_boxes() {

		if ( in_array( $screen = get_current_screen()->id, $this->post_types ) && current_user_can( 'manage_options' ) ) {
			add_meta_box( 'wporg_parsed_content', __( 'Manage Parsed Content', 'wporg' ), array( $this, 'parsed_meta_box_cb' ), $screen, 'normal' );
		}
	}

	/**
	 * Parsed content meta box display callback.
	 *
	 * @access public
	 *
	 * @param WP_Post $post Current post object.
	 */
	public function parsed_meta_box_cb( $post ) {
		$ticket      = get_post_meta( $post->ID, 'wporg_parsed_ticket', true );
		$ticket_info = get_post_meta( $post->ID, 'wporg_parsed_ticket_info', true );
		$content     = get_post_meta( $post->ID, 'wporg_parsed_content', true );

		if ( ! $ticket_info ) {
			$link = sprintf( '<a href="https://meta.trac.wordpress.org/newticket">%s</a>', __( 'Meta Trac', 'wporg' ) );
			/* translators: 1: Meta Trac link. */
			$ticket_info = '<em>' . sprintf( __( 'A valid, open ticket number from %s is required to edit parsed content.', 'wporg' ), $link ) . '</em>';
		}
		?>
		<table class="form-table">
			<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="wporg_parsed_ticket"><?php _e( 'Meta Ticket Number:' ); ?></label>
				</th>
				<td>
					<?php wp_nonce_field( 'wporg-get-ticket','wporg-get-ticket-nonce' ); ?>
					<span>
						<input type="text" name="wporg_parsed_ticket" id="wporg_parsed_ticket" value="<?php echo esc_attr( $ticket ); ?>" />
						<input type="button" class="button secondary" value="<?php esc_attr_e( 'Attach Ticket', 'wporg' ); ?>" />
					</span><br />
					<div id="wporg_parsed_ticket_info"><?php echo $ticket_info; ?></div>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="wporg_parsed_content"><?php _e( 'Parsed Content:' ); ?></label>
				</th>
				<td>
					<?php
					wp_nonce_field( 'wporg-parsed-content', 'wporg-parsed-content-nonce' );
					wp_editor( $content, 'wporg_parsed_content_editor', array(
						'media_buttons'  => false,
						'tinymce'        => false,
						'textarea_name'  => 'wporg-parsed-container',
						'textarea_rows'  => 10,
						'teeny'          => true,
					) );
					?>
				</td>
			</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Handle saving post content extras.
	 *
	 * @access public
	 *
	 * @param int $post_id Post ID.
	 */
	public function save_post( $post_id ) {
		// Ticket number.
		if ( isset( $_POST['wporg_parsed_ticket'] ) && wp_verify_nonce( 'wporg-get-ticket-nonce', 'wporg-get-ticket' ) ) {
			if ( current_user_can( 'manage_options' ) ) {

			}
		}

		// Parsed content.
		if ( isset( $_POST['wporg_parsed_content'] ) && wp_verify_nonce( 'wporg-parsed-content-nonce', 'wporg-parsed-content' ) ) {
			if ( current_user_can( 'manage_options' ) ) {

			}
		}
	}

	/**
	 * Enqueue JS on the post-edit and post-new screens.
	 *
	 * @access public
	 */
	public function admin_enqueue_scripts() {
		wp_register_script( 'wporg-admin-extras', get_template_directory_uri() . '/js/admin-extras.js', array( 'jquery' ), '1.0' );

		// Only enqueue 'wporg-admin-extras' on Code Reference post type screens.
		if ( in_array( get_current_screen()->id, $this->post_types ) ) {
			wp_enqueue_script( 'wporg-admin-extras' );
		}
	}

} // WPORG_Admin_Extras

$extras = new WPORG_Admin_Extras();
