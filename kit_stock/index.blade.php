@extends('template.main')

@section('main-title')
    Kit Stock
@endsection

@section('body')
    <div class="row">
        {{--  input form  --}}
        <div class="col-12">
            <div class="card m-b-30 card-body">
                <h4 class="card-title font-16 mt-0">Insert</h4>
                <form action="{{ route('kit_stock.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="text" class="form-control" name="stock" value="{{ old('stock') }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
        {{--  end input form  --}}

        {{--  table  --}}
        <div class="col-12">
            <div class="card m-b-30 card-body">
                <h4 class="card-title">Data</h4>
                <div class="table-responsive">
                    <table class="table table-bordered" id="my-data-table">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--  end table  --}}
    </div>
@endsection

@section('pages-js')
    <script type="text/javascript">
        //for showing datatables
        $('#my-data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('kit_stock.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'code', name: 'code'},
                {data: 'name', name: 'name'},
                {data: 'stock', name: 'stock'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
        })
    </script>
@endsection


