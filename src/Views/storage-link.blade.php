@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.storage_link.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-link fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.storage_link.title') }}
@endsection

@section('container')

    <p class="text-center">
        {!! trans('installer_messages.storage_link.description') !!}
    </p>

    <form method="post" action="{{ route('LaravelVisualInstaller::generate-storage-link') }}">
        {!! csrf_field() !!}
        <div class="buttons">
            <button class="button button--light" type="submit">
                <i class="fa fa-link fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.storage_link.button_text') !!}
            </button>
        </div>
    </form>
    <br><br>
    @if ( session()->has('message'))
        <div class="buttons">
            <a href="{{ route('LaravelVisualInstaller::environment') }}" class="button">
                {{ trans('installer_messages.storage_link.next') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @endif
@endsection
