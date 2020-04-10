<?php

namespace App\Exports;

use App\Invest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class InvestExportFromQuery implements FromQuery, ShouldQueue
{
	use Exportable;

	public function query()
	{
		return Invest::query()->select('id', 'first_name', 'last_name')->where('id', '<=', 1000);
	}
}
