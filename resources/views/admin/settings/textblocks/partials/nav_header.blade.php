<ul class="nav nav-tabs">
    <li {{ set_active('admin/settings/textblocks/element/*') }}><a href="{{ url('admin/settings/textblocks/element/signature') }}" aria-expanded="true">{{trans('admin.Elemente')}}</a></li>
    <li {{ set_active('admin/settings/textblocks/document/*') }}><a href="{{ url('admin/settings/textblocks/document/contract_temporary') }}" aria-expanded="true">{{trans('admin.Dokumente')}}</a></li>
</ul>