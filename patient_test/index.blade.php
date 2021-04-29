@extends('template.main')

@section('main-title')
    Patient Test
@endsection

@section('body')
    <div class="row">

        {{--  table  --}}
        <div class="col-12">
            <div class="card m-b-30 card-body">
                <h4 class="card-title">Data</h4>
                <div class="table-responsive">
                    <table class="table table-bordered" id="my-data-table">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Status Test</th>
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
            ajax: "{{ route('patient_test.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'status_patient', name: 'status_patient'},
                {data: 'status_test', name: 'status_test'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
        })
    </script>
@endsection


