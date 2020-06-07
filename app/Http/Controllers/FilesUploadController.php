<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\DataTables\ListFilesUploadDataTable;
use App\Http\Controllers\MasterController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Invest;
use App\FilesUpload;

class FilesUploadController extends Controller
{
	public function index(ListFilesUploadDataTable $dataTable, $id) {
		try {
			$file_type = $this->getFileType();
			$patient = Invest::select('id', 'sat_id')->where('id', '=', $id)->get()->toArray();
			if (count($patient) <= 0) {
				return redirect()->back()->with('error', 'ไม่พบข้อมูลที่เลือก โปรดตรวจสอบ');
			} else {
				return $dataTable->with('id', $id)->render('files.create', ['file_type'=> $file_type, 'patient'=> $patient]);
			}
		} catch (Exception $e) {
			Log::error('List file error! '.$e->getMessage());
		}
	}

	public function store(Request $request) {
		try {
			$request->validate([
				'file_detail' => 'nullable|max:300',
				'file_upload' => 'mimes:jpeg,png,svg,txt,csv,xls,xlsx,doc,docx,pdf|max:3000'
			],[
				'file_detail.max' => 'ข้อความรายละเอียดไม่เกิน 300 ตัวอักษร',
				'file_upload.mimes' => 'ไม่อนุญาตให้อับโหลดไฟล์นี้',
				'file_upload.max' => 'ไฟล์อับโหลดไม่ควรเกิน 2 MB'
			]);
			if (Input::hasFile('file_upload')) {
				$file_mime = $request->file('file_upload')->getMimeType();
				$file_size_byte = $request->file('file_upload')->getSize();
				$file_size = ($file_size_byte/1024);
				$new_name = 'p'.$request->pid.'t'.time();
				$file_extension = Input::file('file_upload')->getClientOriginalExtension();
				$file_name = $new_name.'.'.$file_extension;
				$storage = Storage::disk('invest')->put($file_name, File::get(Input::file('file_upload')));
				if ($storage) {
					$result = DB::table('files_upload')->insert(
						[
							'ref_user_id' => auth()->user()->id,
							'ref_pt_id' => $request->pid,
							'ref_pt_sat_id' => $request->sat_id,
							'file_name' => $file_name,
							'file_mime' => $file_mime,
							'file_path' => '/invest',
							'file_size' => $file_size,
							'file_upload_type' => $request->file_upload_type,
							'file_detail' => $request->file_detail
						]
					);
					if ($result) {
						Log::notice("User: ".auth()->user()->id." Uploaded file ".$file_name);
						return redirect()->back()->with('success', 'อับโหลดไฟล์สำเร็จแล้ว');
					} else {
						Log::warning($file_name.": บันทึกข้อมูลรายละเอียดของไฟล์ไม่สำเร็จ");
						return redirect()->back()->with('error', 'บันทึกข้อมูลรายละเอียดของไฟล์ไม่สำเร็จ');
					}
				}
			} else {
				return redirect()->back()->with('error', 'กรุณาเลือกไฟล์ที่ต้องการอับโหลด');
			}
		} catch (Exception $e) {
			Log::error('Upload file error! '.$e->getMessage());
		}
	}

	public function download($file_id=0) {
		$file = DB::table('files_upload')->select('file_name', 'export_amount')->where('id', '=', $file_id)->get();
		if (count($file) > 0) {
			if (Storage::disk('invest')->exists($file[0]->file_name)) {
				$amount = ($file[0]->export_amount+1);
				DB::table('files_upload')->where('id', $file_id)->update(['export_amount' => $amount]);
				Log::notice('User: '.auth()->user()->id.' Downloaded file '.$file[0]->file_name);
				return Storage::disk('invest')->download($file[0]->file_name);
			} else {
				return redirect()->back()->with('error', 'ไม่สามารถดาวน์โหลดไฟล์นี้ได้');
			}
		} else {
			return redirect()->back()->with('error', 'ไม่พบไฟล์');
		}
	}


	public function softDeleteFileUpload(Request $request) {
		$user = auth()->user();
		$user_role = $user->roles->pluck('name');
		switch ($user_role[0]) {
			case 'root' :
				$file = FilesUpload::where('id', '=', $request->fid)->delete();
				break;
			default :
				$file = FilesUpload::where('id', '=', $request->fid)
					->where('ref_user_id', '=', $user->id)
					->delete();
				break;
		}
		if ($file) {
			Log::notice('User: '.$user->id.' Deleted file id: '.$request->fid);
			return redirect()->back()->with('success', 'ข้อมูลรหัสที่ '.$request->fid.' ถูกลบออกจากระบบแล้ว');
		} else {
			return redirect()->back()->with('error', 'ข้อมูลรหัสที่ '.$request->fid.' ไม่สามารถลบออกจากระบบได้ โปรดตรวจสอบเงื่อนไข');
		}
	}

	private function getFileType() {
		$master = new MasterController;
		$file_type = $master->setFileUploadType();
		return $file_type;
	}

	private function randomGen($min=0, $max=20, $quantity=6) {
		$numbers = range($min, $max);
		shuffle($numbers);
		return array_slice($numbers, 0, $quantity);
	}
}
