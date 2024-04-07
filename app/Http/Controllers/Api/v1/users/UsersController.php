<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1\users;

use App\Core\Repositories\Users\Find;
use App\Core\Repositories\Users\Where;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Users\ListUsersGetRequest;
use App\Services\Redis\User\FindUser;
use App\Services\Redis\User\GetFindUser;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;
use Monad\FTry;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListUsersGetRequest $request)
    {
        $listUsers = FTry::with(((new Where(\collect($request->validated())))->call()));
        if (!$listUsers->isSuccess()) $listUsers->pass();

        return $this->response($listUsers->value());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function me(Request $request)
    {
        $tes = FTry::with((new GetFindUser(auth()->user()->id))->call());
        if (!$tes->isSuccess()) $tes->pass();

        return $this->response($tes->value());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
