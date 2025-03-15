<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;

class HistoricoDeComprasController extends Controller
{
	public function generate($request)
	{
	$data = [
		'',
	];

	$pdf = Pdf::loadView('historico', $data);

	return $pdf->stream();

	return view('historico', $data);
	}

}

//Controler aprendido a fazer pelo otimo video https://www.youtube.com/watch?v=2hnUrXaHaU0&ab_channel=SusanB.