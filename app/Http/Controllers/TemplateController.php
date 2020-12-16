<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemplateStore;
use App\Http\Requests\TemplateUpdate;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $templates = Template::all();

        $templateId = session('template_id', 0);

        return response([
            'templates' => $templates,
            'template' => $templateId
                ? $templates->where('id', $templateId)->first()
                : null
        ]);
    }

    public function getIndex() : Response
    {
        return $this->index();
    }

    /**
     * Get template items
     *
     * @param Request $request
     * @return Response
     */
    public function items(Request $request) : Response
    {
        session([
            'template_id' => $request->get('template_id')
        ]);

        return response(Template::find($request->get('template_id'))->items);
    }

    public function updateItems(Request $request) : Response
    {
        $template = Template::find($request->get('template_id'));

        $items = $request->get('items');

        $syncData = [];
        foreach($items as $key => $item) {
            $syncData[$item['id']] = [
                'sorting' => $key
            ];
        }

        $template->items()->sync($syncData);

        return response($template->items);
    }

    /**
     * Get template items
     *
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request): Response
    {
        Template::destroy($request->get('template_id'));

        return response(Template::all());
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
     * @param TemplateStore $request
     * @return Response
     */
    public function store(TemplateStore $request): Response
    {
        if ($request->has('id')) {

            $template = Template::find($request->get('id'));
            $template->name = $request->get('name');
            $template->save();

            return response($template);
        }

        return response(Template::create([
            'name' => $request->get('name')
        ]));
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
     * @param TemplateUpdate $request
     * @param int $id
     * @return Response
     */
    public function update(TemplateUpdate $request, int $id): Response
    {
        $template = Template::find($id);
        $template->name = $request->get('name');
        $template->save();

        return response($template);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        return response(Template::destroy($id));
    }
}
