<?php

namespace App\Services;

use App\Models\LeaveType;
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

    public static function sendGeneralEmail($leaves, $leaveTypeId, $description)
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
}