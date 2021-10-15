@extends('layouts.web')
@push('style')
	
@endpush
@section('conten')   
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{$menu}}</a></li>
        </ol>
        
        <h1 class="page-header">{{$menu}} <small>{{name()}}</small></h1>
        <div class="panel panel-success" data-sortable-id="ui-widget-11" >
            <div class="panel-heading">
                <h4 class="panel-title">Daftar User</h4>
                <div class="panel-heading-btn">
                    <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> -->
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="btn-group" style="margin-bottom:2%">
                    <button class="btn btn-blue btn-sm active" onclick="tambah_data()"><i class="fa fa- plus-circle"></i> Tambah</button>
                    <button class="btn btn-red  btn-sm active"><i class="fa fa- times-circle"></i> Hapus</button>
                </div>
                <form id="myall" onkeypress="return event.keyCode != 13" method="post" enctype="multipart/form-data">
                    <table id="datafixedheader" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="3%"></th>
                                <th class="text-wrap" width="6%">NIK</th>
                                <th class="text-wrap" width="15%">NIK KTP</th>
                                <th class="text-wrap"  width="20%">Nama</th>
                                <th class="text-nowrap">Alamat</th>
                                <th class="text-nowrap" width="4%">QrCode</th>
                                <th class="text-nowrap" width="9%">Act</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach($data as $no=>$o)
                                <tr class="odd gradeX">
                                    <td>{{$no+1}}</td>
                                    <td><input type="checkbox" name="nik_ktp[]" value="{{$o->nik_ktp}}"></td>
                                    <td>{{$o->nik}}</td>
                                    <td>{{$o->nik_ktp}}</td>
                                    <td>{{$o->name}}</td>
                                    <td>{{$o->alamat}}</td>
                                    <td><span class="btn btn-green btn-xs" onclick="cek_qrcode(`{{$o->nik_ktp}}`)">QrCode</span></td>
                                    <td>
                                        <span onclick="ubah(`{{$o->nik_ktp}}`)" class="btn btn-purple active btn-xs"><i class="fas fa-edit fa-sm"></i> View</span> 
                                    </td>
                                </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </form>

            </div>
            
        </div>

        <div class="row">
            <div class="modal" id="modal-tambah" aria-hidden="true" style="display: none;background: #1717198a;">
                <div class="modal-dialog modal-lg" style="margin-top:0px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Karyawan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" style="background: #b5b5d330;">
                           <form id="mycreate" onkeypress="return event.keyCode != 13" action="{{url('Karyawan')}}" method="post" enctype="multipart/form-data">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                                            <span class="d-sm-none">Tab 1</span>
                                            <span class="d-sm-block d-none">Profil Diri</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#default-tab-2" data-toggle="tab" class="nav-link">
                                            <span class="d-sm-none">Tab 2</span>
                                            <span class="d-sm-block d-none">Profil Karyawan</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                                <div class="tab-content" style="margin-bottom:0px;padding:1%">
						            <div class="tab-pane fade active show" id="default-tab-1">
                                        <div class="col-xl-10 offset-xl-1">
                                            <div class="form-group row m-b-10">
                                                <label class="col-lg-4 text-lg-right col-form-label"><b>Name</b></label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <input type="text"  name="name" placeholder="Enter....." class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-10 offset-xl-1">
                                            <div class="form-group row m-b-10">
                                                <label class="col-lg-4 text-lg-right col-form-label"><b>NIK & Nomor KTP</b></label>
                                                <div class="col-lg-9 col-xl-3">
                                                    <input type="text"  name="nik" onkeypress="return hanyaAngka(event)"  placeholder="Enter....." class="form-control">
                                                </div>
                                                <div class="col-lg-9 col-xl-5">
                                                    <input type="text"  name="nik_ktp" onkeypress="return cekktp(event,this.value)" placeholder="Enter....." class="form-control">
                                                    <ul class="parsley-errors-list filled" id="notifktp" aria-hidden="false"><li class="parsley-required"></li></ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-10 offset-xl-1">
                                            <div class="form-group row m-b-10">
                                                <label class="col-lg-4 text-lg-right col-form-label"><b>Alamat</b></label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <textarea  name="alamat"  placeholder="Enter....." class="form-control" rows="3"></textarea>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-xl-10 offset-xl-1">
                                            <div class="form-group row m-b-10">
                                                <label class="col-lg-4 text-lg-right col-form-label"><b>Tempat & Tgl Lahir</b></label>
                                                <div class="col-lg-9 col-xl-5">
                                                    <input type="text"  name="tempat_lahir"  placeholder="Enter....." class="form-control">
                                                </div>
                                                <div class="col-lg-9 col-xl-3">
                                                    <input type="text"  name="tgl_lahir" id="datepicker" placeholder="Enter....." class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-10 offset-xl-1">
                                            <div class="form-group row m-b-10">
                                                <label class="col-lg-4 text-lg-right col-form-label"><b>Jenis Kelamin & Gol darah</b></label>
                                                <div class="col-lg-9 col-xl-5">
                                                    <select  name="jenis_kelamin" placeholder="Enter....." class="form-control">
                                                        <option value="">--Pilih-----</option>
                                                        <option value="Laki-laki">- Laki-laki</option>
                                                        <option value="Perempuan">- Perempuan</option>
                                                    
                                                    </select>
                                                </div>
                                                <div class="col-lg-9 col-xl-2">
                                                    <select  name="golongan_darah" placeholder="Enter....." class="form-control">
                                                        <option value="">--Pilih-----</option>
                                                        <option value="A">- A</option>
                                                        <option value="A+">- A+</option>
                                                        <option value="B">- B</option>
                                                        <option value="B+">- B+</option>
                                                        <option value="O">- O</option>
                                                        <option value="O+">- O+</option>
                                                        <option value="AB">- AB</option>
                                                        <option value="AB+">- AB+</option>
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-10 offset-xl-1">
                                            <div class="form-group row m-b-10">
                                                <label class="col-lg-4 text-lg-right col-form-label"><b>Status Penikahan</b></label>
                                                <div class="col-lg-9 col-xl-5">
                                                    <select  name="sts_nikah" placeholder="Enter....." class="form-control">
                                                        <option value="">--Pilih-----</option>
                                                        <option value="Menikah">- Menikah</option>
                                                        <option value="Belum Menikah">- Belum Menikah</option>
                                                        <option value="Janda/Duda">- Janda/Duda</option>
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
						            <div class="tab-pane fade" id="default-tab-2">
                                        <div class="col-xl-10 offset-xl-1">
                                            <div class="form-group row m-b-10">
                                                <label class="col-lg-4 text-lg-right col-form-label"><b>Waktu Bekerja(Mulai & Sampai)</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text"  name="mulai" id="datepicker2"  placeholder="Enter....." class="form-control">
                                                </div>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text"  name="sampai" id="datepicker3" placeholder="Enter....." class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-10 offset-xl-1">
                                            <div class="form-group row m-b-10">
                                                <label class="col-lg-4 text-lg-right col-form-label"><b>Jenis Pekerjaan</b></label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <input type="text"  name="jenis_pekerjaan"  placeholder="Enter....." class="form-control">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-xl-10 offset-xl-1">
                                            <div class="form-group row m-b-10">
                                                <label class="col-lg-4 text-lg-right col-form-label"><b>Lokasi Pekerjaan</b></label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <input type="text"  name="lokasi_pekerjaan"  placeholder="Enter....." class="form-control">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-xl-10 offset-xl-1">
                                            <div class="form-group row m-b-10">
                                                <label class="col-lg-4 text-lg-right col-form-label"><b>Status Karyawan & Jadwal</b></label>
                                                <div class="col-lg-9 col-xl-5">
                                                    <select  name="status" placeholder="Enter....." class="form-control">
                                                        <option value="">--Pilih-----</option>
                                                        <option value="PKWTT">- PKWTT</option>
                                                        <option value="PKWT">- PKWT</option>
                                                    
                                                    </select>
                                                </div>
                                                <div class="col-lg-9 col-xl-3">
                                                    <select  name="jadwal" placeholder="Enter....." class="form-control">
                                                        <option value="">--Pilih-----</option>
                                                        <option value="Shift">- Shift</option>
                                                        <option value="Non Shift">- Non Shift</option>
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-primary" onclick="save_data()" >Create</a>
                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="modal-ubah" aria-hidden="true" style="display: none;background: #1717198a;">
                <div class="modal-dialog modal-lg" style="margin-top:0px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ubah Karyawan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" style="background: #b5b5d330;">
                            <form id="myupdate" onkeypress="return event.keyCode != 13" action="{{url('Project')}}" method="post" enctype="multipart/form-data">
                                
                                <div id="tampil_ubah"></div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-primary" onclick="update_data()" >Simpan</a>
                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal" id="modal-qrcode" aria-hidden="true" style="display: none;background: #1717198a;">
                <div class="modal-dialog" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">QrCode</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div id="tampil_qrcode" style="text-align: center;">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal-notifikasi" style="display: none;background: #1717198a;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background: red;">
                            <h4 class="modal-title">Notifikasi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" style="background: #eb161636;">
                            <div class="alert alert-danger m-b-0">
                                <h5><i class="fa fa-info-circle"></i> Erorr</h5>
                                <div id="isi-notifikasi"></div>
                            </div>
                        </div>
                        <div class="modal-footer" style="background: red;">
                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('ajax')
    <script>
        var handleDataTableFixedHeader = function() {
            "use strict";
            
            if ($('#datafixedheader').length !== 0) {
                $('#datafixedheader').DataTable({
                    lengthMenu: [20, 40, 60],
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
                    responsive: false,
                    langth: false,
                    paging: true,
                    order: false,
                    info: false,
                });
            }
        };

        var TableManageFixedHeader = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleDataTableFixedHeader();
                }
            };
        }();

        $(document).ready(function() {
            TableManageFixedHeader.init();
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                
            });
            $('#datepicker2').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                
            });
            $('#datepicker3').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                
            });
            $('#datepicker4').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                
            });
        });

        function tambah_data(){
            $('#modal-tambah').modal('show');
        }

        function cek_qrcode(id){
			$.ajax({
				type: 'GET',
				url: "{{url('Karyawan/cek_qrcode')}}",
				data: "nik_ktp="+id,
				success: function(msg){
					$('#modal-qrcode').modal('show');
					$('#tampil_qrcode').html(msg);
				}
			});
			
		}

        function ubah(id){
			$.ajax({
				type: 'GET',
				url: "{{url('Karyawan/ubah')}}",
				data: "nik_ktp="+id,
				success: function(msg){
					$('#modal-ubah').modal('show');
					$('#tampil_ubah').html(msg);
				}
			});
			
		}

        function cekktp(evt,a) {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57)){
                return false;
            }else{
                panjang = a.length;
                if(panjang>15){
                    $('#notifktp').html("");
                    return false;
                    
                }else{
                    $('#notifktp').html('Maximal 16 Karakter');
                    return true;
                }
                
                
                
            }
        }

        function save_data(){
            var form=document.getElementById('mycreate');
            var token= "{{csrf_token()}}";
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Karyawan')}}?_token="+token,
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
						document.getElementById("loadnya").style.width = "100%";
					},
                    success: function(msg){
                        if(msg=='ok'){
                            location.reload();
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#modal-notifikasi').modal('show');
                            $('#isi-notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        }
        function update_data(){
            var form=document.getElementById('myupdate');
            var token= "{{csrf_token()}}";
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Karyawan/update')}}?_token="+token,
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
						document.getElementById("loadnya").style.width = "100%";
					},
                    success: function(msg){
                        if(msg=='ok'){
                            location.reload();
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#modal-notifikasi').modal('show');
                            $('#isi-notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        }
    </script>

@endpush