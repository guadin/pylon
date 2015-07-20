<?php
/**
 * Created by PhpStorm.
 * User: guadin
 * Date: 29.06.2014
 * Time: 15:47
 */

class Globalf {

    public static function p($data){

        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    public static function redirect($url, $code=null){
        if($code == null){
            header("Location: $url");
            exit;
        }else{
            header("Location: $url", $code);
            exit;
        }

    }


    public static function mc_encrypt($encrypt){
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', ENCRYPTION_KEY);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
        return $encoded;
    }

// Decrypt Function
    public static function mc_decrypt($decrypt){
        $decrypt = explode('|', $decrypt);
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
        $key = pack('H*', ENCRYPTION_KEY);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if($calcmac!==$mac){ return false; }
        $decrypted = unserialize($decrypted);
        return $decrypted;
    }
} 