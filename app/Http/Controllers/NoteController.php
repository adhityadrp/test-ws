<?php

namespace App\Http\Controllers;

use App\Events\AdminEvent;
use App\Events\KacabEvent;
use App\Events\KasirEvent;
use App\Events\RealTimeMessage;
use App\Events\UserEvent;
use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $from = User::where('id', $request->from)->first();
        $to = User::where('id', $request->to)->first();
        DB::beginTransaction();
        Note::create([
            'from' => $request->from,
            'to' => $request->to,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        if($request->to == 1){
            event(new AdminEvent($from->name, $to->name, $request->subject, $request->message));
        }
        elseif($request->to == 2){
            event(new UserEvent($from->name, $to->name, $request->subject, $request->message));
        }
        elseif($request->to == 3){
            event(new KasirEvent($from->name, $to->name, $request->subject, $request->message));
        }
        elseif($request->to == 4){
            event(new KacabEvent($from->name, $to->name, $request->subject, $request->message));
        }

        DB::commit();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNoteRequest  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
