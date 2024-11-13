@extends('admin.template-base', ['searchNavbar' => false])

@section('page-title', 'Confirm Delete User')

{{-- MAIN CONTENT PART --}}
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- FOR BREADCRUMBS --}}
        @include('admin.components.breadcrumb.simple', $breadcrumbs)

        {{-- MAIN PARTS --}}

        <div class="card">

            {{-- FIRST ROW,  FOR TITLE AND ADD BUTTON --}}
            <div class="d-flex justify-content-between">

                <div class="bd-highlight">
                    <h3 class="card-header">Are you sure want to delete this User?</h3>
                </div>

            </div>



            {{-- ROW FOR ADDITIONAL FUNCTIONALITY BUTTON --}}
            <div class="m-4">

                <form action="{{ route('admin.user.delete', $data->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a onclick="goBack()" class="btn btn-outline-secondary me-2"><i
                        class="tf-icons bx bx-left-arrow-alt me-2"></i>Back</a>

                    <button type="submit" class="btn btn-danger me-2" href="{{ route('admin.user.edit', ['id' => $data->id]) }}"
                        title="delete user">
                        <i class='tf-icons bx bx-trash me-2'></i>Confirm Delete
                    </button>
                </form>
            </div>

            {{-- DETAIL OF THE DATA WHICH WANT TO BE DELETED --}}
            <div class="row m-2">

                <div class="col-md-8 col-xs-12">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Name</th>
                                    <td>{{ $data->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Email</th>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Phone Number</th>
                                    <td>{{ $data->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Is Active</th>
                                    <td>
                                        @if ($data->is_active)
                                            <span class="badge rounded-pill bg-success"> Yes </span>
                                        @else
                                            <span class="badge rounded-pill bg-danger"> No </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Role</th>
                                    <td>
                                        @foreach ($data->listRoles() as $role)
                                            @if (strcasecmp($role, 'ADMINISTRATOR') == 0)
                                                <span class="badge rounded-pill bg-label-danger m-1"> {{ $role }}
                                                </span>
                                            @else
                                                <span class="badge rounded-pill bg-label-primary m-1"> {{ $role }}
                                                </span>
                                            @endif
                                            <br/>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        @if (config('constant.CRUD.DISPLAY_TIMESTAMPS'))
                            @include('components.crud-timestamps', $data)
                        @endif
                    </div>

                </div>

            </div>



        </div>
    </div>

@endsection

@section('footer-code')

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

@endsection
