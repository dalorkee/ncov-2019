<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genome;
class GenomeController extends Controller
{
	protected function createGenomeForm(Request $request) {
		$data = Genome::select('id', 'sat_id')->findOrFail($request->id);
		return view('genome.index', ['data' => $data]);
	}
	public function index() {}
	public function store(Request $request) {}
	public function show(Genome $genome) {}
	public function edit(Genome $genome) {}
	public function update(Request $request, Genome $genome) {}
	public function destroy(Genome $genome) {}

	public function genomeSend(Request $request) {
		$htm = "
		<div class=\"modal-header\">
			<h5 class=\"modal-title text-color-custom-6\" id=\"statusModalLabel\"><i class=\" fas fa-check-circle\"></i> ส่งตรวจ Genome รหัส: </h5>
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>
		<div class=\"modal-body\">
			<div class=\"form-row\">
			</div>
		</div>
		<div class=\"modal-footer\">
			<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ยกเลิก</button>
			<input type=\"submit\" class=\"btn btn-custom-3\" value=\"ส่งทันที\">
		</div>
		<script>
		</script>";
			return $htm;
		}

}
