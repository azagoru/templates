<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
        <link href="{{ mix('css/modal.css') }}" rel="stylesheet">
        <link href="{{ mix('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div id="app">
            <templates-component
                v-bind:get_items_endpoint="'{{ route('items.index') }}'"
                v-bind:get_templates_endpoint="'{{ route('templates.index') }}'"
                v-bind:get_template_items_endpoint="'{{ route('templates.items') }}'"
                v-bind:update_template_items_endpoint="'{{ route('templates.items.update') }}'"
                v-bind:store_template_endpoint="'{{ route('templates.store') }}'"
                v-bind:delete_template_endpoint="'{{ route('templates.delete') }}'"
            ></templates-component>
        </div>

        <script src="{{ mix('js/app.js') }}" ></script>
    </body>
</html>
