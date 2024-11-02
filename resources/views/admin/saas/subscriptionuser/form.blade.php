@extends('admin.template-base', ['searchNavbar' => false])

@section('page-title', 'Bella - User')

@section('main-content')

<div class="container-xxl flex-grow-1 container-p-y">
    
    @include('admin.components.breadcrumb.simple', $breadcrumb)

    <x-alert></x-alert>
    
    <div class="card">
        <div class="card-body">
            <form id="form-user" method="POST" action="{{ $mode == 'add'? route('admin-user-store') : ($mode == 'edit' ? route('admin-user-update', ['id' => $data->id]) : '/')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <div class="mb-3 col-12">
                  <label for="name" class="form-label">Name</label>
                  <input
                    class="form-control"
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Name"
                    value="{{old('name', $data->name)}}"
                    {{ $mode == 'view' ? 'readonly' : '' }}
                  />
                </div>
                <div class="mb-3 col-12">
                  <label for="email" class="form-label">Email</label>
                  <input
                    class="form-control"
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Email"
                    value="{{old('email', $data->email)}}"
                    {{ $mode == 'view' ? 'readonly' : '' }}
                  />
                </div>
                @if ($mode != 'view')
                <div class="mb-3 col-12" id="form_pass_code">
                  <label class="form-label" for="password">Passwrod</label>
                  <div class="form-password-toggle">
                    <div class="input-group">
                      <input name="password" type="password" class="form-control" id="password" placeholder="············" aria-describedby="password" {{$mode == "edit" && $data->password != null ? 'readonly': ''}}>
                      <span id="password" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      @if ($mode == "edit" && $data->password != null)
                      <button id="button-edit-password" class="btn btn-primary" type="button">
                        <i class="tf-icons bx bx-pencil me-2"></i>
                        Ubah
                      </button>
                      @endif
                    </div>
                  </div>
                  @if ($mode == "edit" && $data->password != null)
                  <div id="floatingInputHelp" class="form-text text-danger">Kosongi jika tidak ada perubahan</div>
                  @endif
                </div>
                <div class="mb-3 col-12">
                    <label class="form-label" for="is_active">Is Active</label>
                    <div class="form-check">
                      <input name="is_active" class="form-check-input" type="radio" value="1" id="is_active_1" {{old('is_active', $data->is_active) == 1 ? "checked" : ""}}>
                      <label class="form-check-label" for="is_active_1">
                        Active
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="is_active" class="form-check-input" type="radio" value="0" id="is_active_2" {{old('is_active', $data->is_active) == 0 ? "checked" : ""}}>
                      <label class="form-check-label" for="is_active_2">
                        In Active
                      </label>
                    </div>
                </div>                
                @endif
                @if ($mode == 'view')
                <div class="mb-3 col-12">
                  <label for="is_active" class="form-label">Is Active</label>
                  <input
                    class="form-control"
                    type="text"
                    id="is_active"
                    name="is_active"
                    placeholder="Is Active"
                    value="{{$data->is_active == 1 ? 'Active' : 'Inactive'}}"
                    readonly
                  />
                </div>
                @endif
                <div class="mb-3 col-12">
                  <label for="roles" class="form-label">Roles</label>
                  @foreach ($roles as $key => $role)
                  <div class="form-check {{$key != 0 ? 'mt-3' : ''}}">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{$role->id}}" id="{{"role_".$role->id}}" 
                    {{$role->role_code == "ROLE_USER" ? "checked disabled" : ''}}
                    {{$mode == "view" ? "disabled" : ''}}
                    {{in_array($role->id, $data->listIdRole()->toArray()) ? "checked" : ''}}
                    >
                    <label class="form-check-label" for="{{$role->id}}">
                      {{$role->role_name}} 
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="">
                <a href="{{route('admin-user')}}" class="btn btn-outline-secondary me-2"><i class="tf-icons bx bx-left-arrow-alt me-2"></i>Back</a>
                @if ($mode != 'view')
                <button type="submit" class="btn btn-primary me-2"><i class="tf-icons bx bx-save me-2"></i>Save</button>
                @endif
                @if ($mode == 'view')
                <a class="btn btn-primary me-2" href="{{ route('admin-user-edit', ['id' => $data->id]) }}" title="update"><i class='tf-icons bx bx-pencil me-2'></i>Edit</a>                   
                <a class="btn btn-danger me-2" href="{{ route('admin-user-delete', ['id' => $data->id]) }}" title="delete"><i class='tf-icons bx bx-trash me-2'></i>Delete</a>                   
                @endif
              </div>
            </form>
        </div>        
    </div>
</div>
<script src="{{ asset('assets/js/sambel/form-user.js') }}"></script>
@endsection
