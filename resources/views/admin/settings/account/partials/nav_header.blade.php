<ul class="nav nav-tabs">
    <li {{ set_active('admin/settings/account/credentials') }}>
        <a href="{{ url('admin/settings/account/credentials') }}">{{trans('admin.Kontodaten')}}</a>
    </li>
    @can('update', \App\Models\User\User::class)
    <li {{ set_active('admin/settings/account/address') }}>
        <a href="{{ url('admin/settings/account/address') }}">{{trans('admin.Anschrift')}}</a>
    </li>
    @endcan
    <li {{ set_active('admin/settings/account/signature') }}>
        <a href="{{ url('admin/settings/account/signature') }}">{{trans('admin.Signatur')}}</a>
    </li>
</ul>