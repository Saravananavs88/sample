<style>
  

    body {
        background: #f0f0f1 !important;
        min-width: 0 !important;
        color: #3c434a !important;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;
        font-size: 13px !important;
        line-height: 1.4 !important;
    }
    #veolia_header_banner_wrapper {
        display: none !important;
    }

    #veolia_footer_wrapper {
        display: none !important;
    }
    .explore {
        background-color: unset !important;
    }



    #custom-login form .input,
    #custom-login input[type=password],
    #custom-login input[type=text] {
        font-size: 24px;
        line-height: 1.33333333;
        width: 100%;
        border-width: 0.0625rem;
        padding: 0.1875rem 0.3125rem;
        margin: 0 6px 16px 0;
        min-height: 40px;
        max-height: none;
    }

    .wp-core-ui p .button {
        vertical-align: baseline;
    }

    input#user_login.input::after {
        background: #2271b1;
        border-color: #2271b1 !important;
        color: #fff;
        text-decoration: none;
        text-shadow: none;
    }

    input#user_login.input::selection,
    #custom-login input:focus {
        border-color: #2271b1 !important;
    }

    #custom-login form p {
        margin-bottom: 0;
    }

    input#resend_activation_submit.button:hover,
    input#resend_activation_submit.button::after,
    input[type="submit"] {
        background: #2271b1 !important;
        border-color: #2271b1 !important;
        color: #fff;
        text-decoration: none;
        text-shadow: none;
    }


    .wp-core-ui #nav {
        font-size: 13px;
        padding: 0 24px;
    }

    .wp-core-ui #nav a {
        text-decoration: none;
        color: #50575e;
    }

    .wp-core-ui #nav a:hover {
        text-decoration: none;
        color: #2271b1 !important;
    }

    #custom-login label {
        font-size: 14px;
        line-height: 1.5;
        display: inline-block;
        margin-bottom: 3px;
    }

    #custom-login {
        width: 320px !important;
        padding: 20px 0 !important;
        margin: auto !important;
    }

    #custom-login * {
        margin: 0;
        padding: 0;
    }

    #custom-login h1 {
        text-align: center !important;
    }

    #custom-login form.shake {
        animation: shake .2s cubic-bezier(.19, .49, .38, .79) both;
        animation-iteration-count: 3;
        transform: translateX(0);
    }

    #custom-login form {
        margin-top: 20px !important;
        margin-left: 0 !important;
        padding: 26px 24px 34px !important;
        font-weight: 400 !important;
        overflow: hidden !important;
        background: #fff !important;
        border: 1px solid #c3c4c7 !important;
        box-shadow: 0 1px 3px rgb(0 0 0 / 4%) !important;
    }

    #custom-login form p.submit {
        margin: 0;
        padding: 0;
    }

    .wp-core-ui .button-primary {
        background: #2271b1;
        border-color: #2271b1;
        color: #fff;
        text-decoration: none;
        text-shadow: none;
    }

    #custom-login .button-primary {
        float: right;
    }

    .wp-core-ui .button.button-large {
        min-height: 32px !important;
        line-height: 2.30769231 !important;
        padding: 0 12px !important;
    }

    .wp-core-ui .button,
    .wp-core-ui .button-primary,
    .wp-core-ui .button-secondary {
        display: inline-block;
        text-decoration: none;
        font-size: 13px !important;
        line-height: 2.15384615 !important;
        min-height: 30px !important;
        margin: 0 !important;
        padding: 0 10px !important;
        cursor: pointer;
        border-width: 1px;
        border-style: solid;
        font-weight: normal !important;
        -webkit-appearance: none;
        border-radius: 3px;
        white-space: nowrap;
        box-sizing: border-box;
    }

    .wp-core-ui h1 a {
        background-size: 84px;
        background-position: center top;
        background-repeat: no-repeat;
        color: #3c434a;
        height: 84px;
        font-size: 20px;
        font-weight: 400;
        line-height: 1.3;
        margin: 0 auto 25px;
        padding: 0;
        text-decoration: none;
        width: 84px;
        text-indent: -9999px;
        outline: 0;
        overflow: hidden;
        display: block;
    }

    .wp-core-ui .button:hover {
        border-color: #2271b1;
        color: #fff;
        text-decoration: none;
        text-shadow: none;
    }



    .wp-core-ui #nav {
        margin: 24px 0 0;
    }

    #custom-login #login_errors.success {
        border-left-color: #72aee6 !important;
    }

    #custom-login #login_errors {
        border-left: 4px solid #d63638;
        padding: 12px;
        margin-left: 0;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 1px 1px 0 rgb(0 0 0 / 10%);
        word-wrap: break-word;
    }

    #custom-login h1 a,
    .wp-core-ui h1 a {
        background-image: url(<?= home_url() . '/wp-content/uploads/2021/01/cropped-VeoliaLogo.png'; ?>);
        height: 45px;
        width: 320px;
        background-size: 163px 47px;
        background-repeat: no-repeat;
        padding-bottom: 10px;
        color: transparent;
    }

    .wp-core-ui h1 {
        padding-bottom: 15px !important;
    }
a.custom-login-link{
    color: #2271b1 !important;
    text-decoration: underline;
    transition-duration: .05s;
    transition-timing-function: ease-in-out;
}
</style>

<div id="custom-login" class="wp-core-ui">
    <h1><a href="<?= home_url(); ?>">Veolia</a></h1>
    <?php if (isset($_SESSION['resend_result_status']) && $_SESSION['resend_result_status'] != '') {
        $login_errors = 'login_errors';

    ?>
        <div id="<?= $login_errors; ?>">

            <?php echo $_SESSION['resend_result_status'];
            unset($_SESSION['resend_result_status']);
            ?>
        </div>
    <?php  } elseif (isset($_SESSION['resend_result_status_success']) && $_SESSION['resend_result_status_success'] != '') {
        $login_errors = 'login_errors';
        $login_success = 'success';
    ?>
        <div id="<?= $login_errors; ?>" class="<?= $login_success; ?>">

            <?php echo $_SESSION['resend_result_status_success'];
            unset($_SESSION['resend_result_status_success']);
            ?>
        </div>
    <?php
    } else {
    ?>
        <div id="#" class="">

        </div>

    <?php } ?>

    <form name="resendActivationLink" id="resendActivationLink" action="<?php echo esc_url(network_site_url('resend-activation-link?action=activatelink', 'login_post')); ?>" method="post">
        <p>
            <label for="user_login"><?php _e('Username or Email Address'); ?></label>
            <input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" size="20" autocapitalize="off" autocomplete="username" />
        </p>
        <input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect_to); ?>" />
        <p class="submit">
            <input type="submit" name="resend_activation_submit" id="resend_activation_submit" class="button button-primary button-large" value="<?php esc_attr_e('Resend activation link'); ?>" />
        </p>
    </form>
    <p id="nav">
        <a href="<?php echo home_url() . '/wp-login.php'; ?>'">Log in</a>
        | <a href="<?php echo home_url() . '/wp-login.php?action=register'; ?>">Register</a>
    </p>
</div>