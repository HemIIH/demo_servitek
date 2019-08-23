<ul class="nav nav-tabs">
    <li {{ set_active('admin/settings/misc/salaries*') }}><a href="{{ url('admin/settings/misc/salaries/scope') }}">{{trans('admin.Entgelttarifvertrag - iGZ')}}</a></li>
    <li {{ set_active('admin/settings/misc/collective-agreement*') }}><a href="{{ url('admin/settings/misc/collective-agreement/scope') }}">{{trans('admin.Mantelvertrag')}}</a></li>
</ul>