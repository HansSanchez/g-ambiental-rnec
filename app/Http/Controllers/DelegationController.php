<?php

namespace App\Http\Controllers;

use App\Models\Delegation;
use Illuminate\Http\Request;

class DelegationController extends Controller
{
    public function getDelegations(Request $request)
    {
        return Delegation::select('id AS code', 'name AS label')
            ->search($request->search)
            ->orderBy('id', 'ASC')
            ->simplePaginate(100);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function show(Delegation $delegation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function edit(Delegation $delegation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delegation $delegation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delegation $delegation)
    {
        //
    }
}
