<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Provinces;
use App\Traits\BoundaryTrait;

class AdminController extends Controller
{
	use BoundaryTrait;

	public function createHospToJsonFrm(): object {
		$provinces = Provinces::select('province_id', 'province_name')->orderBy('province_name')->get();
		return view('admin.createHospToJsonFrm', ['provinces' => $provinces]);
	}

	public function createHospToJson(Request $request): string {
		try {
			if (self::queryHospToJsonByProv($request->province_id)) {
				return redirect()->back()->with('success', 'สร้าง JSON File สำเร็จแล้ว');
			} else {
				return redirect()->back()->with('error', 'ไม่สามารถสร้าง JSON File ได้ โปรดตรวจสอบ');
			}
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}
}
