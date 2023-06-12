<?php
class Veolia_Academy_Missing_Dependencies_Exception extends Veolia_Academy_Exception {

    /** @var string[] */
    private $required_name_of_plugins;

    /**
     * @param string[] $required_name_of_plugins Names of the plugins that our plugin depends on,
     *                                       that were found to be inactive.
     */
    public function __construct( $required_name_of_plugins ) {
        $this->required_name_of_plugins = $required_name_of_plugins;
    }

    /**
     * @return string[]
     */
    public function get_required_name_of_plugins() {
        return $this->required_name_of_plugins;
    }

}