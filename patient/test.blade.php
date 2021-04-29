@extends('template.main')

@section('body')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('patient.index') }}" class="btn btn-secondary mb-3"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
            <div class="card m-b-30 card-body">
                <h4 class="card-title font-16 mt-0">Edit</h4>
                <form action="{{ route('patient.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="type" id="" class="form-control">
                            <option value="">-PILIH-</option>
                            @foreach (returnTypePatient() as $key => $value)
                                <option value="{{ $key }}" {{ (old('type', $data->latest_patient_test[0]->type) == $key) ? "selected" : "" }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kit Stock</label>
                        <select name="kit_stock_id" id="" class="form-control">
                            <option value="">-PILIH-</option>
                            @foreach ($kit_stock as $item)
                                <option value="{{ $item->id }}" {{ (old('kit_stock_id') == $item->id) ? "selected" : "" }} {{ ($item->stock < 1) ? "disabled" : "" }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
