<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu">
            <li class="header"></li>
            <li class="treeview {{ set_active('c/dashboard*', false) }}">
                <a href="{{ url('/c/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview {{ set_active('c/calendar', false) }}">
                <a href="{{ '/c/calendar' }}">
                    <i class="fa fa-calendar"></i> <span>Kalender</span>
                </a>
            </li>
            <li class="treeview {{ set_active('c/profile*', false) }}">
                <a href="{{ '/c/profile' }}">
                    <i class="fa fa-user"></i> <span>Profil</span>
                </a>
            </li>
            <li class="treeview {{ set_active('c/history*', false) }}">
                <a href="{{ '/c/history' }}">
                    <i class="fa fa-edit"></i> <span>Historie</span>
                </a>
            </li>
            <li class="treeview {{ set_active('c/invoices*', false) }}">
                <a href="{{ '/c/invoices' }}">
                    <i class="fa fa-money"></i> <span>Rechnungen</span>
                </a>
            </li>
            <li class="treeview {{ set_active('c/settings*', false) }}">
                <a href="{{ '/c/settings' }}">
                    <i class="fa fa-cog"></i> <span>Einstellungen</span>
                </a>
            </li>
            <li id="google_translate_element"></li>
        </ul>
    </section>
</aside>
