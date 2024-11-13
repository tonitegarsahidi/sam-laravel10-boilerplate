@extends('admin/template-base')

@section('page-title', 'List of User\'s Subscription')

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
                    @if (isset($userId))
                    <h4 class="card-header">Subscription for User {{ $userId }} <a class="" href="{{ route('subscription.user.index') }}">
                       <small> (See for all User)</small>
                    </a></h4>

                    @else
                    <h3 class="card-header">List of User Subscription</h3>
                    @endif
                </div>
                <div class="p-2">
                    <a class="btn btn-primary" href="{{ route('subscription.user.add') }}">
                        <span class="tf-icons bx bx-plus"></span>&nbsp;
                        Add New Subscription
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
                            placeholder="Search email, package name, and date..."
                            aria-label="Search id, alias, name, description, price..." name="keyword"
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

            <!-- Notification element -->
            @if ($errors->any() || session('loginError'))
            <div class="alert alert-danger" role="alert">
                <ul>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @endif
                    @if (session('loginError'))
                        <li>{{ session('loginError') }}</li>
                    @endif
                </ul>
            </div>
        @endif

            <div class="table-responsive text-nowrap">
                <!-- Table data with Striped Rows -->
                <table class="table table-striped table-hover align-middle">

                    {{-- TABLE HEADER --}}
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                <a
                                    href="{{ route('subscription.user.index', [
                                        'sort_field' => 'email',
                                        'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'keyword' => $keyword,
                                    ]) }}">
                                    User
                                    @include('components.arrow-sort', [
                                        'field' => 'email',
                                        'sortField' => $sortField,
                                        'sortOrder' => $sortOrder,
                                    ])
                                </a>
                            </th>

                            <th>
                                <a
                                    href="{{ route('subscription.user.index', [
                                        'sort_field' => 'package_name',
                                        'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'keyword' => $keyword,
                                    ]) }}">
                                    Package Name
                                    @include('components.arrow-sort', [
                                        'field' => 'package_name',
                                        'sortField' => $sortField,
                                        'sortOrder' => $sortOrder,
                                    ])
                                </a>
                            </th>

                            <th>
                                <a
                                    href="{{ route('subscription.user.index', [
                                        'sort_field' => 'start_date',
                                        'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'keyword' => $keyword,
                                    ]) }}">
                                    Start Date
                                    @include('components.arrow-sort', [
                                        'field' => 'start_date',
                                        'sortField' => $sortField,
                                        'sortOrder' => $sortOrder,
                                    ])
                                </a>
                            </th>

                            <th>
                                <a
                                    href="{{ route('subscription.user.index', [
                                        'sort_field' => 'expired_date',
                                        'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'keyword' => $keyword,
                                    ]) }}">
                                    Expired Date
                                    @include('components.arrow-sort', [
                                        'field' => 'expired_date',
                                        'sortField' => $sortField,
                                        'sortOrder' => $sortOrder,
                                    ])
                                </a>
                            </th>

                            <th>
                                <a
                                    href="{{ route('subscription.user.index', [
                                        'sort_field' => 'is_suspended',
                                        'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'keyword' => $keyword,
                                    ]) }}">
                                    Is Suspended
                                    @include('components.arrow-sort', [
                                        'field' => 'is_suspended',
                                        'sortField' => $sortField,
                                        'sortOrder' => $sortOrder,
                                    ])
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
                        @foreach ($subscriptions as $subscription)
                            <tr>
                                <td>{{ $startNumber++ }}</td>
                                <td>
                                    <a href="{{ route('admin.user.detail', $subscription->userId) }}" target="_blank">
                                        {{ $subscription->email }}
                                    </a>
                                </td>
                                {{-- <td>{{ $subscription->user->name }}</td> --}}
                                <td>{{ $subscription->package }}</td>
                                <td>{{ $subscription->start_date }}</td>
                                <td>{{ is_null($subscription->expired_date) ? config('saas.EXPIRED_DATE_NULL') : $subscription->expired_date }}
                                    @if ($subscription->isExpired())
                                        <span class="badge rounded-pill bg-danger"> Expired </span>
                                    @else
                                        <span class="badge rounded-pill bg-success"> Active </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($subscription->is_suspended)
                                        <span class="badge rounded-pill bg-danger"> Yes </span>
                                    @else
                                        <span class="badge rounded-pill bg-success"> No </span>
                                    @endif
                                </td>

                                {{-- ============ CRUD LINK ICON =============  --}}
                                <td>
                                    <a class="action-icon"
                                        href="{{ route('subscription.user.detail', ['id' => $subscription->id]) }}"
                                        title="detail">
                                        <i class='bx bx-search'></i>
                                    </a>
                                </td>
                                {{-- =========== UNSUBSCRIBE OR NOT BASED ON IS EXPIRED OR NOT ============ --}}
                                <td>
                                    @if (!$subscription->isExpired())
                                        <a class="action-icon"
                                            href="{{ route('subscription.user.unsubscribe', ['id' => $subscription->id]) }}"
                                            title="Unsubscribe">
                                            <i class='bx bx-trash'></i>
                                        </a>
                                    @else
                                        <a class="action-icon"
                                            href="{{ route('subscription.user.add', ['user' => $subscription->userId, "package" => $subscription->packageId]) }}"
                                            title="Top Up Subscription">
                                            <i class='bx bxs-plus-square'></i>
                                        </a>
                                    @endif

                                </td>
                                <td>
                                    @if ($subscription->is_suspended)
                                        <a class="action-icon"
                                            href="{{ route('subscription.user.unsuspend', ['id' => $subscription->id]) }}"
                                            title="unsuspend">
                                            <i class='bx bx-play-circle'></i>
                                        </a>
                                    @else
                                        <a class="action-icon"
                                            href="{{ route('subscription.user.suspend', ['id' => $subscription->id]) }}"
                                            title="suspend">
                                            <i class='bx bx-pause-circle'></i>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br />
                <br />

                <div class="row">
                    <div class="col-md-10 mx-auto">
                        {{ $subscriptions->onEachSide(5)->links('admin.components.paginator.default') }}
                    </div>
                </div>








            </div>
        </div>

    </div>
@endsection
