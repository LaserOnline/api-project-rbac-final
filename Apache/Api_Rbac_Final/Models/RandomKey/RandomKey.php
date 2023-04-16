<?php

    class RandomKey{

        public function generateKey($length) {
            $bytes = random_bytes($length);
            return bin2hex($bytes);
          }

        public function generateOtp($length) {
            return rand(pow(10, $length - 1), pow(10, $length) - 1);
        }
          
    }
   
?>