<?php
/**
 * The core plugin functionality
 *
 * @package SM_Wordfence_Scanner
 * @author Sean Murphy <sean@iamseanmurphy.com>
 */
class SM_Wordfence_Scanner {

	const PLUGIN_NAME = 'sm-wordfence-scanner';
	const VERSION = '1.0.0';

	/**
	 * Activate the plugin
	 *
	 * @static
	 */
	public static function activate() {
		update_option( self::PLUGIN_NAME.'-version', self::VERSION );
	}

	/**
	 * Deactivate the plugin
	 *
	 * @static
	 */
	public static function deactivate() {}

	/**
	 * Uninstall the plugin
	 *
	 * @static
	 */
	public static function uninstall() {
		delete_option( self::PLUGIN_NAME.'-version' );
	}
	
	/**
	 * Initialize the plugin by registering any hooks the plugin needs to run
	 *
	 * @static
	 */
	public static function init() {
		// If Wordfence is not activated, display a warning
		if ( is_plugin_inactive( 'wordfence/wordfence.php' ) ) {
			add_thickbox();
			add_action( 'admin_notices', array( 'SM_Wordfence_Scanner', 'display_warning') );
		}
	}

	/**
	 * Output a warning to the user
	 *
	 * @static
	 */
	public static function display_warning() {
		if ( array_key_exists( 'wordfence/wordfence.php', get_plugins() ) ) {
			// If Wordfence is already installed, prompt to activate
			$link = admin_url('plugins.php');
			$text = 'Activate Wordfence Now';
			$class = '';
		} else {
			// If Wordfence is not installed, prompt to install
			$link = wp_nonce_url('plugin-install.php?tab=plugin-information&plugin=wordfence', 'install-plugin_wordfence') . '&amp;TB_iframe=true&amp;width=600&amp;height=600';
			$text = 'Install Wordfence Now';
			$class = 'thickbox';
		}
		?>
		<div class="update-nag">
			<p><strong>WARNING!</strong> Your website is at risk of being taken over by hackers! <a href="<?php echo $link; ?>" class="button button-primary <?php echo $class; ?>"><?php echo $text; ?></a> to secure your site.</p>
		</div>
		<?php
	}

}