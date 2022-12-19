<?php

namespace App\Classes;


class Enc
{
    public function encrypt($value)
    {
        return bin2hex(openssl_encrypt($value, 'aes-256-cbc', '2aSNkJL5qJQIuYzv2I3jLRZUm8pw25Oq',OPENSSL_RAW_DATA, 'MGJMjYZOUAWoKFDx'));
    }

    public function decrypt($value_encrypted)
    {
        //verificar se a has e valida
        if(strlen($value_encrypted)%2 != 0){
            return;
        }

        return openssl_decrypt(hex2bin($value_encrypted), 'aes-256-cbc', '2aSNkJL5qJQIuYzv2I3jLRZUm8pw25Oq', OPENSSL_RAW_DATA, 'MGJMjYZOUAWoKFDx');
    }
}
