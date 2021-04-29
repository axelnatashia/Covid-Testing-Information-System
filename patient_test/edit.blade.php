@extends('template.main')

@section('body')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('patient_test.index') }}" class="btn btn-secondary mb-3"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
            <div class="card m-b-30 card-body">
                <h4 class="card-title font-16 mt-0">Edit</h4>
                <form action="{{ route('patient_test.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Status Testing</label>
                        <select name="status" id="" class="form-control">
                            <option value="complete" selected>Complete</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{ old('name', $data->patient->name) }}" readonly>
                        {{-- <input type="hidden" class="form-control" name="patient_id" value="{{ request()->patient_id }}"> --}}
                    </div>
                    <div class="form-group">
                        <label>Status Patient</label>
                        <select name="type" id="" class="form-control">
                            <option value="">-PILIH-</option>
                            @foreach (returnTypePatient() as $key => $value)
                                @if (count($data->patient->latest_patient_test))
                                    <option value="{{ $key }}" {{ (old('type', $data->patient->latest_patient_test[0]->type) == $key) ? "selected" : "" }}>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}" {{ (old('type') == $key) ? "selected" : "" }}>{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kit Stock</label>
                        <input type="text" class="form-control" readonly value="{{ $data->kit_stock->name }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success mr-2">Update</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
