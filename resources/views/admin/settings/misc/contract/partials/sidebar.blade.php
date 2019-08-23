<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked">
        <li {{ set_active('admin/settings/misc/collective-agreement/scope') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/scope') }}" role="tab">{{trans('admin.§1 Geltungsbereich')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/employment') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/employment') }}" role="tab">{{trans('admin.§2 Beginn und Ende des Beschäftigungsverhältnisses')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/working_hours') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/working_hours') }}" role="tab">{{trans('admin.§3 Arbeitszeit')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/surcharges') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/surcharges') }}" role="tab">{{trans('admin.§4 Zuschläge')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/time_off') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/time_off') }}" role="tab">{{trans('admin.§5 Arbeitsbefreiung')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/holiday') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/holiday') }}" role="tab">{{trans('admin.§6 Urlaub')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/charges') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/charges') }}" role="tab">{{trans('admin.§6a Urlaubsentgelt und Entgeltfortzahlung im Krankheitsfall')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/bridging_days') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/bridging_days') }}" role="tab">{{trans('admin.§7 Brückentage/Betriebsruhe')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/annual_special_payment') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/annual_special_payment') }}" role="tab">{{trans('admin.§8 Jahressonderzahlungen')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/conciliation_board') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/conciliation_board') }}" role="tab">{{trans('admin.§9 Tarifliche Schlichtungsstelle')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/limitation_period') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/limitation_period') }}" role="tab">{{trans('admin.§10 Ausschlussfrist')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/due_date_charges') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/due_date_charges') }}" role="tab">{{trans('admin.§11 Fälligkeit von Entgeltansprüchen')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/strike_clause') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/strike_clause') }}" role="tab">{{trans('admin.§12 Streikklausel')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/inception_termination') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/inception_termination') }}" role="tab">{{trans('admin.§13 Inkrafttreten und Kündigung')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/severability_clause') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/severability_clause') }}" role="tab">{{trans('admin.§14 Salvatorische Klausel')}}</a>
        </li>
        <li {{ set_active('admin/settings/misc/collective-agreement/notes') }}>
            <a href="{{ url('admin/settings/misc/collective-agreement/notes') }}" role="tab">{{trans('admin.Protokollnotizen')}}</a>
        </li>
    </ul>
</div>