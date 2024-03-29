<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataPelangganExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\DataPelangganImport;
use App\Models\DataPelangganModel;
use App\Models\EntriPadamModel;
use App\Models\PenyulangModel;
use App\Models\SectionModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;


class DataPelangganController extends Controller
{
    public function index()
    {
        $data_peta = DB::table('data_pelanggan')
            ->select('data_pelanggan.id', 'data_pelanggan.nama', 'data_pelanggan.alamat', 'data_pelanggan.maps', 'data_pelanggan.latitude', 'data_pelanggan.longtitude', 'data_pelanggan.nama_section', 'data_pelanggan.nohp_stakeholder', 'data_pelanggan.unitulp')
            ->get();
        $data_padam = DB::table('entri_padam')
            ->select('entri_padam.status', 'entri_padam.section')
            ->get();
        $data = [
            'title' => 'Peta Pelanggan',
            'data_padam' => $data_padam,
            'data_peta' => $data_peta,
            'data_unitulp' => DataPelangganModel::pluck('unitulp')
        ];
        return view('beranda/index', $data);
    }
    public function entri_padam()
    {
        $data_penyulang = SectionModel::pluck('penyulang');

        $penyulangs = [];
        foreach ($data_penyulang as $penyulang) {
            $penyulangs[$penyulang] = SectionModel::where('penyulang', $penyulang)->pluck('id_apkt');
        }
        $data = [
            'title' => 'Entri Padam',
            'section' => $penyulangs,
            'nama_pelanggan' => DataPelangganModel::pluck('nama'),
            'data_penyulang' => SectionModel::pluck('penyulang'),
            'data_section' => PenyulangModel::all(),
        ];
        return view('beranda/entripadam', $data);
    }
    public function input_pelanggan()
    {
        $data_pelanggan = DataPelangganModel::all();

        $data = [
            'title' => 'Updating',
            'data_pelanggan' => $data_pelanggan,
        ];
        return view('beranda/inputpelanggan', $data);
    }
    public function export_excel()
    {
        date_default_timezone_set('Asia/Jakarta');
        return Excel::download(new DataPelangganExport, 'PELANGGAN TM UP3 DEMAK '  . date('d-m-Y') . '.xlsx');
    }
    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_pelanggan', $nama_file);
        Excel::import(new DataPelangganImport, public_path('/file_pelanggan/' . $nama_file));

        return redirect('/inputpelanggan');
    }
    public function hapusPelanggan(Request $request)
    {
        $hapus_items = $request->input('checkPelanggan');
        if ($hapus_items) {
            foreach ($hapus_items as $hapus) {
                $pelanggan = DataPelangganModel::find($hapus);
                $pelanggan->delete();
            }
            Session::flash('success_hapus_pelanggan', 'Data berhasil dihapus');
        } else {
            Session::flash('error_hapus_pelanggan', 'Data gagal dihapus');
        }
        return redirect('/inputpelanggan');
    }
}
