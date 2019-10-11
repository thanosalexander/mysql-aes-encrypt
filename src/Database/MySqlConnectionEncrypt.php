<?php

namespace redsd\AESEncrypt\Database;

use Illuminate\Database\MySqlConnection;

use redsd\AESEncrypt\Database\Schema\MySqlBuilderEncrypt;
use redsd\AESEncrypt\Database\Query\Grammars\MySqlGrammarEncrypt as QueryGrammar;

class MySqlConnectionEncrypt extends MySqlConnection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \redsd\AESEncrypt\Database\Query\Grammars\MySqlGrammarEncrypt
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }
}
