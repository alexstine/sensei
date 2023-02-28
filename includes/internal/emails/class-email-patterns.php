<?php
/**
 * Email Patterns.
 *
 * @package sensei
 */

namespace Sensei\Internal\Emails;

/**
 * Email Patterns class.
 *
 * @internal
 *
 * @since $$next-version$$
 */
class Email_Patterns {

	/**
	 * Email_Patterns constructor.
	 *
	 * @internal
	 */
	public function __construct() {}

	/**
	 * Initialize the class and add hooks.
	 *
	 * @internal
	 */
	public function init() {
		add_action( 'current_screen', [ $this, 'register_email_editor_block_patterns' ] );
		add_action( 'init', [ $this, 'register_block_patterns_category' ] );
	}

	/**
	 * Register Sensei block patterns category.
	 *
	 * @access private
	 */
	public function register_block_patterns_category() {
		register_block_pattern_category(
			'sensei-emails',
			[ 'label' => __( 'Sensei Emails', 'sensei-lms' ) ]
		);
	}

	/**
	 * Register block patterns.
	 *
	 * @access private
	 *
	 * @since $$next-version$$
	 *
	 * @param WP_Screen $current_screen Current screen.
	 */
	public function register_email_editor_block_patterns( $current_screen ) {
		$post_type = $current_screen->post_type;

		if ( 'sensei_email' === $post_type ) {
			$this->register_email_block_patterns();
		}
	}

	/**
	 * Register email block patterns.
	 *
	 * @access private
	 *
	 * @since $$next-version$$
	 */
	public function register_email_block_patterns() {
		$patterns = [
			'student-completes-course' =>
				[
					'title'      => __( 'Email sent to teacher after a student completes a course', 'sensei-lms' ),
					'categories' => [ 'sensei-emails' ],
					'content'    => $this->get_pattern_content_from_file( 'student-completes-course' ),
				],
			'student-starts-course'    =>
				[
					'title'      => __( 'Email sent to teacher when a student starts a course', 'sensei-lms' ),
					'categories' => [ 'sensei-emails' ],
					'content'    => $this->get_pattern_content_from_file( 'student-starts-course' ),
				],
		];

		foreach ( $patterns as $key => $pattern ) {
			register_block_pattern(
				'sensei-lms/' . $key,
				$pattern
			);
		}
	}

	/**
	 * Get the pattern content from a file.
	 *
	 * @param string $file The file name.
	 *
	 * @return string The pattern content.
	 */
	public function get_pattern_content_from_file( $file ) {
		$pattern_file = __DIR__ . '/patterns/' . $file . '.php';

		if ( ! file_exists( $pattern_file ) ) {
			return '';
		}

		ob_start();
		require $pattern_file;
		return ob_get_clean();
	}

}
