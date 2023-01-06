<?php

namespace App\Http\Controllers;


use App\Models\BiayaPengiriman;
use App\Models\Pengeluaran;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        $pengiriman = Pengiriman::where('status_pengiriman', 'Selesai')->sum('total_biaya_keseluruhan');
        $pengeluaran = Pengeluaran::all()->sum('jumlah');
        $biaya_pengiriman = BiayaPengiriman::all();

        $total_pemasukan_tahunan = [
            'chart_title' => 'Total Pemasukan Per Tahun',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pengiriman',
            'group_by_field' => 'created_at',
            'group_by_period' => 'year',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total_biaya_keseluruhan',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'chart_type' => 'line',
            'where_raw'   => 'status_pengiriman = "Selesai"'
        ];

        $chart1 = new LaravelChart($total_pemasukan_tahunan);

        $total_pemasukan_bulanan  = [
            'chart_title' => 'Total Pemasukan Per Bulan',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pengiriman',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total_biaya_keseluruhan',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'chart_type' => 'bar',
            'where_raw'   => 'status_pengiriman = "Selesai"'
        ];

        $chart2 = new LaravelChart($total_pemasukan_bulanan);

        $total_pengeluaran_tahunan = [
            'chart_title' => 'Total Pengeluaran Per Tahun',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pengeluaran',
            'group_by_field' => 'created_at',
            'group_by_period' => 'year',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'jumlah',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'chart_type' => 'line',
        ];

        $chart3 = new LaravelChart($total_pengeluaran_tahunan);

        $total_pengeluaran_bulanan  = [
            'chart_title' => 'Total Pengeluaran Per Bulan',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pengeluaran',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'jumlah',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'chart_type' => 'bar',
        ];

        $chart4 = new LaravelChart($total_pengeluaran_bulanan);

        $jumlah_pengiriman_tahunan = [
            'chart_title' => 'Total Pengiriman Per Tahun',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pengiriman',
            'group_by_field' => 'created_at',
            'group_by_period' => 'year',
            'aggregate_function' => 'count',
            'aggregate_field' => 'total_biaya_keseluruhan',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'chart_type' => 'line',
            'where_raw'   => 'status_pengiriman = "Selesai"'
        ];

        $chart5 = new LaravelChart($jumlah_pengiriman_tahunan);

        $jumlah_pengiriman_bulanan = [
            'chart_title' => 'Total Pengiriman Per Bulanan',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pengiriman',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'count',
            'aggregate_field' => 'total_biaya_keseluruhan',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'chart_type' => 'bar',
            'where_raw'   => 'status_pengiriman = "Selesai"'
        ];

        $chart6 = new LaravelChart($jumlah_pengiriman_bulanan);

        $user_login = auth()->user()->id;
        $jumlah_pengiriman_pelanggan = [
            'chart_title' => 'Total Pengiriman Pelanggan',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pengiriman',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'count',
            'aggregate_field' => 'total_biaya_keseluruhan',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'chart_type' => 'line',
            'where_raw'   => 'status_pengiriman = "Selesai"  AND user_id = "' . $user_login . '"'
        ];

        $chart7 = new LaravelChart($jumlah_pengiriman_pelanggan);

        return view('dashboard', compact('pengiriman', 'pengeluaran', 'biaya_pengiriman', 'chart1', 'chart2', 'chart3', 'chart4', 'chart5', 'chart6', 'chart7'));
    }
}
