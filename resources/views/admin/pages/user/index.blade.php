@extends('admin/template-base')


@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @include('admin.components.breadcrumb.simple', $breadcrumb)

        <!-- Striped Rows -->
        <div class="card">
            <h3 class="card-header">List of User</h3>
            <div>
                <form action="{{ url()->full() }}" method="get">
                    <label for="per_page">Show:</label>
                    <select id="per_page" name="per_page" onchange="this.form.submit()">
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                        <option value="250" {{ $perPage == 250 ? 'selected' : '' }}>250</option>
                        <option value="500" {{ $perPage == 500 ? 'selected' : '' }}>500</option>
                    </select>
                    <input type="hidden" name="sort_order" value="{{ request()->input('sort_order') }}" />
                    <input type="hidden" name="sort_field" value="{{ request()->input('sort_field') }}" />
                </form>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                <a
                                    href="{{ route('admin-user.index', ['sort_field' => 'name', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                    Name
                                </a>
                            </th>
                            <th>
                                <a
                                    href="{{ route('admin-user.index', ['sort_field' => 'email', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                    Email
                                </a>
                            </th>
                            <th><a
                                    href="{{ route('admin-user.index', ['sort_field' => 'is_active', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                    Is Active
                                </a></th>
                            <th>Roles</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $startNumber = ($perPage * ($page-1)) + 1;
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $startNumber++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->is_active)
                                        <span class="badge rounded-pill bg-success"> Yes </span>
                                    @else
                                        <span class="badge rounded-pill bg-danger"> No </span>
                                    @endif
                                </td>
                                <td>

                                    @foreach ($user->listRoles() as $role)
                                        @if (strcasecmp($role, 'ADMINISTRATOR') == 0)
                                            <span class="badge rounded-pill bg-label-danger"> {{ $role }} </span>
                                        @else
                                            <span class="badge rounded-pill bg-label-primary"> {{ $role }} </span>
                                        @endif
                                    @endforeach

                                </td>

                                {{-- ============ CRUD LINK ICON =============  --}}
                                <td>
                                    <a class="action-icon" href="{{ route('admin-user-detail', ['id' => $user->id]) }}"
                                        title="detail">
                                        <i class='bx bx-search'></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="action-icon" href="{{ route('admin-user-edit', ['id' => $user->id]) }}"
                                        title="edit">
                                        <i class='bx bx-pencil'></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="action-icon" href="{{ route('admin-user-delete', ['id' => $user->id]) }}"
                                        title="delete">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br />
                <br />

                <div class="row">
                    <div class="col-md-10 mx-auto">
                        {{ $users->onEachSide(5)->links('admin.components.paginator.default') }}
                    </div>
                </div>








            </div>
        </div>

    </div>
@endsection
