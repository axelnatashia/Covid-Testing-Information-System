@extends('template.main')

@section('body')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('kit_stock.index') }}" class="btn btn-secondary mb-3"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
            <div class="card m-b-30 card-body">
                <h4 class="card-title font-16 mt-0">Edit</h4>
                <form action="{{ route('kit_stock.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" name="code" value="{{ old('code', $data->code) }}">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}">
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="text" class="form-control" name="stock" value="{{ old('stock', $data->stock) }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success mr-2">Update</button>
                        <button type="reset" class="btn btn-danger mr-2">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
