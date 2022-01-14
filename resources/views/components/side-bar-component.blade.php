<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                @can('is-admin')
                    <li class="menu-title">
                        <span>Main</span>
                    </li>
                    <li class="@if (Route::is('dashboard')) active @endif ">
                        <a href="{{ route('dashboard') }}"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
                    </li>

                    <li class="menu-title">
                        <span>Companies Section</span>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.department-type.index') || Route::is('dashboard.departments.index') || Route::is('dashboard.companies.index')) class="subdrop" @endif>
                            <i class="la la-building"></i> <span> Companies</span> <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.department-type.index') || Route::is('dashboard.companies.index')) display:block;@endif">
                            <li @if (Route::is('dashboard.department-type.index')) class="active" @endif><a href="{{ route('dashboard.department-type.index') }}">Add
                                    Department Type(s)</a></li>
                            <li @if (Route::is('dashboard.companies.index')) class="active" @endif><a href="{{ route('dashboard.companies.index') }}">Add
                                    Companies</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">
                        <span>Designations Section</span>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.designations.index') || Route::is('dashboard.parent-designations.index')) class="subdrop" @endif>
                            <i class="la la-random"></i> <span> Designations</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.designations.index') || Route::is('dashboard.parent-designations.index')) display:block;@endif">
                            <li @if (Route::is('dashboard.parent-designations.index')) class="active" @endif><a
                                    href="{{ route('dashboard.parent-designations.index') }}">Parent Designations</a></li>
                            <li @if (Route::is('dashboard.designations.index')) class="active" @endif><a href="{{ route('dashboard.designations.index') }}">Employee
                                    Designations</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">
                        <span>Employees Section</span>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.employees.create') || Route::is('dashboard.employees.index')) class="subdrop" @endif>
                            <i class="la la-user bx-tada"></i> <span> Employees</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.employees.create') || Route::is('dashboard.employees.index')) display:block;@endif">
                            <li @if (Route::is('dashboard.employees.create')) class="active" @endif><a href="{{ route('dashboard.employees.create') }}">Add
                                    Employee</a></li>
                            <li @if (Route::is('dashboard.employees.index')) class="active" @endif><a href="{{ route('dashboard.employees.index') }}">View
                                    Employees</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">
                        <span>Admin Section</span>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.leave-types.index') || Route::is('dashboard.leave-types.index')) class="subdrop" @endif>
                            <i class="fa fa-smile-o" aria-hidden="true"></i> <span> Leave Types</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.leave-types.index') || Route::is('dashboard.leave-types.index')) display:block;@endif">
                            <li @if (Route::is('dashboard.leave-types.index')) class="active" @endif><a href="{{ route('dashboard.leave-types.index') }}">Add/View
                                    Leave Types</a>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.employee-web-accounts.index')) class="subdrop" @endif>
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i><span> Employee Accounts</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.employee-web-accounts.index')) display:block;@endif">
                            <li @if (Route::is('dashboard.employee-web-accounts.index')) class="active" @endif>
                                <a href="{{ route('dashboard.employee-web-accounts.index') }}">Add/View</a>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.events.index')) class="subdrop" @endif>
                            <i class="fa fa-calendar"></i> <span> Events</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.events.index')) display:block;@endif">
                            <li @if (Route::is('dashboard.events.index')) class="active" @endif>
                                <a href="{{ route('dashboard.events.index') }}">
                                    View Events</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-title">
                        <span>Salaries Section</span>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.employee-salaries.index') || Route::is('dashboard.employee-salaries.create')) class="subdrop" @endif>
                            <i class="la la-money bx-tada"></i> <span> Employees
                                Salaries</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.employee-salaries.index') || Route::is('dashboard.employee-salaries.create')) display:block;@endif">
                            <li @if (Route::is('dashboard.employee-salaries.index')) class="active" @endif>
                                <a href="{{ route('dashboard.employee-salaries.index') }}">
                                    Set Employee Salary</a>
                            </li>
                            <li @if (Route::is('dashboard.employee-salaries.create')) class="active" @endif>
                                <a href="{{ route('dashboard.employee-salaries.create') }}">
                                    View/Print Employee Salary</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-title">
                        <span>Biometric Devices Section</span>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.biometric-devices.index')) class="subdrop" @endif>
                            <i class="fa fa-fax"></i> <span> Biometric Devices</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.biometric-devices.index')) display:block;@endif">
                            <li @if (Route::is('dashboard.biometric-devices.index')) class="active" @endif>
                                <a href="{{ route('dashboard.biometric-devices.index') }}">
                                    Vew Devices</a>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
