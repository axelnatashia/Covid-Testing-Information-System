@extends('template.main')

@section('body')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('patient_test.index') }}" class="btn btn-secondary mb-3"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
            <div class="card m-b-30 card-body">
                <h4 class="card-title font-16 mt-0">Create</h4>
                <form action="{{ route('patient_test.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Status Testing</label>
                        <select name="status" id="" class="form-control">
                            <option value="pending" selected>Pending</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{ old('name', $data->name) }}" readonly>
                        <input type="hidden" class="form-control" name="patient_id" value="{{ request()->patient_id }}">
                    </div>
                    <div class="form-group">
                        <label>Status Patient</label>
                        <select name="type" id="" class="form-control">
                            <option value="">-PILIH-</option>
                            @foreach (returnTypePatient() as $key => $value)
                                @if (count($data->latest_patient_test))
                                    <option value="{{ $key }}" {{ (old('type', $data->latest_patient_test[0]->type) == $key) ? "selected" : "" }}>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}" {{ (old('type') == $key) ? "selected" : "" }}>{{ $value }}</option>
                                @endif
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
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
