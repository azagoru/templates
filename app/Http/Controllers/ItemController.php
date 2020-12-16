<?php

namespace App\Http\Controllers;

use App\Item;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->has('template_id')) {
            $templateItems = Template::find($request->get('template_id'))->items;
            if ($templateItems->count()) {
                $templateItemsIds = $templateItems->pluck('id')->toArray();

                $items = Item::whereNotIn('id', $templateItemsIds)->get();
            } else {
                $items = Item::all();
            }
        } else {
            $items = Item::all();
        }

        return response($items);
    }

    public function getIndex(Request $request) : Response
    {
        return $this->index($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
