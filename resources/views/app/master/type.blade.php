@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="title">{{ $title }}</h4>
                <p class="category">{{ $description }}</p>
                <br>
                
                <div class="card">
                    <div class="card-content">
                        <div class="toolbar">
                            @if(session('message'))
                            {!!session('message')!!}
                            @endif
                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissable">
                                <strong>Failed!</strong>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </div>
                            @endif
                            <button type="button" style="margin-bottom:10px" class="btn btn-info btn-create" name="button" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="ti-plus"></i> Add Type</button>
                            
                        </div>
                        
                        <div class="fresh-datatables table-responsive">
                            <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Type</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $data->type }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btn-show" data-id="{{ $data->id }}" data-toggle="modal" data-target=".bs-example-modal-lg">Edit</button>
                                            <form action="{{ route('comoditytype.destroy', $data->id) }}" method="post" style="display:inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script type="text/javascript">
    $('#datatables').DataTable();
    
    $("#datatables").on("click", ".btn-delete", function() {
        swal({
            title: 'Apakah kamu yakin untuk menghapus data ini ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success btn-fill',
            cancelButtonClass: 'btn btn-danger btn-fill',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            buttonsStyling: false
        }).then(() => {
            $(this).parent().submit();
        });
    });
    
    $("#datatables").on("click", ".btn-show", function() {
        $("#isLoading").show();
        $("#viewResults").hide();
        
        let self = $(this);
        let id   = self.data('id');
        let url  = document.head.querySelector('meta[name="app-url"]').content;
        let url_form = url+'/app/master/commodity-type/'+id;
        
        axios.get(`${url}/app/master/commodity-type/${id}`).then(function (response) {
            let data = response.data
            let i = 1

            $("#type").val(data[0].type);
            $("#url_form").attr("action",url_form);
            
            
            $("#isLoading").hide();
            $("#viewResults").show();
        }).catch((error) => {
            console.log(error);
        });
    });
    
    $(".btn-create").click(function () {
        $("#isLoading").hide();
        $("#viewResults").show();
        let url  = document.head.querySelector('meta[name="app-url"]').content;
        let url_form = url+'/app/master/commodity-type/store/data';
        $("#url_form").attr("action",url_form);
    });
    
</script>
@endsection

@section('modal')
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{-- <h4 class="modal-title" id="myModalLabel">Modal title</h4> --}}
            </div>
            <div class="modal-body">
                <div id="isLoading" class="text-center">
                    <i class="fa fa-spinner fa-spin fa-5x fa-fw"></i><br />
                    <p>Menggambil data dari server...</p>
                </div>
                <div id="viewResults" style="display:none">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="" action="tes" method="post" id="url_form">
                                {{ csrf_field() }}
                                {{-- {{ method_field('PUT') }} --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Type</label>
                                    <input type="text" class="form-control" name="type" id="type" placeholder="Type Commodity" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1"></label>
                                    <button class="btn btn-primary" type="submit" name="submit" id="btn_submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
