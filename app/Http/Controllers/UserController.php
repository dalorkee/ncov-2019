<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\User;
use DB;
use Hash;

class UserController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		//$this->middleware(['role:admin']);
		//$this->middleware(['role:admin|hospital|lab']);
		//$this->middleware('permission:manageuser|list|create|edit|delete', ['only' => ['index','store']]);
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		$data = User::orderBy('id', 'DESC')->paginate(15);
		return view('users.index', compact('data'))
				->with('i', ($request->input('page', 1) - 1) * 15);
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		echo "Comming soon";
		exit;
		$roles = Role::pluck('name', 'name')->all();
		return view('users.create', compact('roles'));
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|same:confirm-password',
			'roles' => 'required'
		]);

		$input = $request->all();

		$input['password'] = Hash::make($input['password']);
		$user = User::create($input);
		$user->assignRole($request->input('roles'));
		return redirect()->route('users.index')->with('success', 'User created successfully');
	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$user = User::find($id);
		return view('users.show', compact('user'));
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::pluck('name', 'name')->all();
		$userRole = $user->roles->pluck('name', 'name')->all();

		return view('users.edit', compact('user', 'roles', 'userRole'));
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'name' => 'required',
			'lname' => 'required',
			'password' => 'same:confirm-password',
			'email' => 'required|email|unique:users,email,'.$id,
			'roles' => 'required'
		]);

		$input = $request->all();
		if (!empty($input['password'])) {
			/* $input['password'] = Hash::make($input['password']); */
			$md5pwd = md5($input['password']);
			$input['password'] = $md5pwd;
		} else {
			$input = array_except($input, array('password'));
		}

		$user = User::find($id);
		$user->update($input);
		DB::table('model_has_roles')->where('model_id',$id)->delete();
		$user->assignRole($request->input('roles'));

		return redirect()->route('users.index')->with('success', 'User updated successfully');
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id)
	{
		User::find($id)->delete();
		return redirect()->route('users.index')->with('success', 'User deleted successfully');
	}

	public function ajaxGetHospByProv(Request $request)
	{
		$this->result = parent::hospitalByProv($request->prov_id);
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>\n";
		foreach($this->result as $key=>$value) {
				$htm .= "<option value=\"".$value->hospcode."\">".$value->hosp_name."</option>\n";
		}
		return $htm;
	}




}
