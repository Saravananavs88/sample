<?php session_start();
include_once "wp-config.php";
    include "wp-load.php";
    $status='FAILURE';
    
    get_header(); 
   
    if(isset($_GET['s']))
       $status = $_GET['s'];
    else
    {
        header('Location:'.$_SERVER['PHP_SELF'].'?s='.$status);
        die();
    }
    
       
?>
<!DOCTYPE html>
<html>
<head>
<title>failure</title>
<style type="text/css">
.page-header{
    text-align: left;
    margin-left:5%;
}
.elementor-button-wrapper .elementor-button {

background-color: #598419 !important;

border-color: #598419 !important;

}
</style>
<style id='astra-theme-css-inline-css'>
html{font-size:100%;}a,.page-title{color:#2171ff;}a:hover,a:focus{color:#3a3a3a;}body,button,input,select,textarea,.ast-button,.ast-custom-button{font-family:Arial,Helvetica,Verdana,sans-serif;font-weight:400;font-size:16px;font-size:1rem;line-height:1.8;}blockquote{color:#000000;}h1,.entry-content h1,.entry-content h1 a,h2,.entry-content h2,.entry-content h2 a,h3,.entry-content h3,.entry-content h3 a,h4,.entry-content h4,.entry-content h4 a,h5,.entry-content h5,.entry-content h5 a,h6,.entry-content h6,.entry-content h6 a,.site-title,.site-title a{font-family:Arial,Helvetica,Verdana,sans-serif;font-weight:400;}.site-title{font-size:24px;font-size:1.5rem;}header .site-logo-img .custom-logo-link img{max-width:140px;}.astra-logo-svg{width:140px;}.ast-archive-description .ast-archive-title{font-size:40px;font-size:2.5rem;}.site-header .site-description{font-size:15px;font-size:0.9375rem;}.entry-title{font-size:30px;font-size:1.875rem;}.comment-reply-title{font-size:26px;font-size:1.625rem;}.ast-comment-list #cancel-comment-reply-link{font-size:16px;font-size:1rem;}h1,.entry-content h1,.entry-content h1 a{font-size:75px;font-size:4.6875rem;font-weight:400;font-family:Arial,Helvetica,Verdana,sans-serif;line-height:1.3;}h2,.entry-content h2,.entry-content h2 a{font-size:38px;font-size:2.375rem;font-weight:400;font-family:Arial,Helvetica,Verdana,sans-serif;line-height:1.29;}h3,.entry-content h3,.entry-content h3 a{font-size:26px;font-size:1.625rem;font-weight:400;font-family:Arial,Helvetica,Verdana,sans-serif;line-height:1.29;}h4,.entry-content h4,.entry-content h4 a{font-size:20px;font-size:1.25rem;}h5,.entry-content h5,.entry-content h5 a{font-size:18px;font-size:1.125rem;}h6,.entry-content h6,.entry-content h6 a{font-size:15px;font-size:0.9375rem;}.ast-single-post .entry-title,.page-title{font-size:30px;font-size:1.875rem;}#secondary,#secondary button,#secondary input,#secondary select,#secondary textarea{font-size:16px;font-size:1rem;}::selection{background-color:#2171ff;color:#ffffff;}body,h1,.entry-title a,.entry-content h1,.entry-content h1 a,h2,.entry-content h2,.entry-content h2 a,h3,.entry-content h3,.entry-content h3 a,h4,.entry-content h4,.entry-content h4 a,h5,.entry-content h5,.entry-content h5 a,h6,.entry-content h6,.entry-content h6 a{color:#2c2c2c;}.tagcloud a:hover,.tagcloud a:focus,.tagcloud a.current-item{color:#ffffff;border-color:#2171ff;background-color:#2171ff;}.main-header-menu .menu-link,.ast-header-custom-item a{color:#2c2c2c;}.main-header-menu .menu-item:hover > .menu-link,.main-header-menu .menu-item:hover > .ast-menu-toggle,.main-header-menu .ast-masthead-custom-menu-items a:hover,.main-header-menu .menu-item.focus > .menu-link,.main-header-menu .menu-item.focus > .ast-menu-toggle,.main-header-menu .current-menu-item > .menu-link,.main-header-menu .current-menu-ancestor > .menu-link,.main-header-menu .current-menu-item > .ast-menu-toggle,.main-header-menu .current-menu-ancestor > .ast-menu-toggle{color:#2171ff;}input:focus,input[type="text"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="password"]:focus,input[type="reset"]:focus,input[type="search"]:focus,textarea:focus{border-color:#2171ff;}input[type="radio"]:checked,input[type=reset],input[type="checkbox"]:checked,input[type="checkbox"]:hover:checked,input[type="checkbox"]:focus:checked,input[type=range]::-webkit-slider-thumb{border-color:#2171ff;background-color:#2171ff;box-shadow:none;}.site-footer a:hover + .post-count,.site-footer a:focus + .post-count{background:#2171ff;border-color:#2171ff;}.ast-small-footer{color:#adadad;}.ast-small-footer > .ast-footer-overlay{background-color:rgba(207,231,207,0.57);;}.footer-adv .footer-adv-overlay{border-top-style:solid;border-top-color:#7a7a7a;}.ast-comment-meta{line-height:1.666666667;font-size:13px;font-size:0.8125rem;}.single .nav-links .nav-previous,.single .nav-links .nav-next,.single .ast-author-details .author-title,.ast-comment-meta{color:#2171ff;}.entry-meta,.entry-meta *{line-height:1.45;color:#2171ff;}.entry-meta a:hover,.entry-meta a:hover *,.entry-meta a:focus,.entry-meta a:focus *{color:#3a3a3a;}.ast-404-layout-1 .ast-404-text{font-size:200px;font-size:12.5rem;}.widget-title{font-size:22px;font-size:1.375rem;color:#2c2c2c;}#cat option,.secondary .calendar_wrap thead a,.secondary .calendar_wrap thead a:visited{color:#2171ff;}.secondary .calendar_wrap #today,.ast-progress-val span{background:#2171ff;}.secondary a:hover + .post-count,.secondary a:focus + .post-count{background:#2171ff;border-color:#2171ff;}.calendar_wrap #today > a{color:#ffffff;}.ast-pagination a,.page-links .page-link,.single .post-navigation a{color:#2171ff;}.ast-pagination a:hover,.ast-pagination a:focus,.ast-pagination > span:hover:not(.dots),.ast-pagination > span.current,.page-links > .page-link,.page-links .page-link:hover,.post-navigation a:hover{color:#3a3a3a;}.ast-header-break-point .ast-mobile-menu-buttons-minimal.menu-toggle{background:transparent;color:#f01d04;}.ast-header-break-point .ast-mobile-menu-buttons-outline.menu-toggle{background:transparent;border:1px solid #f01d04;color:#f01d04;}.ast-header-break-point .ast-mobile-menu-buttons-fill.menu-toggle{background:#f01d04;color:#ffffff;}.wp-block-buttons.aligncenter{justify-content:center;}@media (max-width:782px){.entry-content .wp-block-columns .wp-block-column{margin-left:0px;}}@media (max-width:768px){#secondary.secondary{padding-top:0;}.ast-separate-container .ast-article-post,.ast-separate-container .ast-article-single{padding:1.5em 2.14em;}.ast-separate-container #primary,.ast-separate-container #secondary{padding:1.5em 0;}.ast-separate-container.ast-right-sidebar #secondary{padding-left:1em;padding-right:1em;}.ast-separate-container.ast-two-container #secondary{padding-left:0;padding-right:0;}.ast-page-builder-template .entry-header #secondary{margin-top:1.5em;}.ast-page-builder-template #secondary{margin-top:1.5em;}#primary,#secondary{padding:1.5em 0;margin:0;}.ast-left-sidebar #content > .ast-container{display:flex;flex-direction:column-reverse;width:100%;}.ast-author-box img.avatar{margin:20px 0 0 0;}.ast-pagination{padding-top:1.5em;text-align:center;}.ast-pagination .next.page-numbers{display:inherit;float:none;}}@media (max-width:768px){.ast-page-builder-template.ast-left-sidebar #secondary{padding-right:20px;}.ast-page-builder-template.ast-right-sidebar #secondary{padding-left:20px;}.ast-right-sidebar #primary{padding-right:0;}.ast-right-sidebar #secondary{padding-left:0;}.ast-left-sidebar #primary{padding-left:0;}.ast-left-sidebar #secondary{padding-right:0;}.ast-pagination .prev.page-numbers{padding-left:.5em;}.ast-pagination .next.page-numbers{padding-right:.5em;}}@media (min-width:769px){.ast-separate-container.ast-right-sidebar #primary,.ast-separate-container.ast-left-sidebar #primary{border:0;}.ast-separate-container.ast-right-sidebar #secondary,.ast-separate-container.ast-left-sidebar #secondary{border:0;margin-left:auto;margin-right:auto;}.ast-separate-container.ast-two-container #secondary .widget:last-child{margin-bottom:0;}.ast-separate-container .ast-comment-list li .comment-respond{padding-left:2.66666em;padding-right:2.66666em;}.ast-author-box{-js-display:flex;display:flex;}.ast-author-bio{flex:1;}.error404.ast-separate-container #primary,.search-no-results.ast-separate-container #primary{margin-bottom:4em;}}@media (min-width:769px){.ast-right-sidebar #primary{border-right:1px solid #eee;}.ast-right-sidebar #secondary{border-left:1px solid #eee;margin-left:-1px;}.ast-left-sidebar #primary{border-left:1px solid #eee;}.ast-left-sidebar #secondary{border-right:1px solid #eee;margin-right:-1px;}.ast-separate-container.ast-two-container.ast-right-sidebar #secondary{padding-left:30px;padding-right:0;}.ast-separate-container.ast-two-container.ast-left-sidebar #secondary{padding-right:30px;padding-left:0;}}.elementor-button-wrapper .elementor-button{border-style:solid;border-top-width:0;border-right-width:0;border-left-width:0;border-bottom-width:0;}body .elementor-button.elementor-size-sm,body .elementor-button.elementor-size-xs,body .elementor-button.elementor-size-md,body .elementor-button.elementor-size-lg,body .elementor-button.elementor-size-xl,body .elementor-button{border-radius:2px;padding-top:15px;padding-right:40px;padding-bottom:15px;padding-left:40px;}.elementor-button-wrapper .elementor-button{border-color:#f01d04;background-color:#f01d04;}.elementor-button-wrapper .elementor-button:hover,.elementor-button-wrapper .elementor-button:focus{color:#ffffff;background-color:#f01d04;border-color:#f01d04;}.wp-block-button .wp-block-button__link,.elementor-button-wrapper .elementor-button,.elementor-button-wrapper .elementor-button:visited{color:#ffffff;}.elementor-button-wrapper .elementor-button{font-family:'Montserrat',sans-serif;font-weight:600;line-height:1;text-transform:capitalize;}body .elementor-button.elementor-size-sm,body .elementor-button.elementor-size-xs,body .elementor-button.elementor-size-md,body .elementor-button.elementor-size-lg,body .elementor-button.elementor-size-xl,body .elementor-button{font-size:16px;font-size:1rem;}.wp-block-button .wp-block-button__link{border-style:solid;border-top-width:0;border-right-width:0;border-left-width:0;border-bottom-width:0;border-color:#f01d04;background-color:#f01d04;color:#ffffff;font-family:'Montserrat',sans-serif;font-weight:600;line-height:1;text-transform:capitalize;font-size:16px;font-size:1rem;border-radius:2px;padding-top:15px;padding-right:40px;padding-bottom:15px;padding-left:40px;}.wp-block-button .wp-block-button__link:hover,.wp-block-button .wp-block-button__link:focus{color:#ffffff;background-color:#f01d04;border-color:#f01d04;}.elementor-widget-heading h1.elementor-heading-title{line-height:1.3;}.elementor-widget-heading h2.elementor-heading-title{line-height:1.29;}.elementor-widget-heading h3.elementor-heading-title{line-height:1.29;}.menu-toggle,button,.ast-button,.ast-custom-button,.button,input#submit,input[type="button"],input[type="submit"],input[type="reset"]{border-style:solid;border-top-width:0;border-right-width:0;border-left-width:0;border-bottom-width:0;color:#ffffff;border-color:#f01d04;background-color:#f01d04;border-radius:2px;padding-top:15px;padding-right:40px;padding-bottom:15px;padding-left:40px;font-family:'Montserrat',sans-serif;font-weight:600;font-size:16px;font-size:1rem;line-height:1;text-transform:capitalize;}button:focus,.menu-toggle:hover,button:hover,.ast-button:hover,.button:hover,input[type=reset]:hover,input[type=reset]:focus,input#submit:hover,input#submit:focus,input[type="button"]:hover,input[type="button"]:focus,input[type="submit"]:hover,input[type="submit"]:focus{color:#ffffff;background-color:#f01d04;border-color:#f01d04;}@media (min-width:768px){.ast-container{max-width:100%;}}@media (min-width:544px){.ast-container{max-width:100%;}}@media (max-width:544px){.ast-separate-container .ast-article-post,.ast-separate-container .ast-article-single{padding:1.5em 1em;}.ast-separate-container #content .ast-container{padding-left:0.54em;padding-right:0.54em;}.ast-separate-container #secondary{padding-top:0;}.ast-separate-container.ast-two-container #secondary .widget{margin-bottom:1.5em;padding-left:1em;padding-right:1em;}.ast-separate-container .comments-count-wrapper{padding:1.5em 1em;}.ast-separate-container .ast-comment-list li.depth-1{padding:1.5em 1em;margin-bottom:1.5em;}.ast-separate-container .ast-comment-list .bypostauthor{padding:.5em;}.ast-separate-container .ast-archive-description{padding:1.5em 1em;}.ast-search-menu-icon.ast-dropdown-active .search-field{width:170px;}.ast-separate-container .comment-respond{padding:1.5em 1em;}}@media (max-width:544px){.ast-comment-list .children{margin-left:0.66666em;}.ast-separate-container .ast-comment-list .bypostauthor li{padding:0 0 0 .5em;}}@media (max-width:768px){.ast-mobile-header-stack .main-header-bar .ast-search-menu-icon{display:inline-block;}.ast-header-break-point.ast-header-custom-item-outside .ast-mobile-header-stack .main-header-bar .ast-search-icon{margin:0;}.ast-comment-avatar-wrap img{max-width:2.5em;}.comments-area{margin-top:1.5em;}.ast-separate-container .comments-count-wrapper{padding:2em 2.14em;}.ast-separate-container .ast-comment-list li.depth-1{padding:1.5em 2.14em;}.ast-separate-container .comment-respond{padding:2em 2.14em;}}@media (max-width:768px){.ast-header-break-point .main-header-bar .ast-search-menu-icon.slide-search .search-form{right:0;}.ast-header-break-point .ast-mobile-header-stack .main-header-bar .ast-search-menu-icon.slide-search .search-form{right:-1em;}.ast-comment-avatar-wrap{margin-right:0.5em;}}@media (min-width:545px){.ast-page-builder-template .comments-area,.single.ast-page-builder-template .entry-header,.single.ast-page-builder-template .post-navigation{max-width:1240px;margin-left:auto;margin-right:auto;}}body,.ast-separate-container{background-color:#ffffff;;background-image:none;;}@media (max-width:768px){.ast-archive-description .ast-archive-title{font-size:40px;}.entry-title{font-size:30px;}h1,.entry-content h1,.entry-content h1 a{font-size:53px;}h2,.entry-content h2,.entry-content h2 a{font-size:25px;}h3,.entry-content h3,.entry-content h3 a{font-size:22px;}h4,.entry-content h4,.entry-content h4 a{font-size:20px;font-size:1.25rem;}h5,.entry-content h5,.entry-content h5 a{font-size:16px;font-size:1rem;}h6,.entry-content h6,.entry-content h6 a{font-size:15px;font-size:0.9375rem;}.ast-single-post .entry-title,.page-title{font-size:30px;}}@media (max-width:544px){.ast-archive-description .ast-archive-title{font-size:40px;}.entry-title{font-size:30px;}h1,.entry-content h1,.entry-content h1 a{font-size:30px;}h2,.entry-content h2,.entry-content h2 a{font-size:25px;}h3,.entry-content h3,.entry-content h3 a{font-size:20px;}.ast-single-post .entry-title,.page-title{font-size:30px;}.ast-header-break-point .site-branding img,.ast-header-break-point #masthead .site-logo-img .custom-logo-link img{max-width:60px;}.astra-logo-svg{width:60px;}.ast-header-break-point .site-logo-img .custom-mobile-logo-link img{max-width:60px;}}@media (max-width:768px){html{font-size:91.2%;}}@media (max-width:544px){html{font-size:91.2%;}}@media (min-width:769px){.ast-container{max-width:1240px;}}@font-face {font-family: "Astra";src: url(https://vrotraining.com/wp-content/themes/astra/assets/fonts/astra.woff) format("woff"),url(https://vrotraining.com/wp-content/themes/astra/assets/fonts/astra.ttf) format("truetype"),url(https://vrotraining.com/wp-content/themes/astra/assets/fonts/astra.svg#astra) format("svg");font-weight: normal;font-style: normal;font-display: fallback;}@media (max-width:992px) {.main-header-bar .main-header-bar-navigation{display:none;}}.ast-desktop .main-header-menu.submenu-with-border .sub-menu,.ast-desktop .main-header-menu.submenu-with-border .astra-full-megamenu-wrapper{border-color:#2171ff;}.ast-desktop .main-header-menu.submenu-with-border .sub-menu{border-top-width:1px;border-right-width:1px;border-left-width:1px;border-bottom-width:1px;border-style:solid;}.ast-desktop .main-header-menu.submenu-with-border .sub-menu .sub-menu{top:-1px;}.ast-desktop .main-header-menu.submenu-with-border .sub-menu .menu-link,.ast-desktop .main-header-menu.submenu-with-border .children .menu-link{border-bottom-width:1px;border-style:solid;border-color:#eaeaea;}@media (min-width:769px){.main-header-menu .sub-menu .menu-item.ast-left-align-sub-menu:hover > .sub-menu,.main-header-menu .sub-menu .menu-item.ast-left-align-sub-menu.focus > .sub-menu{margin-left:-2px;}}@media (max-width:920px){.ast-404-layout-1 .ast-404-text{font-size:100px;font-size:6.25rem;}}#masthead .ast-container,.ast-header-breadcrumb .ast-container{max-width:100%;padding-left:35px;padding-right:35px;}@media (max-width:992px){#masthead .ast-container,.ast-header-breadcrumb .ast-container{padding-left:20px;padding-right:20px;}}#masthead .ast-container,.ast-header-breadcrumb .ast-container{max-width:100%;padding-left:35px;padding-right:35px;}@media (max-width:992px){#masthead .ast-container,.ast-header-breadcrumb .ast-container{padding-left:20px;padding-right:20px;}}@media (min-width:769px){.ast-theme-transparent-header #masthead{position:absolute;left:0;right:0;}.ast-theme-transparent-header .main-header-bar,.ast-theme-transparent-header.ast-header-break-point .main-header-bar{background:none;}body.elementor-editor-active.ast-theme-transparent-header #masthead,.fl-builder-edit .ast-theme-transparent-header #masthead,body.vc_editor.ast-theme-transparent-header #masthead,body.brz-ed.ast-theme-transparent-header #masthead{z-index:0;}.ast-header-break-point.ast-replace-site-logo-transparent.ast-theme-transparent-header .custom-mobile-logo-link{display:none;}.ast-header-break-point.ast-replace-site-logo-transparent.ast-theme-transparent-header .transparent-custom-logo{display:inline-block;}.ast-theme-transparent-header .ast-above-header{background-image:none;background-color:transparent;}.ast-theme-transparent-header .ast-below-header{background-image:none;background-color:transparent;}}.ast-theme-transparent-header .main-header-menu .menu-item .sub-menu .menu-link:hover,.ast-theme-transparent-header .main-header-menu .menu-item .sub-menu .menu-item:hover > .menu-link,.ast-theme-transparent-header .main-header-menu .menu-item .sub-menu .menu-item.focus > .menu-item,.ast-theme-transparent-header .main-header-menu .menu-item .sub-menu .menu-item.current-menu-item > .menu-link,.ast-theme-transparent-header .main-header-menu .menu-item .sub-menu .menu-item.current-menu-item > .ast-menu-toggle,.ast-theme-transparent-header .main-header-menu .menu-item .sub-menu .menu-item:hover > .ast-menu-toggle,.ast-theme-transparent-header .main-header-menu .menu-item .sub-menu .menu-item.focus > .ast-menu-toggle{color:#346934;}.ast-theme-transparent-header .main-header-menu,.ast-theme-transparent-header .main-header-menu .menu-link,.ast-theme-transparent-header .ast-masthead-custom-menu-items,.ast-theme-transparent-header .ast-masthead-custom-menu-items a,.ast-theme-transparent-header .main-header-menu .menu-item > .ast-menu-toggle,.ast-theme-transparent-header .main-header-menu .menu-item > .ast-menu-toggle{color:#000000;}.ast-theme-transparent-header .main-header-menu .menu-item:hover > .menu-link,.ast-theme-transparent-header .main-header-menu .menu-item:hover > .ast-menu-toggle,.ast-theme-transparent-header .main-header-menu .ast-masthead-custom-menu-items a:hover,.ast-theme-transparent-header .main-header-menu .focus > .menu-link,.ast-theme-transparent-header .main-header-menu .focus > .ast-menu-toggle,.ast-theme-transparent-header .main-header-menu .current-menu-item > .menu-link,.ast-theme-transparent-header .main-header-menu .current-menu-ancestor > .menu-link,.ast-theme-transparent-header .main-header-menu .current-menu-item > .ast-menu-toggle,.ast-theme-transparent-header .main-header-menu .current-menu-ancestor > .ast-menu-toggle{color:#346934;}@media (max-width:768px){.ast-theme-transparent-header #masthead{position:absolute;left:0;right:0;}.ast-theme-transparent-header .main-header-bar,.ast-theme-transparent-header.ast-header-break-point .main-header-bar{background:none;}body.elementor-editor-active.ast-theme-transparent-header #masthead,.fl-builder-edit .ast-theme-transparent-header #masthead,body.vc_editor.ast-theme-transparent-header #masthead,body.brz-ed.ast-theme-transparent-header #masthead{z-index:0;}.ast-header-break-point.ast-replace-site-logo-transparent.ast-theme-transparent-header .custom-mobile-logo-link{display:none;}.ast-header-break-point.ast-replace-site-logo-transparent.ast-theme-transparent-header .transparent-custom-logo{display:inline-block;}.ast-theme-transparent-header .ast-above-header{background-image:none;background-color:transparent;}.ast-theme-transparent-header .ast-below-header{background-image:none;background-color:transparent;}}.ast-theme-transparent-header .main-header-bar,.ast-theme-transparent-header.ast-header-break-point .main-header-bar{border-bottom-width:0;border-bottom-style:solid;}.ast-breadcrumbs .trail-browse,.ast-breadcrumbs .trail-items,.ast-breadcrumbs .trail-items li{display:inline-block;margin:0;padding:0;border:none;background:inherit;text-indent:0;}.ast-breadcrumbs .trail-browse{font-size:inherit;font-style:inherit;font-weight:inherit;color:inherit;}.ast-breadcrumbs .trail-items{list-style:none;}.trail-items li::after{padding:0 0.3em;content:"\00bb";}.trail-items li:last-of-type::after{display:none;}h1,.entry-content h1,h2,.entry-content h2,h3,.entry-content h3,h4,.entry-content h4,h5,.entry-content h5,h6,.entry-content h6{color:#2c2c2c;}.ast-header-break-point .main-header-bar{border-bottom-width:1px;border-bottom-color:#f01d04;}@media (min-width:769px){.main-header-bar{border-bottom-width:1px;border-bottom-color:#f01d04;}}.ast-flex{-webkit-align-content:center;-ms-flex-line-pack:center;align-content:center;-webkit-box-align:center;-webkit-align-items:center;-moz-box-align:center;-ms-flex-align:center;align-items:center;}.main-header-bar{padding:1em 0;}.ast-site-identity{padding:0;}.header-main-layout-1 .ast-flex.main-header-container, .header-main-layout-3 .ast-flex.main-header-container{-webkit-align-content:center;-ms-flex-line-pack:center;align-content:center;-webkit-box-align:center;-webkit-align-items:center;-moz-box-align:center;-ms-flex-align:center;align-items:center;}.header-main-layout-1 .ast-flex.main-header-container, .header-main-layout-3 .ast-flex.main-header-container{-webkit-align-content:center;-ms-flex-line-pack:center;align-content:center;-webkit-box-align:center;-webkit-align-items:center;-moz-box-align:center;-ms-flex-align:center;align-items:center;}

@media (max-width: 767px){
.vro-lms-sub-content {
    flex-direction: column-reverse;
}}
</style>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css' media='all' />
<link rel='stylesheet' id='vro-lms-plugin-common-style-css'  href='https://vrotraining.com/wp-content/plugins/adobe-lms/includes/css/common.css?ver=6.0.3' media='all' />
<link rel='stylesheet' id='vro-lms-plugin-page-style-css'  href='https://vrotraining.com/wp-content/plugins/adobe-lms/includes/css/course-detail.css?ver=6.0.3' media='all' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel='stylesheet' id='vro-lms-google-fonts-1-css-css'  href='https://fonts.googleapis.com/css?family=Alfa+Slab+One%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;ver=6.0.3#038;ver=5.6.8' media='all' />

</head>
<body>

<main id="main" class="site-main">

<article>
	
	 <main class="vro-lms-pg-main" style="top:100px;">
        <h1 class="vro-lms-page-entry-title">Enrollment Failed</h1>
            <div class="vro-lms-breadcrumbs">
        <a href="<?php echo site_url(); ?>">Home</a> <em class="fa fa-chevron-right"></em>
                   
                <span class="breadcrumb_last" id="breadcrumb_last">Enrollment Failed</span>
        </div>

    <div class="row vro-lms-sub-content">
    <h3>Your payment was failed.</h3>
        <p style="font-size: 20 px;">The enrollment that you initiated was failed. Email us at vrotraining@veolia.com if you have any questions or concerns. </p>

    
    <div class="elementor-button-wrapper">
        <a class="elementor-button-link elementor-button elementor-size-sm"  role="button"  href="<?php echo site_url("shopping-cart/"); ?>" rel="noopener">
        <span class="elementor-button-content-wrapper">
        <span class="elementor-button-text">Continue</span>
        </span>
        </a>
        </div>
    </div>
    </main>
</article> 
</main>   
</body>
</html>
