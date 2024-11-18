@extends('admin/template-base')

@section('page-title', 'Add Subscription - Select User')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @include('admin.components.breadcrumb.simple', $breadcrumbs)

        @if ($userIsSet)
            Hello Samtoni
        @else
            {{-- MAIN PARTS --}}


            <div class="card">



                {{-- FIRST ROW,  FOR TITLE AND ADD BUTTON --}}
                <div class="d-flex justify-content-between">

                    <div class="p-2 bd-highlight">
                        <h3 class="card-header">Selects Users to be Subscribed</h3>
                    </div>

                </div>

                {{-- SECOND ROW,  FOR DISPLAY PER PAGE AND SEARCH FORM --}}
                <div class="d-flex justify-content-between">

                    {{-- SEARCH FORMS --}}
                    <div class="p-2 d-flex align-items-center">
                        <form action="{{ url()->full() }}" method="get" class="d-flex align-items-center">
                            <input type="text"
                                class="form-control form-control-lg input-lg form-lg border-1 shadow-none bg-light bg-gradient"
                                placeholder="Search name or email.." aria-label="Search name or email..." name="keyword"
                                value="{{ isset($keyword) ? $keyword : '' }}" />
                            <input type="hidden" name="sort_order" value="{{ request()->input('sort_order') }}" />
                            <input type="hidden" name="sort_field" value="{{ request()->input('sort_field') }}" />
                            <input type="hidden" name="per_page" value="{{ request()->input('per_page') }}" />

                            &nbsp;
                            <button type="submit" class="btn btn-primary btn-lg" value="">
                                Search
                            </button>
                        </form>

                    </div>
                    <br/><br/>
                </div>

                {{-- THIRD ROW, FOR THE MAIN DATA PART --}}

                @if (!is_null($keyword))
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
                                            href="{{ route('subscription.user.add', [
                                                'sort_field' => 'name',
                                                'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                                'keyword' => $keyword,
                                            ]) }}">
                                            Name
                                            @include('components.arrow-sort', [
                                                'field' => 'name',
                                                'sortField' => $sortField,
                                                'sortOrder' => $sortOrder,
                                            ])
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('subscription.user.add', [
                                                'sort_field' => 'email',
                                                'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                                'keyword' => $keyword,
                                            ]) }}">
                                            Email
                                            @include('components.arrow-sort', [
                                                'field' => 'email',
                                                'sortField' => $sortField,
                                                'sortOrder' => $sortOrder,
                                            ])
                                        </a>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>


                            <tbody>
                                @php
                                    $startNumber = $perPage * ($page - 1) + 1;
                                @endphp
                                @foreach ($findUsers as $user)
                                    <tr>
                                        <td>{{ $startNumber++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        {{-- ============ CRUD LINK ICON =============  --}}
                                        <td>
                                            <a class="action-icon btn btn-primary btn-sm text-white btn-condensed"
                                                href="{{ route('subscription.user.add', ['user' => $user->id]) }}"
                                                title="detail">
                                                <i class='bx bx-plus'></i>
                                                <strong>Subscribe</strong>
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
                                {{ $findUsers->onEachSide(5)->links('admin.components.paginator.default') }}
                            </div>
                        </div>

                    </div>
                @endif


            </div>
        @endif


    </div>
@endsection
