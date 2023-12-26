@extends('layouts.admin')

@section('title', 'Result-admin')

@section('content')

<div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Hasil Tes Prokraktinasi</h2>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenjang</th>
                        <th>Tanggal Tes</th>
                        <th>Pertanyaan & Jawaban</th>
                        <th>Hasil Skor</th>
                        <th>Level</th>
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
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ],

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
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true,
                },
                {
                    data: 'jenjang',
                    name: 'jenjang',
                    searchable: true,
                },
                {
                    data: 'date_test',
                    name: 'date_test',
                    searchable: true,
                    render: function (data) {
                        // Format the date using a library like moment.js or a custom function
                        // For simplicity, here's an example without a library
                        var date = new Date(data);
                        var options = { year: 'numeric', month: 'long', day: 'numeric' };
                        return date.toLocaleDateString('id-ID', options);
                    },
                },

                {
                    data: 'questions',
                    name: 'questions',
                    render: function (data) {
                        var html = '';
                        data.forEach(function (item) {
                            html += '<div>' +
                                '<div>' + item.question + '</div>' + '<br>' +
                                '<div>' + item.response + '</div>' +
                                '</div>';
                        });
                        return html;
                    }
                },
                {
                    data: 'total_score',
                    name: 'total_score',
                    searchable: true,
                },
                {
                    data: 'level',
                    name: 'level',
                    searchable: true,
                },
            ],
        });
    </script>
@endpush
