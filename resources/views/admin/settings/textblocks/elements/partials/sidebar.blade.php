<div class="col-md-2">
    <ul class="nav nav-pills nav-stacked">
        <li {{ set_active('admin/settings/textblocks/element/signature') }}>
            <a href="{{ url('admin/settings/textblocks/element/signature') }}" role="tab">{{trans('admin.Allgemein')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/element/operation_plan') }}>
            <a href="{{ url('admin/settings/textblocks/element/operation_plan') }}" role="tab">{{trans('admin.Einsatzplan')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/element/attendance_list') }}>
            <a href="{{ url('admin/settings/textblocks/element/attendance_list') }}" role="tab">{{trans('admin.Stundenzettel')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/element/invoice') }}>
            <a href="{{ url('admin/settings/textblocks/element/invoice') }}" role="tab">{{trans('admin.Rechnung')}}</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/element/document') }}>
            <a href="{{ url('admin/settings/textblocks/element/document') }}" role="tab">{{trans('admin.Dokumente')}}</a>
        </li>
    </ul>
</div>