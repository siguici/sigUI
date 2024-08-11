<!DOCTYPE html>
<html id="{{ $rootId }}" lang="{{ str_replace('_', '-', $locale ?? app()->getLocale()) }}">
    <head @isset($head) {{ $head->attributes }} @endisset>
    @section('head')
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no"/>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>{{ config('app.title') ?: config('app.name', 'Sikessem') }} @isset($title) $title @else @hasSection('title') | @yield('title') @endif @endisset</title>
        @isset($head)
            {{ $head }}
        @endisset
        @livewireStyles
    @show
    </head>
    <body @if($body && $body->isNotEmpty()) {{ $body->attributes->merge(['id' => $bodyId]) }} @else {{ $attributes->merge(['id' => $bodyId]) }} @endif>
    @section('body')
        @if($body && $body->isNotEmpty())
            {{ $body }}
        @else
            {{ $slot }}
        @endisset
        @livewireScripts
    @show
    </body>
</html>
