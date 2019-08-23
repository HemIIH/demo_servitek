@extends('layouts.admin')

@section('content')
    <div>
        <div class="nav-tabs-custom">
            @include('admin.settings.textblocks.partials.nav_header')
            <div class="tab-content">

                <div class="tab-pane active">
                    <div class="row">

                        @include('admin.settings.textblocks.documents.partials.sidebar')

                        <document-template :data="{{ $template }}"></document-template>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection