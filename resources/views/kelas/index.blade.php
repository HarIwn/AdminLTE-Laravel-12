@extends('templates/header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Kelas
    <small>SMK Negeri 1 Cianjur</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Kelas</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  @include('templates/feedback')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <a href="{{ url('kelas/add') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah </a>
    </div>

    <div class="box-body">
      <table class="table table-striped"> <!-- Corrected class name -->
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kelas</th>
            <th>Jurusan</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($result as $row)
            <tr>
              <td>{{ !empty($i) ? ++$i : $i = 1 }}</td>
              <td>{{ $row->nama_kelas }}</td>
              <td>{{ $row->jurusan }}</td>
              <td> <!-- Moved <td> inside the <tr> -->
                <a href="{{ url("kelas/$row->id_kelas/edit") }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                <form action="{{ url("kelas/$row->id_kelas") }}" method="POST" style="display: inline;">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="box-footer">
      Footer
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

@endsection