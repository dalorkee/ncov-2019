<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Session;
use App\User;
use App\Invest;

class HomeController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
		$this->middleware(['role:root|ddc|dpc|pho|hos']);
	}

	public function index() {
		$roleArr = auth()->user()->getRoleNames()->toArray();
		if (count($roleArr) > 0) {
			$user_role = $roleArr[0];
			Session::put('user_role', $roleArr[0]);
			$user = auth()->user();
			switch ($user_role) {
				case "root":
					$user->syncPermissions([
						'permission-edit',
						'permission-delete',
						'permission-create',
						'role-create',
						'role-edit',
						'role-delete',
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('main');
					break;
				case "ddc":
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('main');
					break;
				case "dpc":
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('main');
					break;
				case "pho":
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('main');
					break;
				case "hos":
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('main');
					break;
				case "lab":
					return abort(404);
					break;
				default:
					return redirect()->route('logout');
					break;
			}
		} else {
			return redirect()->route('logout');
		}
	}

	public function mainPage() {
		/* main dshb */
		$total = Invest::whereNull('deleted_at')->count();
		$today = Invest::whereRaw('DATE(created_at) = CURDATE()')->whereNull('deleted_at')->count();
		$confirmed = Invest::where('pt_status', 2)->whereNull('deleted_at')->count();
		$excluded = Invest::whereIn('pt_status', [4, 5])->whereNull('deleted_at')->count();
		$pui = Invest::whereIn('pt_status', [1, 3])->whereNull('deleted_at')->count();
		$confirmed_pc = ($confirmed/$total)*100;
		$excluded_pc = ($excluded/$total)*100;
		$pui_pc = ($pui/$total)*100;
		$data['total'] = $total;
		$data['today'] = $today;
		$data['confirmed'] = $confirmed;
		$data['confirmed_pc'] = $confirmed_pc;
		$data['excluded'] = $excluded;
		$data['excluded_pc'] = $excluded_pc;
		$data['pui'] = $pui;
		$data['pui_pc'] = $pui_pc;

		/* second dshb */
		$recovered = Invest::where('disch_st', 1)->whereNull('deleted_at')->count();
		$admitted = Invest::where('disch_st', 2)->whereNull('deleted_at')->count();
		$death = Invest::where('disch_st', 3)->whereNull('deleted_at')->count();
		$sq = Invest::where('disch_st', 4)->whereNull('deleted_at')->count();
		$second_total = ($recovered+$admitted+$death+$sq);

		$recovered_pc = ($recovered/$second_total)*100;
		$admitted_pc = ($admitted/$second_total)*100;
		$death_pc = ($death/$second_total)*100;
		$sq_pc = ($sq/$second_total)*100;
		$data['recovered'] = $recovered;
		$data['admitted'] = $admitted;
		$data['death'] = $death;
		$data['sq'] = $sq;
		$data['recovered_pc'] = $recovered_pc;
		$data['admitted_pc'] = $admitted_pc;
		$data['death_pc'] = $death_pc;
		$data['sq_pc'] = $sq_pc;
		return view('home', compact('data'));
	}
}
