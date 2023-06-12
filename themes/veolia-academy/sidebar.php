<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


?>
<aside role="complementary">
    <?php if(is_active_sidebar('primary-sidebar')){ ?>
    <?php dynamic_sidebar('primary-sidebar'); ?>
  <?php  } else { ?>
    add your widgets
    <?php } ?>
</aside>

