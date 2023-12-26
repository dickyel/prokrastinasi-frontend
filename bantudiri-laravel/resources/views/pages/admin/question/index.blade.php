@extends('layouts.admin')


@section('title','Question-admin')

@section('content')

 <!-- Page Content  -->
<div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Pertanyaan</h2>
    <div class="row">
        <div class="mb-3">
            <a href="{{ route('question-admin.create') }}" class="btn btn-primary">Tambah Pertanyaan</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                <thead class="thead-dark">
                    <tr>
                    <th>#</th>
                    <th>Pertanyaan</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
       
    </div>
</div>
@endsection

@push('after-script')
    <script>
        // AJAX DataTable
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { 
                  data: 'DT_RowIndex', 
                  name: 'DT_RowIndex', 
                  orderable: false, 
                  searchable: false,
                  width: '5%',
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                  }
                },
                { data: 'question', name: 'question' },
           
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
    </script>
@endpush
