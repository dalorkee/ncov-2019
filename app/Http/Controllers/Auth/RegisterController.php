<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class RegisterController extends Controller
{
	use RegistersUsers;

	public function __construct() {
		$this->middleware('guest');
		$titleName = $this->titleName();
		$this->title_name = $titleName->keyBy('id');
		$this->result = null;
	}

	public function titleName() {
		return DB::connection('mysql')->table('ref_title_name')->get();
	}

	public function provinces() {
		return DB::connection('mysql')
			->table('ref_province')
			->orderBy('province_name', 'asc')
			->get();
	}

	protected function index(Request $request) {
		$provinces = self::provinces();
		$roles = Role::pluck('name', 'id')->all();
		return view('auth.register', compact('roles'))
				->with('titleName', $this->title_name)
				->with('provinces', $provinces);
	}

	public function validator(array $data) {
		/* use for user model */
		/*
		return Validator::make($data, [
			'province' => ['required'],
			'hospcode' => ['required'],
			'title_name' => ['required'],
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'min:6', 'confirmed'],
			'password_confirmation' => ['required', 'min:6'],
			'captcha' => ['required', 'captcha'],
		]);
		*/
	}

	protected function create(array $data) {
	/* use for user model */
	/*
		if (!isset($data['title_name_other']) || empty($data['title_name_other'])) {
			$data['title_name_other'] = NULL;
		}
		return User::create([
			'province' => $data['province'],
			'hospcode' => $data['hospcode'],
			'title_name' => $data['title_name'],
			'title_name_other' => $data['title_name_other'],
			'name' => $data['name'],
			'lastname' => $data['lastname'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
		]);*/
	}

	protected function register(Request $request) {
		$this->validate($request, [
			'username' => 'required|string|max:255',
			'name' => 'required|string|max:255',
			'email' => 'required|email|max:255|unique:users,email',
			'password' => 'required|same:confirm-password',
		]);
		$input = $request->all();
		if (!isset($input['title_name_other'])) {
			$input['title_name_other'] = NULL;
		}
		$input['password'] = Hash::make($input['password']);
		$user = User::create($input);
		$user->assignRole($request->input('roles'));
		return redirect()->route('register')->with('success', 'User created successfully');
	}

	public function getHospByProv(Request $request)
	{
		$this->result = self::hospitalByProv($request->prov_id);
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>\n";
		foreach($this->result as $key=>$value) {
				$htm .= "<option value=\"".$value->hospcode."\">".$value->hosp_name."</option>\n";
		}
		return $htm;
	}

	public function hospitalByProv($prov_code=0) {
		return DB::connection('mysql')
			->table('hospitals')
			->where('prov_code', '=', $prov_code)
			->whereIn('hosp_type_code', ['05', '06', '07', '11'])
			->orderBy('id', 'asc')
			->get();
	}

	/* random for generate the pin */
	public function randPin($prefix=null, $separator=null) {
		// Available alpha caracters
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		// generate a pin based on 2 * x digits + a random character
		$pin = mt_rand(1000, 9999).mt_rand(1000, 9999).$characters[rand(0, strlen($characters) - 1)];
		// get date
		$date = date('Ymd');
		// shuffle the result
		$string = $prefix.$separator.str_shuffle($pin);
		return $string;
	}

	//return redirect::to('http://viral.ddc.moph.go.th/viral/index.php');
}
