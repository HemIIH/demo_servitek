<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked">
        <li {{ set_active('admin/settings/misc/salaries/scope') }}>
            <a href="{{ url('admin/settings/misc/salaries/scope') }}" role="tab">{{trans('admin.§1 Geltungsbereich')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/salaries/pay') }}>
            <a href="{{ url('admin/settings/misc/salaries/pay') }}" role="tab">{{trans('admin.§2 Entgelte')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/salaries/special_regulation') }}>
            <a href="{{ url('admin/settings/misc/salaries/special_regulation') }}" role="tab">{{trans('admin.§3 Sonderregelung')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/salaries/betterment_agreement') }}>
            <a href="{{ url('admin/settings/misc/salaries/betterment_agreement') }}" role="tab">{{trans('admin.§4 Besserstellungsvereinbarung')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/salaries/inception_termination') }}>
            <a href="{{ url('admin/settings/misc/salaries/inception_termination') }}" role="tab">{{trans('admin.§5 Inkrafttreten und Kündigung')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/salaries/severability_clause') }}>
            <a href="{{ url('admin/settings/misc/salaries/severability_clause') }}" role="tab">{{trans('admin.§6 Salvatorische Klausel')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/salaries/notes') }}>
            <a href="{{ url('admin/settings/misc/salaries/notes') }}" role="tab">{{trans('admin.Protokollnotizen')}}</a>
        </li>
    </ul>
</div>