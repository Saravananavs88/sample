<?php
class Veolia_Academy_Setup
{

    /** @var Veolia_Academy_Dependency_Checker */
    private $dependency_checker;

    public function init()
    {

        $this->load_includes();
        $this->create_instances();
        $current_theme = wp_get_theme();
        $error_flag = 0;
        $course_list_path = get_template_directory() . '/templates/template-page-course-list.php';
        $course_detail_path = get_template_directory() . '/templates/template-page-course-detail.php';
        try {
            $this->dependency_checker->check();

            if ($current_theme != 'Veolia Academy') {
                $this->Veolia_Academy_Missing_Theme($current_theme, 1);
                $error_flag = 1;
            } else {
                if (file_exists($course_detail_path) && file_exists($course_list_path)) {
                    echo '';
                } else {
                    $error_flag = 1;
                    $this->Veolia_Academy_Missing_Theme($current_theme, 2);
                }
            }
        } catch (Veolia_Academy_Missing_Dependencies_Exception $e) {
            if ($current_theme != 'Veolia Academy') {
                $this->Veolia_Academy_Missing_Theme($current_theme, 1);
                $error_flag = 1;
            } else {

                if (file_exists($course_detail_path) && file_exists($course_list_path)) {
                    echo '';
                } else {
                    $error_flag = 1;
                    $this->Veolia_Academy_Missing_Theme($current_theme, 2);
                }
            }
            // The exception contains the names of missing plugins.
            $this->report_missing_dependencies($e->get_required_name_of_plugins());

            $error_flag = 1;
        }
        return $error_flag;
        // Add here code Like as : - add_action(), add_filter() etc.
        // Do actual plugin functionality registration here - add_action(), add_filter() etc.
    }


    private function load_includes()
    {
        //wordpress Exceptions

        require_once dirname(__FILE__) . '/exceptions/Exception.php';
        require_once dirname(__FILE__) . '/exceptions/Missing_Dependencies_Exception.php';

        //wordpress Dependency checker
        require_once dirname(__FILE__) . '/Dependency_Checker.php';
        require_once dirname(__FILE__) . '/Missing_Dependency_Reporter.php';
    }

    private function create_instances()
    {
        $this->dependency_checker = new Veolia_Academy_Dependency_Checker();
    }

    /**
     * @param string[] $required_name_of_plugins
     */
    private function report_missing_dependencies($required_name_of_plugins)
    {
        $missing_dependency_reporter = new Veolia_Academy_Missing_Dependency_Reporter($required_name_of_plugins);
        $missing_dependency_reporter->bind_to_admin_hooks();
    }

    private function Veolia_Academy_Missing_Theme($current_theme, $err_flag)
    {
        $missing_dependency_reporter = new Veolia_Academy_Missing_Dependency_Reporter($current_theme);
        if ($err_flag == 1) {

            $missing_dependency_reporter->theme_bind_to_admin_hooks();
        }
        if ($err_flag == 2) {
            $missing_dependency_reporter->theme_template_file_check();
        }
    }
}
