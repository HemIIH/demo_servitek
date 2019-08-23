<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu">
            <li class="header"></li>
            <li class="treeview {{ set_active('e/dashboard*', false) }}">
                <a href="{{ url('/e/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>{{trans('employee.Dashboard')}}</span>
                </a>
            </li>
            <li class="treeview {{ set_active('e/calendar', false) }}">
                <a href="{{ '/e/calendar' }}">
                    <i class="fa fa-calendar"></i> <span>{{trans('employee.Kalender')}}</span>
                </a>
            </li>
            <li class="treeview {{ set_active('e/profile*', false) }}">
                <a href="{{ '/e/profile' }}">
                    <i class="fa fa-user"></i> <span>{{trans('employee.Profil')}}</span>
                </a>
            </li>
            <li class="treeview {{ set_active('e/history*', false) }}">
                <a href="{{ '/e/history' }}">
                    <i class="fa fa-edit"></i> <span>{{trans('employee.Historie')}}</span>
                </a>
            </li>
            <li id="google_translate_element"></li>
        </ul>
    </section>
</aside>
