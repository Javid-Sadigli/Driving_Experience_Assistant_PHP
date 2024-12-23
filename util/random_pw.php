<?php

    function random_pw($pw_length) 
    {
        $pass = '';
        $charlist = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz023456789';
        $ps_len = strlen($charlist);
    
        mt_srand((int)((microtime(true) * 1000000) % PHP_INT_MAX));
    
        for ($i = 0; $i < $pw_length; $i++) {
            $pass .= $charlist[mt_rand(0, $ps_len - 1)];
        }
    
        return $pass;
    }
    