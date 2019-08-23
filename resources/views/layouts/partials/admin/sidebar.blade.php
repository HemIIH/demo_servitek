<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <div class="user-panel" style="height: 75px;">
            <div class="pull-left image">
                <user-photo :user="{{ auth()->user() }}"></user-photo>
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}<br>
                    <small>{{ auth()->user()->email }}</small>
                </p>
                <a href="{{ url('admin/settings/account/credentials') }}"><i class="fa fa-circle text-success"></i> {{ auth()->user()->rolename }}
                </a>
            </div>
        </div>
        <ul class="sidebar-menu">

            <li class="treeview {{ set_active(['admin/dashboard*', 'admin/calendar'] , false) }}">
                <a href="#">
                    <i class="fa fa-binoculars"></i><span>Control Panel</span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview {{ set_active('admin/dashboard*', false) }}">
                        <a href="{{ url('admin/dashboard') }}">
                            <i class="fa fa-dashboard"></i> <span>{{trans('admin.Dashboard')}}</span>
                        </a>
                    </li>

                    @if (Gate::allows('orders'))
                        <li class="treeview {{ set_active('admin/calendar', false) }}">
                            <a href="{{ url('admin/calendar') }}">
                                <i class="fa fa-calendar"></i><span>{{trans('admin.Kalenderübersicht')}}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="treeview {{ set_active(['*calendar/orders*', '*calendar/employees*', 'admin/order*', 'admin/employee*', 'admin/client*', 'admin/timetracking', 'admin/invoice*'] , false) }}">
                <a href="#">
                    <i class="fa fa-pencil"></i><span>{{trans('admin.Einsatzplanung')}}</span>
                </a>
                <ul class="treeview-menu">
                    @if (Gate::allows('orders'))

                        <li class="treeview {{ set_active('admin/calendar/orders*', false) }}">
                            <a href="{{ url('admin/calendar/orders/by/week') }}">
                                <i class="fa fa-calendar-plus-o"></i><span>{{trans('admin.Auftrags-Kalender')}}</span>
                            </a>
                        </li>

                        <li class="treeview {{ set_active('admin/calendar/employees*', false) }}">
                            <a href="{{ url('admin/calendar/employees') }}">
                                <i class="fa fa-id-card-o"></i><span>{{trans('admin.Mitarbeiter-Kalender')}}</span>
                            </a>
                        </li>
                        <li class="treeview {{ set_active('admin/order*', false) }}">
                            <a href="{{ url('admin/order') }}"><i class="fa fa-list"></i>
                                <span>{{trans('admin.Aufträge')}}</span>
                            </a>
                        </li>
                    @endif
                    <li class="treeview {{ set_active('admin/employee*', false) }}">
                        <a href="{{ url('admin/employee') }}">
                            <i class="fa fa-users"></i><span>{{trans('admin.Mitarbeiter')}}</span>
                        </a>
                    </li>
                    @if (Gate::allows('clients'))
                        <li class="treeview {{ set_active('admin/client*', false) }}">
                            <a href="{{ url('admin/client') }}">
                                <i class="fa fa-list"></i>
                                <span>{{trans('admin.Kunden')}}</span>
                            </a>
                        </li>
                    @endif

                    <li class="treeview {{ set_active('admin/timetracking*', false) }}">
                        <a href="{{ url('admin/timetracking') }}">
                            <i class="fa fa-clock-o"></i><span>{{trans('admin.Zeiterfassung')}}</span>
                        </a>
                    </li>
                    @if (Gate::allows('financials'))
                        <li class="treeview {{ set_active('admin/invoice*', false) }}">
                            <a href="{{ url('admin/invoice') }}">
                                <i class="fa fa-eur"></i><span>{{trans('admin.Rechnung')}}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>


            @if (Gate::allows('reports'))
                <li class="treeview {{ set_active(['admin/report*'] , false) }}">
                    <a href="#">
                        <i class="fa fa-book"></i><span>{{trans('admin.Auswertung')}}</span>
                    </a>
                    <ul class="treeview-menu">
                        <li {{ set_active('admin/reports/orders') }}>
                            <a href="{{ url('admin/reports/orders') }}"><i class="fa fa-bar-chart"></i> {{trans('admin.Aufträge')}}</a>
                        </li>
                        <li {{ set_active('admin/reports/employees') }}>
                            <a href="{{ url('admin/reports/employees') }}"><i class="fa fa-table"></i> {{trans('admin.Mitarbeiter')}}</a>
                        </li>
                        <li {{ set_active('admin/reports') }}>
                            <a href="{{ url('admin/reports') }}"><i class="fa fa-book"></i> {{trans('admin.Reports')}}</a>
                        </li>
                        <li {{ set_active('admin/audit') }}>
                            <a href="{{ url('admin/audit') }}"><i class="fa fa-book"></i> {{trans('admin.eBP')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li id="google_translate_element"></li>
        </ul>
    </section>
</aside>
