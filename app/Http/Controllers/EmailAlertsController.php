<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailAlerts\StoreInterviewLetterRequest;
use App\Services\JsonResponseService;
use App\Services\MailService;
use Exception;
use Illuminate\Http\Request;

class EmailAlertsController extends Controller
{
    public function sendInterviewLetterEmailIndex()
    {
        return view('pages.email-alerts.interview-letter');
    }
    public function sendInterviewLetterEmail(StoreInterviewLetterRequest $request)
    {
        try {
            MailService::sendInterviewEmail($request->validated()) ;
                return JsonResponseService::getJsonSuccess('The user was notified on his email address. ✅');
            
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }
}
