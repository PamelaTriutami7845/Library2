<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Member;
use App\Models\publisher;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class adminController extends Controller
{
    //

    public function dashboard()
    {
        $total_member = Member::count();
        $total_book = book::count();

        $total_peminjaman = Peminjaman::whereMonth(
            'tgl_pinjam',
            date('m')
        )->count();

        return $total_peminjaman;

        $total_publisher = publisher::count();

        $data_donut = book::select(DB::raw('COUNT(publisher_id) as total'))
            ->groupBy('publisher_id')
            ->orderBy('publisher_id', 'asc')
            ->pluck('total');

        $label_donut = publisher::orderBy('publisher.id', 'asc')
            ->join('books', 'books.publisher_id', '=', 'publisher.id')
            ->groupBy('name')
            ->pluck('name');

        // return $label_donut;

        $label_bar = ['Peminjaman'];
        $data_bar = [];

        foreach ($label_bar as $key => $value) {
            $data_bar[$key]['label'] = $label_bar[$key];
            $data_bar[$key]['backgroundColor'] = 'rgba(60,141,188,0,0)';

            foreach (range(1, 12) as $value) {
                $data_month[] = Peminjaman::select(DB::raw('COUNT(*) as total'))
                    ->whereMonth('tgl_pinjam', $month)
                    ->first()->total;
            }
            $data_bar[$key]['data'] = $data_month;
        }
        return view(
            'admin.home',
            compact(
                'total_buku',
                'total_member',
                'total_peminjaman',
                'total_publisher'
            )
        );
    }

    public function catalog()
    {
        $data_katalog = Catalog::all();
        return view('admin.Catalog.catalog', compact('data_katalog'));
    }

    public function publisher()
    {
        return view('admin.publisher');
    }

    public function author()
    {
    }
}
