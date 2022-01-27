<?php

namespace App\Services;

use App\Models\EmployeeLeaves;
use App\Models\LeaveType;
use App\Models\User;
use App\Notifications\EmployeeAccountNotification;
use App\Notifications\NewRequestNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;

class MailService
{
    public static function sendEmailWithCredentials($email, $password, $userCreated)
    {
        $user['heading-email'] = 'Thank you ' . $email . ' is now registered.';
        $user['description1'] = "Password : " . $password;
        $user['description2'] = 'Note do not share this password with any one.';
        $db['heading'] = 'New account notification.';
        $db['avatar'] = Request::root() . '/assets/img/new-user.png';
        $db['email'] = auth()->user()->email;
        $db['details'] = 'Note : You were just registered as an employee at ' . config('app.name', env('APP_NAME')) . ' with email : ' . $email . ' by the admin.';
        $db['redirect'] = route('dashboard.employee-web-accounts.index');
        Notification::send($userCreated, new EmployeeAccountNotification($user, $db));
    }

    public static function sendEmailToAdmin($email, $password)
    {
        $user['heading-email'] = 'Thank you ' . $email . ' is now registered.';
        $user['description1'] = "Password : " . $password;
        $user['description2'] = 'Note you have created this employee with your accout email : ' . auth()->user()->email;
        $db['heading'] = 'New employee added with your account email.';
        $db['avatar'] = Request::root() . '/assets/img/new-user.png';
        $db['redirect'] = route('dashboard.employee-web-accounts.index');
        $db['email'] = $email;
        $db['details'] = 'Note : The employee : ' . $email . ' now has access to the system and can see all the privileged modules.';
        Notification::send(auth()->user(), new EmployeeAccountNotification($user, $db));
    }

    public static function sendLeaveEmailToEmployee($leaves, $leaveTypeId, $description)
    {
        $name = LeaveType::where('id', $leaveTypeId)->value('name');
        $user['heading-email'] = 'Leave request submitted.';
        $user['description1'] = $description . ' Leaves Applied : ' . $leaves . ' Leave Type : ' . $name;
        $user['description2'] = 'Note you have submitted a request with email : ' . auth()->user()->email . ' Please wait for admin response.';
        $db['heading'] = 'New Leave request submitted.';
        $db['avatar'] = Request::root() . '/assets/img/new-leave-request.png';
        $db['redirect'] = route('dashboard.leaves.index');
        $db['email'] = auth()->user()->email;
        $db['details'] = 'Note : You have submitted a leave request.';
        Notification::send(auth()->user(), new NewRequestNotification($user, $db));
    }

    public static function sendLeaveEmailToAdmin($leaves, $leaveTypeId, $description)
    {
        $name = LeaveType::where('id', $leaveTypeId)->value('name');
        $user['heading-email'] = 'Leave request submitted.';
        $user['description1'] = 'Description : ' . $description . ' Leaves Applied : ' . $leaves . ' Leave Type : ' . $name;
        $user['description2'] = 'You have received a leave request from : ' . auth()->user()->email . ' Please visit your dashboard for approval.';
        $db['heading'] = 'New Leave request received.';
        $db['avatar'] = Request::root() . '/assets/img/new-leave-request.png';
        $db['redirect'] = route('dashboard.employee-leave-approvals');
        $db['email'] = auth()->user()->email;
        $db['details'] = 'Note : You have received a leave request.';
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::send($admin, new NewRequestNotification($user, $db));
        }
    }

    public static function sendLeaveStatusEmailToEmployee($leave_id, $status, $remarks)
    {
        $leave = EmployeeLeaves::where('id', $leave_id)->first();
        $user['heading-email'] = 'Leave request status email.';
        $user['description1'] = 'Status : ' . $status . ' Leave remarks : ' . $remarks;
        $user['description2'] = 'Your leave request is updated by : ' . auth()->user()->email;
        $db['heading'] = 'New Leave request status.';
        $db['avatar'] = Request::root() . '/assets/img/new-leave-request.png';
        $db['redirect'] = route('dashboard.leaves.index');
        $db['email'] = auth()->user()->email;
        $db['details'] = 'Note : Leave status update request.';
        Notification::send($leave->owner, new NewRequestNotification($user, $db));
    }

    public static function sendLeaveStatusEmailToAdmin($leave_id, $status, $remarks)
    {
        // $leave = EmployeeLeaves::where('id', $leave_id)->first();
        $user['heading-email'] = 'Leave request status updated.';
        $user['description1'] = 'Status : ' . $status . ' Leave remarks : ' . $remarks;
        $user['description2'] = 'You have updated the leave status with email : ' . auth()->user()->email;
        $db['heading'] = 'New Leave request status.';
        $db['avatar'] = Request::root() . '/assets/img/new-leave-request.png';
        $db['redirect'] = route('dashboard.employee-leave-approvals');
        $db['email'] = auth()->user()->email;
        $db['details'] = 'Note : You have received a leave request.';
        Notification::send(auth()->user(), new NewRequestNotification($user, $db));
    }

    public static function sendNoticeEmail($details, $priority)
    {
        $user['heading-email'] = 'Notice Board is updated with a new notice.';
        $user['description1'] = 'Notice Details : ' . $details;
        $user['description2'] = 'Notice priority : ' . $priority;
        $db['heading'] = 'New Notice board notification.';
        $db['avatar'] = Request::root() . '/assets/img/notice.png';
        $db['redirect'] = route('dashboard.view-notice-board');
        $db['email'] = auth()->user()->email;
        $db['details'] = 'Note : You have received a notice board notification.';
        $users = User::all();
        foreach ($users as $item) {
            Notification::send($item, new NewRequestNotification($user, $db));
        }
    }

    public static function sendZkError($details, $ip)
    {
        $user['heading-email'] = 'Biometric device has faced an error.';
        $user['description1'] = 'IP : ' . $ip;
        $user['description2'] = 'Details : ' . $details;
        $db['heading'] = 'Biometric device error.';
        $db['avatar'] = Request::root() . '/assets/img/notice.png';
        $db['redirect'] = route('dashboard.biometric-devices.index');
        $db['email'] = '';
        $db['details'] = 'Note : Biometric device ' . $ip . ' ran into an error.';
        $users = User::where('role', 'admin')->get();
        foreach ($users as $item) {
            Notification::send($item, new NewRequestNotification($user, $db));
        }
    }
}
