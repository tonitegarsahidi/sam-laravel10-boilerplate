@extends('admin.template-base', ['searchNavbar' => false])

@section('page-title', 'Detail of User Subscription')

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
                    <h3 class="card-header">Detail of Subscription with id : {{ $data->id }}</h3>
                </div>

            </div>

            <div class="row m-2">

                <div class="col-md-8 col-xs-12">

                    @if (isset($alerts))
                        @include('admin.components.notification.general', $alerts)
                    @endif

                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Subscriber Name</th>
                                    <td>{{ $data->user->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Email</th>
                                    <td>{{ $data->user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Package Detail</th>
                                    <td>{{ $data->package->package_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Start Date</th>
                                    <td>{{ $data->start_date->isoFormat(config('constant.DATE_FORMAT.LONG')) }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Expired Date</th>
                                    <td> {{ is_null($data->expired_date) ? config('saas.EXPIRED_DATE_NULL') : $data->expired_date->isoFormat(config('constant.DATE_FORMAT.LONG')) }}
                                        @if (is_null($data->expired_date) || $data->expired_date > now())
                                            <span class="badge rounded-pill bg-success"> Active </span>
                                        @else
                                            <span class="badge rounded-pill bg-danger"> Expired </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Is Suspended</th>
                                    <td>
                                        @if ($data->is_suspended)
                                            <span class="badge rounded-pill bg-danger"> Yes </span>
                                        @else
                                            <span class="badge rounded-pill bg-success"> No </span>
                                        @endif
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





            {{-- ROW FOR ADDITIONAL FUNCTIONALITY BUTTON --}}
            <div class="m-4">
                <a onclick="goBack()" class="btn btn-outline-secondary me-2"><i
                        class="tf-icons bx bx-left-arrow-alt me-2"></i>Back</a>

                {{-- SUBS OR UNSUBS BUTTON --}}
                @if ($data->isExpired())
                    <a class="btn btn-primary me-2" href="{{ route('subscription.user.resubscribe', ['id' => $data->id]) }}"
                        title="update this user">
                        <i class='tf-icons bx bx-pencil me-2'></i>Resubscribe</a>
                @else
                    <a class="btn btn-primary me-2" href="{{ route('subscription.user.unsubscribe', ['id' => $data->id]) }}"
                        title="update this user">
                        <i class='tf-icons bx bx-trash me-2'></i>Unsubscribe</a>
                @endif

                {{-- SUSPEND or UNSUSPEND Button --}}
                @if (!$data->is_suspended)
                    <a class="btn btn-danger me-2" href="{{ route('subscription.user.suspend', ['id' => $data->id]) }}"
                        title="Suspend user">
                        <i class='tf-icons bx bx-pause me-2'></i>Suspend</a>
                @else
                    <a class="btn btn-success me-2" href="{{ route('subscription.user.unsuspend', ['id' => $data->id]) }}"
                        title="Unsuspend user">
                        <i class='tf-icons bx bx-play me-2'></i>Unsuspend</a>
                @endif

                {{-- NEW SUBSCRIPTION BUTTON --}}
                <a class="btn btn-success me-2" href="{{ route('subscription.user.add', ['user' => $data->user_id]) }}"
                    title="Suspend user">
                    <i class='tf-icons bx bx-plus me-2'></i>New Subscription</a>

            </div>


            {{-- SUBSCRIPTION HISTORY --}}

            <div class="row m-2">
                <div class="d-flex justify-content-between">

                    <div class="bd-highlight">
                        <h3 class="card-header">Subscription History</h3>
                    </div>

                </div>

                <div class="col-md-12 col-xs-12">
                    <div class="table-responsive text-nowrap">
                        @php
                            $startNumber = 1;
                        @endphp
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Price Snapshot ({{ config('saas.CURRENCY_SYMBOL') }})</th>
                                    <th class="text-center">Payment Reference</th>
                                    <th class="text-center">Created by</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->histories as $history)
                                    <tr>
                                        <td>{{ $startNumber++ }}</td>
                                        <td>{{ $history->created_at }}</td>
                                        <td>{{ config('saas.SUBSCRIPTION_HISTORY_ACTION')[$history->subscription_action] ?? 'Unknown Action' }}
                                        </td>
                                        <td class="text-end">
                                            {{ number_format($history->package_price_snapshot, 2, ',', '.') }}</td>
                                        <td>{{ is_null($history->payment_reference) ? 'N/A' : $history->payment_reference }}
                                        </td>
                                        <td>{{ $history->created_by }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <br />
                    <br />
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
