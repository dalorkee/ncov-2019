<?php

namespace App\Http\Controllers;

use App\Invest;
use App\GlobalCountry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvestController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function index()
	{
		//
	}

	public function create()
	{
		return view('form.invest.index',
			['i']
		);
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
     * @param  \App\Invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function show(Invest $invest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function edit(Invest $invest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invest $invest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invest $invest)
    {
        //
    }
}
