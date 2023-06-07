<?php

namespace ConfrariaWeb\User\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct($message = "Usuário não encontrado", $code = 404, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
