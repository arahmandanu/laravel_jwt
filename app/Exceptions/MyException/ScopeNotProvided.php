<?php

declare(strict_types=1);

namespace App\Exceptions\MyException;

use Exception;
use Illuminate\Support\Arr;

class ScopeNotProvided extends Exception
{
    protected $scopes;

    public function __construct($scopes = [], $message = 'Invalid scope(s) provided.')
    {
        parent::__construct($message);
        $this->scopes = Arr::wrap($scopes);
    }

    /**
     * Get the scopes that the user did not have.
     *
     * @return array
     */
    public function scopes()
    {
        return $this->scopes;
    }
}
