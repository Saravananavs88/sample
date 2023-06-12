<?php
global $ISPRING_LEARN_DOMAIN;
require_once(__DIR__ . '/vendor/autoload.php');
use Firebase\JWT\JWT;
if($role == 'subscriber')
{
    //global $ispring_user_email;
    $ispring_user_email = $current_user->user_email;

    $tokenId = generateTokenId();
    $issuedAt = time();
    $expire = $issuedAt + 60;     // Add 60 seconds

    $data = [
        'iat' => $issuedAt,         // Time when the token was generated
        'jti' => $tokenId,          // A unique identifier for the token
        'exp' => $expire,           // Time to destruct token
        'email' => $ispring_user_email         // iSpring Learn user's email that you verify
    ];

    $jwt = JWT::encode(
        $data,                  // Data to be encoded in the JWT
        EXAMPLE_JWT_SECRET_KEY, // The key for encryption
        EXAMPLE_JWT_ENCODE_ALG  // Algorithm used to encode
    );
    // Redirect to iSpring Learn JWT login page
    $redirectUrl = PROTOCOL_STRING . $ISPRING_LEARN_DOMAIN . ISPRING_JWT_LOGIN_URL . $jwt;
    $_SESSION['ssoRedirectUrl'] = $redirectUrl;
    //echo("<script>window.open('".$redirectUrl."','_blank');</script>");
    //header("Location: ".$redirectUrl); 
    //exit;
}
else
{
    if(isset($_SESSION['ssoRedirectUrl']))
        unset($_SESSION['ssoRedirectUrl']);
}
//else
//{
    //$homepage = get_option('siteurl');
    //echo("<script>location.href = '".$homepage."';</script>");
    //exit;
//}
// Generates new token unique identifier.
function generateTokenId()
{
    if (defined('PHP_MAJOR_VERSION') && PHP_MAJOR_VERSION < 7)
    {
        return base64_encode(mcrypt_create_iv(32));
    }
    return base64_encode(random_bytes(32));
}
?>