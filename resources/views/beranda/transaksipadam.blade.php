@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-3">
        @if (session('success_nyala'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3>{{ session('success_nyala') }}</h3>
            </div>
        @endif
        @if (session('error_nyala'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3>{{ session('error_nyala') }}</h3>
            </div>
        @endif
        <div class="card border border-info p-3 mb-3">
            <h2>Jumlah Kali Padam</h2>
            <a href="/transaksipadam/export_kali_padam" class="btn btn-warning mb-3 col-lg-2"><i
                    class="fa-solid fa-download fa-lg" style="margin-right: 5px"></i>Export Excel</a>
            <table class="table table-vcenter table-bordered table-hover table-warning" id="tabel_rekap_pelanggan"
                style="width: 100%">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="45%">Section</th>
                        <th width="45%">Nomor Tiang</th>
                        <th width="5%">Kali Padam</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($rekap_section as $item_section)
                        @if ($item_section->penyebab_padam === 'Gangguan')
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item_section->section }}</td>
                                <td>{{ $item_section->nama_section }}</td>
                                <td>{{ $item_section->jumlah_entri }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-12">
            <div class="card border border-info p-3 mt-4">
                <h2>Rekap Data Padam</h2>
                <table class="table table-vcenter table-bordered table-hover table-info" id="tabel_data_menyala"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th>Penyebab Padam</th>
                            <th>Nama Pelanggan</th>
                            <th>Penyulang</th>
                            <th>Section</th>
                            <th>Penyebab Fix</th>
                            <th>Jam Padam</th>
                            <th>Jam Nyala</th>
                            <th>Durasi Padam</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data_padam as $s)
                            @if ($s->status == 'Menyala')
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $s->penyebab_padam }}</td>
                                    <td>{{ $s->nama_pelanggan }}</td>
                                    <td>{{ $s->penyulang }}</td>
                                    <td>{{ $s->section }}</td>
                                    <td>{{ $s->penyebab_fix }}</td>
                                    <td>{{ $s->jam_padam }}</td>
                                    <td>{{ $s->jam_nyala }}</td>
                                    <td>
                                        @php
                                            $waktuPadam = strtotime($s->jam_padam);
                                            $waktuNyala = strtotime($s->jam_nyala);
                                            $durasiDetik = $waktuNyala - $waktuPadam;

                                            $durasiJam = floor($durasiDetik / (60 * 60));
                                            $durasiMenit = floor(($durasiDetik % (60 * 60)) / 60);
                                            $durasiPadam = $durasiJam . ' jam ' . $durasiMenit . ' menit';
                                        @endphp
                                        {{ $durasiPadam }}</td>
                                    <td>{{ $s->keterangan }}</td>
                                    <td>{{ $s->status }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function templateDataTable(namaTabel) {
            $(document).ready(function() {
                $(namaTabel).DataTable({
                    scrollX: true,
                    scrollCollapse: true,
                    fixedColumns: true,
                    'pageLength': 500,
                    'lengthMenu': [10, 25, 50, 100, 200, 500],
                });
            });
        }
        templateDataTable('#tabel_data_menyala');
        templateDataTable('#tabel_rekap_pelanggan');
    </script>
@endsection
