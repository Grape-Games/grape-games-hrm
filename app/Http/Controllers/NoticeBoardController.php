<?php

namespace App\Http\Controllers;

use App\Models\NoticeBoard;
use App\Http\Requests\StoreNoticeBoardRequest;
use App\Http\Requests\UpdateNoticeBoardRequest;
use App\Services\JsonResponseService;
use App\Services\MailService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NoticeBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = NoticeBoard::with('owner')->get();
            return DataTables::of($data)->make(true);
        }
        return view('pages.notice-board.index');
    }

    public function viewBoard()
    {
        return view('pages.notice-board.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNoticeBoardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticeBoardRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                NoticeBoard::create($request->validated());
                MailService::sendNoticeEmail($request->details, $request->priority);
            });
            return JsonResponseService::getJsonSuccess('Notice was added successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function show(NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function edit(NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNoticeBoardRequest  $request
     * @param  \App\Models\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoticeBoardRequest $request, NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function destroy(NoticeBoard $noticeBoard)
    {
        if ($noticeBoard->delete())
            return JsonResponseService::getJsonSuccess('Notice was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete notice.');
    }
}
