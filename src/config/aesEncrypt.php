<?php

return [
    /**
     * Configure the Aes encryption
     *
     * - key (string) - They key used to encrypt and decrypt your data
     *
     * - mode (string) - encryptiong method starts with aes-{keylen: 128,192,256}-{mode:  ECB, CBC, CFB1, CFB8, CFB128, OFB}
     *                   For example: aes-256-cbc or aes-128-ecb, we recommand using: aes-256-cbc
     *
     */
    'key' => env('APP_AESENCRYPT_KEY','YourEncryptedKey'),
    'mode' => env('APP_AESENCRYPT_MODE','aes-256-cbc'),
];
