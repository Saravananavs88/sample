<?php 

// for adding sidebar widgets
function veolia_sidebar_widgets(){
    register_sidebar(array(
        'id' => 'primary-sidebar',
        'name'  => esc_html('This sidebar appears in the blog posts page.','veoliatheme'),
        'description' => esc_html('This sidebar appears in the blog posts page.','veoliatheme'),
        'before_widget'=> '<section id="%1$s" class="c-sidebar-widget u-margin-bottom-20 %2$s"',
        'after_widget' => '</section>',
        'before_title' => '<h5>',
        'after_title' => '</h5>' 
    ));
 
 
 }
 add_action('widgets_init','veolia_sidebar_widgets');

 ?>