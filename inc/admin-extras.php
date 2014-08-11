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

		// Data.
		add_action( 'add_meta_boxes',                   array( $this, 'add_meta_boxes'        ) );
		add_action( 'save_post',                        array( $this, 'save_post'             ) );

		// Script.
//		add_action( 'admin_print_scripts-post-new.php', array( $this, 'admin_enqueue_scripts' ) );
//		add_action( 'admin_print_scripts-post.php',     array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts',            array( $this, 'admin_enqueue_scripts' ) );
		// AJAX
		add_action( 'wp_ajax_wporg_fetch_ticket',       array( $this, 'fetch_ticket'          ) );
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
			$link = sprintf( '<a href="https://core.trac.wordpress.org/newticket">%s</a>', __( 'Core Trac', 'wporg' ) );
			/* translators: 1: Meta Trac link. */
			$ticket_info = '<em>' . sprintf( __( 'A valid, open ticket from %s is required to edit parsed content.', 'wporg' ), $link ) . '</em>';
		}
		wp_nonce_field( 'wporg-parsed-content', 'wporg-parsed-content-nonce' );
		?>
		<style type="text/css">
			#wporg_editor_outer {
				display: none;
			}
			#wporg_parsed_ticket {
				width: 100px;
			}
			#ticket_info_icon {
				font-size: 14px;
			}
		</style>

		<table class="form-table">
			<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="wporg_parsed_ticket"><?php _e( 'Trac Ticket Number:' ); ?></label>
				</th>
				<td>
					<span>
						<input type="text" name="wporg_parsed_ticket" id="wporg_parsed_ticket" value="<?php echo esc_attr( $ticket ); ?>" />
						<a href="#fetch-ticket" class="button secondary" id="wporg_ticket_fetch" name="wporg_ticket_fetch" data-nonce="<?php echo wp_create_nonce( 'wporg-get-ticket' ); ?>">
							<?php esc_attr_e( 'Attach Ticket', 'wporg' ); ?>
						</a>
					</span><br />
					<span id="ticket_info_icon" style="color:#a00;"></span><span id="wporg_parsed_ticket_info"><?php echo $ticket_info; ?></span>
				</td>
			</tr>
			<tr valign="top" id="wporg_editor_outer">
				<th scope="row">
					<label for="wporg_parsed_content"><?php _e( 'Parsed Content:' ); ?></label>
				</th>
				<td>
					<?php
					wp_editor( $content, 'wporg_parsed_content_editor', array(
						'media_buttons' => false,
						'tinymce'       => false,
						'quicktags'     => true,
						'textarea_rows' => 10,
						'textarea_name' => 'wporg_parsed_content'
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
		// Only admins can edit parsed content.
		if ( current_user_can( 'manage_options' ) && wp_verify_nonce( $_POST['wporg-parsed-content-nonce'], 'wporg-parsed-content' ) ) {
			// Ticket number.
			if ( empty( $_POST['wporg_parsed_ticket'] ) ) {
				delete_post_meta( $post_id, 'wporg_parsed_ticket' );
			} else {
				update_post_meta( $post_id, 'wporg_parsed_ticket', sanitize_text_field( $_POST['wporg_parsed_ticket'] ) );
			}

			// Parsed content.
			if ( empty( $_POST['wporg_parsed_content'] ) ) {
				delete_post_meta( $post_id, 'wporg_parsed_content' );
			} else {
				update_post_meta( $post_id, 'wporg_parsed_content', wp_kses_post( $_POST['wporg_parsed_content'] ) );
			}
		}
	}

	/**
	 * Enqueue JS on the post-edit and post-new screens.
	 *
	 * @access public
	 */
	public function admin_enqueue_scripts() {
		wp_register_script( 'admin-extras', get_template_directory_uri() . '/js/admin-extras.js', array( 'jquery' ), '1.0' );

		// Only enqueue 'wporg-admin-extras' on Code Reference post type screens.
		if ( in_array( get_current_screen()->id, $this->post_types ) ) {
			wp_localize_script( 'admin-extras', 'wporg', array(
				'ajaxURL'      => admin_url( 'admin-ajax.php' ),
				'fetchRetry'   => __( 'Try Again', 'wporg' ),
			) );
			wp_enqueue_script( 'admin-extras' );
		}
	}

} // WPORG_Admin_Extras

$extras = new WPORG_Admin_Extras();
