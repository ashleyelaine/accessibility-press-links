<?php
namespace accessibility_press_links;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * This is the main controller. Plugin - wide methods are called from here.
 * User: fjorgedevelopers
 * Date: 10/27/15
 * Time: 3:22 PM
 *
 */
class DefaultController {

	/**
	 * @var AdminController The Controller that will handle any admin hooks (actions)
	 */
	private $adminController;
	/**
	 * @var PublicController The Controller that will handle any public hooks (actions or filters)
	 */
	private $publicController;

	/**
	 * Register the hooks that run on init and shutdown
	 */
	public function __construct() {
		if ( is_admin() ) {
			$this->adminController = new AdminController();
			add_action( 'init', array( &$this, 'register_admin_hooks' ) );
			add_action( 'shutdown', array( &$this, 'admin_shutdown' ) );
		} else {
			$this->publicController = new PublicController();
			add_action( 'init', array( &$this, 'register_public_hooks' ) );
			add_action( 'shutdown', array( &$this, 'public_shutdown' ) );
		}
	}

	/**
	 * This adds the hooks to the Admin Controller
	 */
	public function register_admin_hooks() {
		//add_action( 'action_hook_name', array( &$this->publicController, 'hook_name' ) );

		$displayName = $this->getPluginDisplayName();

		add_action( 'admin_menu', array( &$this->adminController, 'addMenuItem' ) );
		// add_menu_page( $displayName,
  //                     $displayName,
  //                     'manage_options',
  //                     'slug',
  //                     array('AdminController', 'publishPage'));

       // Also call it "Publish"
       // add_submenu_page( $this->getPublishSlug(), 'Publish',
       //                'Publish',
       //                'manage_options',
       //                $this->getPublishSlug(),
       //                array('AdminController', 'publishPage'));
	}

	/**
	 * This adds the hooks to the Public Controller
	 */
	public function register_public_hooks() {
		// 10 is the priority (10 is default), which is only included so we can include the next parameter
		// which is 2, the number of arguments passed
		//add_filter( 'filter_hook_name', array( &$this->publicController, 'method_name' ), 10, 2 );
	}

	/**
	 * On admin shutdown.
	 */
	public function admin_shutdown() {

	}
	/**
	 * On public shutdown.
	 */
	public function public_shutdown() {

	}



	public function getPluginDisplayName() {
		return 'AccessibilityPress: Links';
	}

	protected function getMainPluginFileName() {
		return dirname(dirname(__FILE__)).'/plugin.php';
	}


}

// This fails code smell, but is apparently the way wp plugins are
$controller = new DefaultController();
