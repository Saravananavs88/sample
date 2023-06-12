<?php
class Veolia_Academy_Missing_Dependency_Reporter
{

    const REQUIRED_CAPABILITY = 'activate_plugins';

    /** @var string[] */
    private $required_name_of_plugins;

    /**
     * @param string[] $required_name_of_plugins
     */
    public function __construct($required_name_of_plugins)
    {
        $this->required_name_of_plugins = $required_name_of_plugins;
    }

    public function bind_to_admin_hooks()
    {
        //add_action( 'admin_notices', array( $this, 'display_admin_notice' ) );
        if (is_admin()) {
            $required_name_of_plugins = $this->required_name_of_plugins;
            include dirname(__FILE__) . '/views/missing-dependencies-admin-notice.php';
        }
    }

    public function theme_bind_to_admin_hooks()
    {
        if (is_admin())
            include dirname(__FILE__) . '/views/missing-theme-admin-notice.php';
    }
    public function theme_template_file_check()
    {
        if (is_admin())
            include dirname(__FILE__) . '/views/file_check_admin-notice.php';
    }

    public function display_admin_notice()
    {
        if (!current_user_can(self::REQUIRED_CAPABILITY)) {
            // If the user does not have the wordpress "activate_plugins" capability, do nothing.
            return;
        }
        if (is_admin()) {
        $required_name_of_plugins = $this->required_name_of_plugins;
        include dirname(__FILE__) . '/views/missing-dependencies-admin-notice.php';
        }
    }
}
