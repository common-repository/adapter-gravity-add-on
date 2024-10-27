<?php
/**
 * Email form, to optionally place at the end of a post.
 *
 * @package AdapterGravityAddOn
 */

namespace AdapterGravityAddOn;

/**
 * Handles the front-end display of the email form.
 *
 * Based on the settings, displays a form at the end of posts, and/or horizontally.
 * Also, adds classes to <input> elements of type 'text,' 'email,' and 'submit.'
 */
class EmailForm {
	private EmailSetting $email_setting;
	private array $forms;
	private $get_form;
	private $gravity_form;
	private static int $tab_index = 0;

	public function __construct(
		EmailSetting $email_setting,
		array $forms,
		callable $get_form,
		callable $gravity_form
	) {
		$this->email_setting = $email_setting;
		$this->forms         = $forms;
		$this->get_form      = $get_form;
		$this->gravity_form  = $gravity_form;
	}

	/** Adds the filters for the class. */
	public function init(): void {
		add_filter( 'the_content', [ $this, 'conditionally_append_form' ], 100 );
	}

	/**
	 * Conditionally appends a form to the post content.
	 *
	 * The form returned from GFAPI::get_form( $form->id ) has more metadata.
	 * So it's not possible to simply pass $form to $this->do_append_form_to_content().
	 */
	public function conditionally_append_form( string $content ): string {
		foreach ( $this->forms as $form ) {
			if ( isset( $form->id ) && $this->do_append_form_to_content( call_user_func( $this->get_form, $form->id ) ) ) {
				return $this->append_form_to_content( $form->id, $content );
			}
		}

		return $content;
	}

	/** Whether to append a form to the content. */
	public function do_append_form_to_content( array $form ): bool {
		return (
			isset( $form[ $this->email_setting->bottom_of_post ] )
			&&
			'1' === $form[ $this->email_setting->bottom_of_post ]
			&&
			'post' === get_post_type()
		);
	}

	/**
	 * Append Gravity Form to the end of the post content.
	 *
	 * Filter callback for 'the_content.'
	 * Use the form that this class processed.
	 */
	public function append_form_to_content( int $form_id, string $content ): string {
		self::$tab_index = self::$tab_index + 2;
		return $content . call_user_func( $this->gravity_form, $form_id, false, false, false, '', true, self::$tab_index, false );
	}
}
