<?php
/* 加密、解密数据
 * by wdz
 *  */
namespace common\helpers;

class EncryptHelper{
    
    public static function keyED($txt,$encrypt_key){
        $encrypt_key =    md5($encrypt_key);
        $ctr=0;
        $tmp = "";
        for($i=0;$i<strlen($txt);$i++)
        {
            if ($ctr==strlen($encrypt_key))
                $ctr=0;
            $tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1);
            $ctr++;
        }
        return $tmp;
    }
    public static function encrypt($txt,$key)   {
//         $encrypt_key = md5(mt_rand(0,100));
        $encrypt_key = 88;
        $ctr=0;
        $tmp = "";
        for ($i=0;$i<strlen($txt);$i++)
        {
            if ($ctr==strlen($encrypt_key))
                $ctr=0;
            $tmp.=substr($encrypt_key,$ctr,1) . (substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1));
            $ctr++;
        }
        return self::keyED($tmp,$key);
    }
    
    public static function decrypt($txt,$key){
        $txt = self::keyED($txt,$key);
        $tmp = "";
        for($i=0;$i<strlen($txt);$i++)
        {
            $md5 = substr($txt,$i,1);
            $i++;
            $tmp.= (substr($txt,$i,1) ^ $md5);
        }
        return $tmp;
    }
    
    public static function encrypt_str($str,$key){
        return rawurlencode(base64_encode(self::encrypt($str,$key)));
    }
    
    public static function decrypt_str($str,$key){
        return self::decrypt(base64_decode(rawurldecode($str)),$key);
    }
    
    public static function geturl($str,$key){
        $str = self::decrypt_str($str,$key);
        $url_array = explode('&',$str);
        if (is_array($url_array))
        {
            foreach ($url_array as $var)
            {
                $var_array = explode("=",$var);
                if (!isset($var_array[1])){
                    return false;
                }
                $vars[$var_array[0]]=$var_array[1];
            }
        }
        return $vars;
    }
}