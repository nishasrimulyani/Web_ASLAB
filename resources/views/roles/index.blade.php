@extends('layouts.admin')

@section('main-content')
    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Role</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                    <form action="{{ route('roles.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('roles.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('roles.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama role">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">No</th>
                                <th scope="col" style="width: 15%">Nama Role</th>
                                <th scope="col">Permissions</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $no => $role)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($roles->currentPage()-1) * $roles->perPage() }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->getPermissionNames() as $permission)
                                            <button class="btn btn-sm btn-success mb-1 mt-1 mr-1">{{ $permission }}</button>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @can('roles.edit')
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        
                                        @can('roles.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $role->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
@endsection