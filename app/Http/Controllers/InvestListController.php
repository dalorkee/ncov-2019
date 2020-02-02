<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvestList;
use Illuminate\Support\Facades\Auth;

class InvestListController extends MasterController
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		//dd(Auth::user());
		$status = parent::getStatus();
		$invest = InvestList::whereNotNull('sat_id')->get()->toArray();

		return view('invest-list.index',
				[
					'status' => $status,
					'invest' => $invest
				]
		);
	}

	public function updateStatus(Request $request) {

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
	* @param  \App\InvestList  $investList
	* @return \Illuminate\Http\Response
	*/
	public function show(InvestList $investList)
	{
		//
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\InvestList  $investList
	* @return \Illuminate\Http\Response
	*/
	public function edit(InvestList $investList)
	{
		//
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\InvestList  $investList
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, InvestList $investList)
	{
		//
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\InvestList  $investList
	* @return \Illuminate\Http\Response
	*/
	public function destroy(InvestList $investList)
	{
		//
	}
}
