<?php
class Veolia_Academy_Dependency_Checker {

    /**
     * Define the plugins that our plugin requires to function.
     * Array format: 'REQUIRED_PLUGINS Name' => 'Path to main plugin file'
     */
    const REQUIRED_PLUGINS = array(
        'Custom Field Suite'     => 'custom-field-suite/cfs.php',
        'Elementor' => 'elementor/elementor.php',
        'LoftLoader' => 'loftloader/loftloader.php',
    );

    /**
     * Check if all required plugins are active, otherwise throw an exception.
     *
     * @throws Veolia_Academy_Missing_Dependencies_Exception
     */
    public function check() {
        $missing_plugins = $this->get_missing_plugins_list();
        
        if ( ! empty( $missing_plugins ) ) {
            throw new Veolia_Academy_Missing_Dependencies_Exception( $missing_plugins );
        }
    }

    /**
     * @return string[] Names of plugins that we require, but that are inactive.
     */
    private function get_missing_plugins_list() {
        $missing_plugins = array();
        foreach ( self::REQUIRED_PLUGINS as $plugin_name => $main_file_path ) {
            if ( ! $this->is_plugin_active( $main_file_path ) ) {
                $missing_plugins[] = $plugin_name;
            }
        }
        return $missing_plugins;
    }

    /**
     * @param string $main_file_path Path to main plugin file, as defined in self::REQUIRED_PLUGINS.
     *
     * @return bool
     */
    private function is_plugin_active( $main_file_path ) {
        return in_array( $main_file_path, $this->get_active_plugins() );
    }

    /**
     * @return string[] Returns an array of active plugins' main files.
     */
    private function get_active_plugins() {
        return apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
    }

}