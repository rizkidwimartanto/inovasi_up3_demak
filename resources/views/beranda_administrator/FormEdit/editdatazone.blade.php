@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-5">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header bg-info text-white text-center rounded-top">
                <h3 class="mb-0">Edit Data Zone</h3>
            </div>
            <div class="card-body p-4">
                <form action="/updating/edit_datazone/{{ $datazone->id }}" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $datazone->id }}">
                    <div class="mb-3">
                        <label class="form-label">Keypoint</label>
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" name="keypoint" id="keypoint"
                                value="{{ $datazone->keypoint }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jarak</label>
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" name="jarak" id="jarak"
                                value="{{ $datazone->jarak }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Latitude</label>
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" name="latitude" id="latitude"
                                value="{{ $datazone->latitude }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Longitude</label>
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" name="longitude" id="longitude"
                                value="{{ $datazone->longitude }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Google Maps</label>
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" name="google_maps" id="google_maps"
                                value="{{ $datazone->google_maps }}">
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-block" type="submit"><i
                                class="fa-solid fa-right-to-bracket fa-lg" style="margin-right: 5px;"></i> Submit</button>
                        <a href="/updating" class="btn btn-secondary"><i class="fa-solid fa-left-long fa-lg"
                                style="margin-right: 5px;"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
