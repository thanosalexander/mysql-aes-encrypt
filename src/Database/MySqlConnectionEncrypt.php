<?php

namespace mrzainulabideen\AESEncrypt\Database;

use Illuminate\Database\MySqlConnection;

use mrzainulabideen\AESEncrypt\Database\Schema\MySqlBuilderEncrypt;
use mrzainulabideen\AESEncrypt\Database\Query\Grammars\MySqlGrammarEncrypt as QueryGrammar;

class MySqlConnectionEncrypt extends MySqlConnection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \mrzainulabideen\AESEncrypt\Database\Query\Grammars\MySqlGrammarEncrypt
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }
}
