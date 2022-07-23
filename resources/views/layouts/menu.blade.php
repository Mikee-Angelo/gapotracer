<li class="nav-item {{ Request::is('civilians*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('home') }}">
        <i class="nav-icon icon-home"></i>
        <span >Home</span>
    </a>
</li>

<li class="nav-item {{ Request::is('civilians*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('maps') }}">
        <i class="nav-icon icon-map"></i>
        <span >Maps</span>
    </a>
</li>

<li class="nav-item {{ Request::is('civilians*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('civilians.index') }}">
        <i class="nav-icon icon-people"></i>
        <span >Civilians</span>
    </a>
</li>
<li class="nav-item {{ Request::is('establishments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('establishments.index') }}">
        <i class="nav-icon fa fa-building"></i>
        <span >Establishments</span>
    </a>
</li>
<li class="nav-item {{ Request::is('vehicles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('vehicles.index') }}">
        <i class="nav-icon fa fa-car"></i>
        <span >Transportations</span>
    </a>
</li>



<li class="nav-item pl-3">
    <hr>
    <h5>Logs</h5>
</li>
<li class="nav-item {{ Request::is('logsCivilians*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('logsCivilians.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span >Civilians</span>
    </a>
</li>
<li class="nav-item {{ Request::is('logsEstablishments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('logsEstablishments.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span >Establishments</span>
    </a>
</li>
<li class="nav-item {{ Request::is('logsVehicles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('logsVehicles.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span >Transportations</span>
    </a>
</li>

<li class="nav-item pl-3">
    <hr>
    <h5>Settings</h5>
</li>
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('users.index') !!}">
        <i class="nav-icon fa fa-users"></i>
        <span >Manage Users</span>
    </a>
</li>

<li class="nav-item {{ Request::is('records*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('records.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Records</span>
    </a>
</li>
