@extends('template.main')

@section('main-title')
    Patient Test
@endsection

@section('body')
    <div class="row">

        {{--  table  --}}
        <div class="col-12">
            <div class="card m-b-30 card-body">
                <h4 class="card-title">Data <a href="{{ route('patient_test.export_pdf') }}" class="btn btn-info">Export</a></h4>
                <div class="table-responsive">
                    <table class="table table-bordered" id="my-data-table">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Status Test</th>
                                <th>Test Date</th>
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
            ajax: "{{ route('patient_test.export') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'patient.name.', name: 'patient.name'},
                {data: 'status_patient', name: 'status_patient'},
                {data: 'status_test', name: 'status_test'},
                {data: 'test_date', name: 'test_date'},
            ]
        })
    </script>
@endsection


