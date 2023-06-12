<?php
// for adding menus
function veolia_add_menus()
{
   register_nav_menu('primaryVeoliaHeaderMenu', 'Veolia Header Menu');
   add_theme_support('veolia-academy');
}

add_action('after_setup_theme', 'veolia_add_menus');


// for adding nav-item class
function  veolia_add_menu_items_li($items, $args)
{
   $dom = new DOMDocument();
   $dom->loadHTML($items);

   $find = $dom->getElementsByTagName('li');

   foreach ($find as $item) :
      $item->setAttribute('class', 'nav-item');
   endforeach;

   return $dom->saveHTML();
}

add_filter('wp_nav_menu_items', 'veolia_add_menu_items_li', 10, 2);


// for adding nav-link class
function veolia_add_link_atts($atts)
{
   $atts['class'] = 'nav-link';
   return $atts;
}

add_filter('nav_menu_link_attributes', 'veolia_add_link_atts');

// for append list in nav item
function veolia_add_last_nav_item($items)
{
   $redirect_to = get_option('siteurl') . "/wp-login.php?action=login";

   $mycourse_url = esc_url(home_url() . '/my-course-list');

   if (is_user_logged_in()) {
      $nav_list_items = '<li class="dropdown nav-item mr-border">
      <a class="dropdown-toggle nav-link veolia-user-icon" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fal fa-user"></i>
        </a>
          <ul class="dropdown-menu">
              <li><span class="dropdown-item-text d-none">My Accounts</span></li>
              <li><a target="_blank" href="' . $mycourse_url . '" class="dropdown-item nav-link">My Courses</a></li>
              <li><a href="' . esc_url(home_url() . '/order-list') . '" class="dropdown-item nav-link">My Orders</a></li>
              <li><a href="' . esc_url(wp_logout_url($redirect_to)) . '" class="dropdown-item nav-link">Log out</a></li>
          </ul>
      </li>';
   } else {
      $nav_list_items = '<li class="nav-item mr-border"><a href="' . esc_url(home_url() . '/wp-login.php?action=register') . '" class="btn btn-sm btn-outline-secondary me-2"><i class="fas fa-pen-alt pe-1"></i> Register</a></li><li class="nav-item"><a href="' . esc_url(home_url() . '/wp-login.php') . '" class="btn btn-sm btn-success">Login</a></li>';
   }
   $veolia_lms_cart_badge_count = 0;
   if (isset($_SESSION["veolia_lms_my_cart_list"]) && !empty($_SESSION["veolia_lms_my_cart_list"])) {
      $veolia_lms_cart_list = $_SESSION["veolia_lms_my_cart_list"];
      $veolia_lms_cart_badge_count = count($veolia_lms_cart_list);
   }
   return $items .= '' . $nav_list_items.'<li class="nav-item veolia-floating-shopping-cart">

   <a href="' . esc_url(home_url() . '/shopping-cart') . '" class="nav-link">

   <i class="fal fa-shopping-cart"></i>

   <span class="veolia-floating-shopping-cart-badge" id="veolia-lms-my-cart-list-count">' . $veolia_lms_cart_badge_count . '</span>

   </a></li>';
}
add_filter('wp_nav_menu_items', 'veolia_add_last_nav_item');
