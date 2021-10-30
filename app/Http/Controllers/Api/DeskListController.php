<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeskList;
use App\Http\Resources\DeskListResource;
use App\Http\Requests\DeskListRequest;
use Illuminate\Http\Response;

class DeskListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DeskListResource::collection(DeskList::with('cards')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeskListRequest $request)
    {
        $list = DeskList::create($request->validated());
        return new DeskListResource($list);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = DeskList::find($id);
        if ($list) {
            return new DeskListResource($list);
        }
        return response('No exists!', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeskListRequest $request, DeskList $list)
    {
        $list->update($request->validated());
        return new DeskListResource($list);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeskList $list)
    {
        $list->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
