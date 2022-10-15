@extends('template.base')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">            
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Bootcamp</h6>
                <a href="#" data-bs-toggle="modal" data-bs-target="#addKategori" class="btn btn-sm btn-primary">+ Kategori</a>
            </div>
        </div>
        <div class="card-body">    
            <div id="success_message"></div>
            <div class="table-responsive">
                <table id="tableKategori" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>   
                        @foreach($kategori as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->nama}}</td>
                            <td>{{ $row->slug }}</td>
                            <td></td>
                        </tr> 
                        @endforeach
                                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                </div>
                <div class="modal-body">
                    <ul id="saveFormErrorList"></ul>
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                            <input type="text" class="nama form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" id="tutup">Close</button>
                    <button class="btn btn-primary btn-sm" id="savaKategori">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Page level plugins -->
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#tableKategori').DataTable({
                "language": {
                    "emptyTable": "Belum ada data kategori bootcamp!"
                }
            });

            $(document).on('click', '#tutup', function(e){
                e.preventDefault();
                // $('#saveFormErrorList').hide();                
                $('#addKategori').modal('hide');
            });

            $(document).on('click', '#savaKategori', function(e){
                e.preventDefault();

                var data = {
                    'nama' : $('.nama').val(),
                }

                // console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('welcome.save') }}",
                    data: data,
                    dataType: "json",
                    success: function(response){
                        // console.log(response);
                        if(response.status == 400){
                            $('#saveFormErrorList').html("");
                            $('#saveFormErrorList').addClass("alert alert-danger");
                            $.each(response.errors, function(key, err_val){
                                $('#saveFormErrorList').append('<li>'+err_val+'</li>');
                            });
                        }else{                            
                            $('#addKategori').modal('hide');
                            $('#addKategori').find('input').val("");   
                            setTimeout(function(){// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 5000);     
                            $('#success_message').html("");
                            $('#success_message').addClass("alert alert-success");
                            $('#success_message').text(response.message);                     
                        }
                         
                    }
                });
            });

        });

    </script>
@endsection