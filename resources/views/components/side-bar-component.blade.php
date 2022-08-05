<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="@if (Route::is('dashboard')) active @endif ">
                    <a href="{{ route('dashboard') }}"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
                </li>
                @can('is-universal')
                    <li class="menu-title">
                        <span>Companies Section</span>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.department-type.index') ||
                            Route::is('dashboard.departments.index') ||
                            Route::is('dashboard.companies.index')) class="subdrop" @endif>
                            <i class="la la-building"></i> <span> Companies</span> <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.department-type.index') || Route::is('dashboard.companies.index')) display:block; @endif">
                            <li @if (Route::is('dashboard.department-type.index')) class="active" @endif><a
                                    href="{{ route('dashboard.department-type.index') }}">Add
                                    Department Type(s)</a></li>
                            <li @if (Route::is('dashboard.companies.index')) class="active" @endif><a
                                    href="{{ route('dashboard.companies.index') }}">Add
                                    Companies</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">
                        <span>Designations Section</span>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.designations.index') || Route::is('dashboard.parent-designations.index')) class="subdrop" @endif>
                            <i class="la la-random"></i> <span> Designations</span> <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.designations.index') || Route::is('dashboard.parent-designations.index')) display:block; @endif">
                            <li @if (Route::is('dashboard.parent-designations.index')) class="active" @endif><a
                                    href="{{ route('dashboard.parent-designations.index') }}">Parent Designations</a></li>
                            <li @if (Route::is('dashboard.designations.index')) class="active" @endif><a
                                    href="{{ route('dashboard.designations.index') }}">Employee
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
                        <ul style="@if (Route::is('dashboard.employees.create') || Route::is('dashboard.employees.index')) display:block; @endif">
                            <li @if (Route::is('dashboard.employees.create')) class="active" @endif><a
                                    href="{{ route('dashboard.employees.create') }}">Add
                                    Employee</a></li>
                            <li @if (Route::is('dashboard.employees.index')) class="active" @endif><a
                                    href="{{ route('dashboard.employees.index') }}">View
                                    Employees</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.leave-types.index') || Route::is('dashboard.employee-leave-approvals')) class="subdrop" @endif>
                            <i class="fa fa-smile-o" aria-hidden="true"></i> <span>Employee Leaves</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.leave-types.index') || Route::is('dashboard.leave-types.index')) display:block; @endif">
                            <li @if (Route::is('dashboard.leave-types.index')) class="active" @endif><a
                                    href="{{ route('dashboard.leave-types.index') }}">Add/View
                                    Leave Types</a>
                            </li>
                            <li @if (Route::is('dashboard.employee-leave-approvals')) class="active" @endif><a
                                    href="{{ route('dashboard.employee-leave-approvals') }}">Approve/Disapprove
                                    Leave Requests</a>
                            </li>
                        </ul>
                    </li>

                    <li class="@if (Route::is('dashboard.reports.leaves-report.index')) active @endif ">
                        <a href="{{ route('dashboard.reports.leaves-report.index') }}">
                            <i class="fa fa-file" aria-hidden="true"></i>
                            <span>Leaves Report</span></a>
                    </li>

                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.employee-web-accounts.index')) class="subdrop" @endif>
                            <i class="fas fa-user-plus "></i>
                            <span> Employee Accounts</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.employee-web-accounts.index')) display:block; @endif">
                            <li @if (Route::is('dashboard.employee-web-accounts.index')) class="active" @endif>
                                <a href="{{ route('dashboard.employee-web-accounts.index') }}">Add/View</a>
                            </li>
                        </ul>
                    </li>

                    <li class="@if (Route::is('dashboard.employee-salaries-update')) active @endif ">
                        <a href="{{ route('dashboard.employee-salaries-update') }}">
                            <i class="fas fa-plus-square"></i></i><span>Salary Increments</span></a>
                    </li>

                    <li class="menu-title">
                        <span>Attendance Management</span>
                    </li>

                    <li class="@if (Route::is('dashboard.admin-attendance.management')) active @endif ">
                        <a href="{{ route('dashboard.admin-attendance.management') }}">
                            <i class="fas fa-calendar-star"></i>
                            <span>Attendance Updates</span></a>
                    </li>

                    <li class="@if (Route::is('dashboard.attendance-report.index')) active @endif ">
                        <a href="{{ route('dashboard.attendance-report.index') }}">
                            <i class="fa fa-user-times" aria-hidden="true"></i><span>Attendance Report</span></a>
                    </li>

                    <li class="@if (Route::is('dashboard.late-minutes.report')) active @endif ">
                        <a href="{{ route('dashboard.late-minutes.report') }}">
                            <i class="fas fa-paperclip"></i><span>Late Minutes Report</span></a>
                    </li>

                    <li class="@if (Route::is('dashboard.employee-attendance-approvals')) active @endif ">
                        <a href="{{ route('dashboard.employee-attendance-approvals') }}">
                            <i class="fas fa-ticket "></i><span>Attendance Tickets</span></a>
                    </li>

                    <li class="menu-title">
                        <span>Misc. Section</span>
                    </li>
                    @can('is-manager')
                        <li class="@if (Route::is('dashboard.access-restrictions')) active @endif ">
                            <a href="{{ route('dashboard.access-restrictions') }}">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                <span>Access Restrictions</span>
                            </a>
                        </li>
                    @endcan

                    <li class="@if (Route::is('dashboard.working-days')) active @endif ">
                        <a href="{{ route('dashboard.working-days') }}">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span>Additional Working Days</span>
                        </a>
                    </li>

                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.leave-types.index') || Route::is('dashboard.employee-leave-approvals')) class="subdrop" @endif>
                            <i class="fa fa-check" aria-hidden="true"></i><span>Evaluations (In progress )</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.evaluation-type')) display:block; @endif">
                            <li @if (Route::is('dashboard.evaluation-type')) class="active" @endif>
                                <a href="{{ route('dashboard.evaluation-type') }}">
                                    Add/View Evaluation Type
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.leave-types.index') || Route::is('dashboard.employee-leave-approvals')) class="subdrop" @endif>
                            <i class="fas fa-gift"></i><span>Holidays</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.holidays.index')) display:block; @endif">
                            <li @if (Route::is('dashboard.holidays.index')) class="active" @endif>
                                <a href="{{ route('dashboard.holidays.index') }}">
                                    Add/View Holidays
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.events.index')) class="subdrop" @endif>
                            <i class="fa fa-calendar"></i> <span> Events</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.events.index')) display:block; @endif">
                            <li @if (Route::is('dashboard.events.index')) class="active" @endif>
                                <a href="{{ route('dashboard.events.index') }}">
                                    View Events</a>
                            </li>
                        </ul>
                    </li>

                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.notice-board.index') || Route::is('dashboard.view-notice-board')) class="subdrop" @endif>
                            <i class="fa fa-clipboard"></i> <span> Notice Board</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.notice-board.index') || Route::is('dashboard.view-notice-board')) display:block; @endif">
                            <li @if (Route::is('dashboard.notice-board.index')) class="active" @endif>
                                <a href="{{ route('dashboard.notice-board.index') }}">
                                    Add/Delete Notices</a>
                            </li>
                            <li @if (Route::is('dashboard.view-notice-board')) class="active" @endif>
                                <a href="{{ route('dashboard.view-notice-board') }}">
                                    View Notices</a>
                            </li>
                        </ul>
                    </li>

                    <li class="@if (Route::is('dashboard.livewire.material.request')) active @endif ">
                        <a href="{{ route('dashboard.livewire.material.request') }}">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            <span>Material Request</span></a>
                    </li>
                    
                    <li class="menu-title">
                        <span>Salaries Section</span>
                    </li>
                    <li class="@if (Route::is('dashboard.reports.salary-report.index')) active @endif ">
                        <a href="{{ route('dashboard.reports.salary-report.index') }}">
                            <i class="fa fa-check" aria-hidden="true"></i><span>Salary Report</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.employee-salaries.index') || Route::is('dashboard.employee-salaries.create')) class="subdrop" @endif>
                            <i class="la la-money bx-tada"></i> <span> Employees
                                Salaries</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.employee-salaries.index') || Route::is('dashboard.employee-salaries.create')) display:block; @endif">
                            <li @if (Route::is('dashboard.employee-salaries.index')) class="active" @endif>
                                <a href="{{ route('dashboard.employee-salaries.index') }}">
                                    Set Employee Salary</a>
                            </li>
                            <li @if (Route::is('dashboard.employee-salaries.create')) class="active" @endif>
                                <a href="{{ route('dashboard.employee-salaries.create') }}">
                                    Print/Save Employee Salary</a>
                            </li>
                        </ul>
                    </li>
                    <li class="@if (Route::is('dashboard.leaves.index')) active @endif ">
                        <a href="{{ route('dashboard.leaves.index') }}"><i class="la la-leaf"></i>
                            <span>Salary Slips History</span></a>
                    </li>

                    <li class="menu-title">
                        <span>Biometric Devices Section</span>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.biometric-devices.index')) class="subdrop" @endif>
                            <i class="fa fa-fax"></i> <span> Biometric Devices</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.biometric-devices.index')) display:block; @endif">
                            <li @if (Route::is('dashboard.biometric-devices.index')) class="active" @endif>
                                <a href="{{ route('dashboard.biometric-devices.index') }}">
                                    Vew Devices</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-title">
                        <span>Email Alerts</span>
                    </li>
                    <li class="submenu">
                        <a href="#" @if (Route::is('dashboard.send-interview-letter.index')) class="subdrop" @endif>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i> <span> Send Alerts</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="@if (Route::is('dashboard.send-interview-letter.index')) display:block; @endif">
                            <li @if (Route::is('dashboard.send-interview-letter.index')) class="active" @endif>
                                <a href="{{ route('dashboard.send-interview-letter.index') }}">
                                    Interview Letter</a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('is-employee')
                    <li class="menu-title">
                        <span>Tasks</span>
                    </li>
                    <li class="#">
                        <a href="#"><i class="fa fa-clipboard" aria-hidden="true"></i>
                            <span>View Tasks</span></a>
                    </li>
                    <li class="menu-title">
                        <span>Calendar and Events</span>
                    </li>
                    <li class="@if (Route::is('dashboard.events.index')) active @endif ">
                        <a href="{{ route('dashboard.events.index') }}"><i class="fa fa-calendar-check-o"
                                aria-hidden="true"></i>
                            <span>Upcoming events</span></a>
                    </li>
                    <li class="menu-title">
                        <span>Attendance Section</span>
                    </li>
                    <li class="@if (Route::is('dashboard.employee.attendance.index')) active @endif">
                        <a href="{{ route('dashboard.employee.attendance.index') }}">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <span>View Attendance</span></a>
                    </li>
                    <li class="@if (Route::is('dashboard.employee.attendance.request')) active @endif ">
                        <a href="{{ route('dashboard.employee.attendance.request') }}">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span>Attendance Request</span></a>
                    </li>
                    <li class="menu-title">
                        <span>Salary Section</span>
                    </li>
                    <li class="@if (Route::is('dashboard.employee.salary.index')) active @endif ">
                        <a href="{{ route('dashboard.employee.salary.index') }}">
                            <i class="fa fa-money bx-tada" aria-hidden="true"></i>
                            <span>Salary Slip</span></a>
                    </li>
                    <li class="@if (Route::is('dashboard.employee.salary.report')) active @endif ">
                        <a href="{{ route('dashboard.employee.salary.report') }}">
                            <i class="fa fa-file" aria-hidden="true"></i>
                            <span>Salary Report</span></a>
                    </li>

                    <li class="menu-title">
                        <span>Leaves Management</span>
                    </li>
                    <li class="@if (Route::is('dashboard.leaves.index')) active @endif ">
                        <a href="{{ route('dashboard.leaves.index') }}"><i class="la la-leaf"></i>
                            <span>View/Apply</span></a>
                    </li>
                    <li class="menu-title">
                        <span>Misc.</span>
                    </li>
                    <li class="@if (Route::is('dashboard.view-notice-board')) active @endif ">
                        <a href="{{ route('dashboard.view-notice-board') }}">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <span>Notice Board</span></a>
                    </li>
                    <li class="@if (Route::is('dashboard.profile.index')) active @endif ">
                        <a href="{{ route('dashboard.profile.index') }}">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            <span>Profile Settings</span></a>
                    </li>
                    <li class="@if (Route::is('dashboard.livewire.material.request')) active @endif ">
                        <a href="{{ route('dashboard.livewire.material.request') }}">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            <span>Material Request</span></a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
