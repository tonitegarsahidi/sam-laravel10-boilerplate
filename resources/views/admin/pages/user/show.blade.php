@extends('admin.template-base', ['searchNavbar' => false])

@section('page-title', 'Bella - User')

@section('main-content')

<div class="container-xxl flex-grow-1 container-p-y">
    
    @include('admin.components.breadcrumb.simple', $breadcrumb)

    <x-alert></x-alert>
    
    <div class="card">
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th scope="col" class="bg-secondary text-white">Name</th>
                  <td>{{ $data->name }}</td>
                </tr>
                <tr>
                  <th scope="col" class="bg-secondary text-white">Email</th>
                  <td>{{ $data->email }}</td>
                </tr>
                <tr>
                  <th scope="col" class="bg-secondary text-white">Is Active</th>
                  <td>
                      @if ($data->is_active)
                          <span class="badge rounded-pill bg-success"> Yes </span>
                      @else
                          <span class="badge rounded-pill bg-danger"> No </span>
                      @endif
                  </td>
                </tr>
                <tr>
                    <th scope="col" class="bg-secondary text-white">Role</th>
                    <td>
                        @foreach ($data->listRoles() as $role)
                            <span class="badge rounded-pill bg-label-danger"> {{ $role }} </span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                  <th scope="col" class="bg-secondary text-white">Created At</th>
                  <td>{{ $data->created_at->isoFormat('dddd, D MMMM Y - HH:mm:ss') }}</td>
                </tr>
                <tr>
                  <th scope="col" class="bg-secondary text-white">Updated At</th>
                  <td>{{ $data->updated_at->isoFormat('dddd, D MMMM Y - HH:mm:ss') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="mt-3">
            <a href="{{route('admin-user')}}" class="btn btn-outline-secondary me-2"><i class="tf-icons bx bx-left-arrow-alt me-2"></i>Back</a>
            <a class="btn btn-primary me-2" href="{{ route('admin-user-edit', ['id' => $data->id]) }}" title="update"><i class='tf-icons bx bx-pencil me-2'></i>Edit</a>                   
            <a class="btn btn-danger me-2 delete-user-button" href="javascript:void(0);" title="delete" data-route="{{ route('admin-user-delete', ['id' => $data->id]) }}" data-title="{{count($data->projects) > 0 ? ($data->is_active == 0 ? 'User tidak dapat dihapus' : 'Nonaktifkan User?'): 'Hapus data User?'}}" data-text="{{count($data->projects) > 0 ? 'User masih memiliki project': 'Data user akan dihapus permanen'}}" data-icon="{{(count($data->projects) > 0 && $data->is_active == 0) ? 'info': 'warning'}}"><i class='tf-icons bx bx-trash me-2'></i>Delete</a>
          </div>
        </div>        
    </div>
</div>
<script src="{{ asset('assets/js/sambel/form-user.js') }}"></script>
<script src="{{asset('assets/js/sambel/helper-button.js')}}"></script>
@endsection
