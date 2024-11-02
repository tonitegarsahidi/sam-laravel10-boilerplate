@extends('admin/template-base')

@section('page-title', 'List of Packages')

{{-- MAIN CONTENT PART --}}
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- FOR BREADCRUMBS --}}
        @include('admin.components.breadcrumb.simple', $breadcrumbs)

        {{-- MAIN PARTS --}}

        <div class="card">

            {{-- FIRST ROW,  FOR TITLE AND ADD BUTTON --}}
            <div class="d-flex justify-content-between">

                <div class="p-2 bd-highlight">
                    <h3 class="card-header">List of Package</h3>
                </div>
                <div class="p-2">
                    <a class="btn btn-primary" href="{{ route('subscription.packages.add') }}">
                        <span class="tf-icons bx bx-plus"></span>&nbsp;
                        Add New Package
                    </a>
                </div>

            </div>

            {{-- SECOND ROW,  FOR DISPLAY PER PAGE AND SEARCH FORM --}}
            <div class="d-flex justify-content-between">

                {{-- OPTION TO SHOW LIST PER PAGE --}}
                <div class="p-2 bd-highlight">
                    @include('admin.components.paginator.perpageform')
                </div>

                {{-- SEARCH FORMS --}}
                <div class="p-2 d-flex align-items-center">
                    <form action="{{ url()->full() }}" method="get" class="d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" class="form-control border-1 shadow-none bg-light bg-gradient"
                            placeholder="Search id, alias, name, description, price.." aria-label="Search id, alias, name, description, price..." name="keyword"
                            value="{{ isset($keyword) ? $keyword : '' }}" />
                        <input type="hidden" name="sort_order" value="{{ request()->input('sort_order') }}" />
                        <input type="hidden" name="sort_field" value="{{ request()->input('sort_field') }}" />
                        <input type="hidden" name="per_page" value="{{ request()->input('per_page') }}" />
                    </form>
                </div>

            </div>

            {{-- THIRD ROW, FOR THE MAIN DATA PART --}}
            {{-- //to display any error if any --}}
            @if (isset($alerts))
                @include('admin.components.notification.general', $alerts)
            @endif

            <div class="table-responsive text-nowrap">
                <!-- Table data with Striped Rows -->
                <table class="table table-striped table-hover align-middle">

                    {{-- TABLE HEADER --}}
                    <thead>
                        <tr>
                            <th>
                                No
                            </th>
                            <th>
                                <a
                                    href="{{ route('subscription.packages.index', [
                                        'sort_field' => 'id',
                                        'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'keyword' => $keyword,
                                    ]) }}">
                                    Id
                                </a>
                            </th>
                            <th>
                                <a
                                    href="{{ route('subscription.packages.index', [
                                        'sort_field' => 'alias',
                                        'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'keyword' => $keyword,
                                    ]) }}">
                                    Alias
                                </a>
                            </th>

                            <th>
                                <a
                                    href="{{ route('subscription.packages.index', [
                                        'sort_field' => 'package_name',
                                        'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'keyword' => $keyword,
                                    ]) }}">
                                    Package Name
                                </a>
                            </th>
                            <th>
                                <a
                                    href="{{ route('subscription.packages.index', [
                                        'sort_field' => 'package_description',
                                        'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'keyword' => $keyword,
                                    ]) }}">
                                    Package Description
                                </a>
                            </th>
                            <th><a
                                    href="{{ route('subscription.packages.index', [
                                            'sort_field' => 'is_active',
                                            'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'keyword' => $keyword
                                        ]) }}">
                                    Is Active
                                </a></th>
                            <th>
                                <a
                                    href="{{ route('subscription.packages.index', [
                                        'sort_field' => 'package_price',
                                        'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'keyword' => $keyword,
                                    ]) }}">
                                    Price ({{config('saas.CURRENCY_SYMBOL')}})
                                </a>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>


                    <tbody>
                        @php
                            $startNumber = $perPage * ($page - 1) + 1;
                        @endphp
                        @foreach ($packages as $package)
                            <tr>
                                <td>{{ $startNumber++ }}</td>
                                <td>{{ $package->id }}</td>
                                <td>{{ $package->alias }}</td>
                                <td>{{ $package->package_name }}</td>
                                <td>{{ $package->package_description }}</td>
                                <td>
                                    @if ($package->is_active)
                                        <span class="badge rounded-pill bg-success"> Yes </span>
                                    @else
                                        <span class="badge rounded-pill bg-danger"> No </span>
                                    @endif
                                </td>
                                <td class="text-end">{{$package->package_price}}</td>


                                {{-- ============ CRUD LINK ICON =============  --}}
                                <td>
                                    <a class="action-icon" href="{{ route('subscription.packages.detail', ['id' => $package->id]) }}"
                                        title="detail">
                                        <i class='bx bx-search'></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="action-icon" href="{{ route('subscription.packages.edit', ['id' => $package->id]) }}"
                                        title="edit">
                                        <i class='bx bx-pencil'></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="action-icon" href="{{ route('subscription.packages.delete', ['id' => $package->id]) }}"
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
                        {{ $packages->onEachSide(5)->links('admin.components.paginator.default') }}
                    </div>
                </div>








            </div>
        </div>

    </div>
@endsection
