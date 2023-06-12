<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/** @var string[] $required_name_of_plugins */
?>
<div class="error notice">
    <p>
        <strong>Error:</strong>
        The <em>Veolia Academy - LMS </em> plugin won't execute
        because the following required plugins are not active:
        <ul>
        <?php foreach($required_name_of_plugins as $plugin_name): ?>
        <li><?php echo $plugin_name; ?></li>    
        <?php endforeach; ?>
        </li>    
                
    </p>
</div>