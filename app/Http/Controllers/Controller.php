<?php

namespace App\Http\Controllers;

use App\Traits\Queries\PaginationHelper;
use App\Traits\Response\Handler;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Handler, PaginationHelper;
}
