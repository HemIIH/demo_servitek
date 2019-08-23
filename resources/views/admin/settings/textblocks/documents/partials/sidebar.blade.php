<div class="col-md-2">
    <ul class="nav nav-pills nav-stacked">
        <li {{ set_active('admin/settings/textblocks/document/contract_parttime') }}>
            <a href="{{ url('admin/settings/textblocks/document/contract_parttime') }}" role="tab">{{trans('admin.Vertrag - Teilzeit')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/contract_temporary') }}>
            <a href="{{ url('admin/settings/textblocks/document/contract_temporary') }}" role="tab">{{trans('admin.Vertrag - Geringfügigi')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/warning') }}>
            <a href="{{ url('admin/settings/textblocks/document/warning') }}" role="tab">{{trans('admin.Abmahnung')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/reminder') }}>
            <a href="{{ url('admin/settings/textblocks/document/reminder') }}" role="tab">{{trans('admin.Erinnerung')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/termination') }}>
            <a href="{{ url('admin/settings/textblocks/document/termination') }}" role="tab">{{trans('admin.Kündigung')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/termination_without_notice') }}>
            <a href="{{ url('admin/settings/textblocks/document/termination_without_notice') }}" role="tab">{{trans('admin.Kündigung - Fristlos')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/termination_within_probation') }}>
            <a href="{{ url('admin/settings/textblocks/document/termination_within_probation') }}" role="tab">{{trans('admin.Kündigung - Probezeit')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/withdrawal_receipt') }}>
            <a href="{{ url('admin/settings/textblocks/document/withdrawal_receipt') }}" role="tab">{{trans('admin.Kündigungsbestätigung')}}</a>
        </li>
    </ul>
</div>