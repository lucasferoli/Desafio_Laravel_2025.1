<?php

namespace App\Http\Controllers;

use App\Models\Movimentacoes;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Routing\Controller;
use Barryvdh\DomPDF\Facade\Pdf;


class MovimentacoesController extends Controller
{
    public function index()
    {
        $movimentacoes = Movimentacoes::where('buyer_id', Auth::id())->get();
        return view('historico-compras', compact('movimentacoes'));
    }

    public function generatePdf()
    {
        $movimentacoes = Movimentacoes::where('buyer_id', Auth::id())->get();
        $data = ['movimentacoes' => $movimentacoes];
        $pdf = Pdf::loadView('historico-compras-pdf', $data);
        return $pdf->stream('historico-compras.pdf');
    }

    public function indexVendas()
    {
        $movimentacoes = Movimentacoes::join('product', 'movimentacoes.product_id', '=', 'product.id')
            ->where('product.advertiser_id', Auth::id())
            ->select('movimentacoes.*')
            ->get();
        return view('historico-vendas', compact('movimentacoes'));
    }

    public function generateVendasPdf()
    {
        $movimentacoes = Movimentacoes::join('product', 'movimentacoes.product_id', '=', 'product.id')
            ->where('product.advertiser_id', Auth::id())
            ->select('movimentacoes.*')
            ->get();
        $data = ['movimentacoes' => $movimentacoes];
        $pdf = Pdf::loadView('historico-vendas-pdf', $data);
        return $pdf->stream('historico-vendas.pdf');
    }
}
