@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection

<style>
    .ibox .label {
        font-size: 12px !important;
    }
</style>

@section('content')

    <div class="wrapper wrapper-content text-center">

        <div class="row">
            <div class="col-md-12">
                <div class="widget lazur-bg col-md-3">
                    <h1 class="m-xs">{{ $totalRestaurants }}</h1>
                    <h3 class="font-bold no-margins">
                        Total Restaurant
                    </h3>
                </div>
                <div class="widget red-bg p-lg col-3">
                    <h1 class="m-xs">{{ $totalCustomers }}</h1>
                    <h3 class="font-bold no-margins">
                        Total Customer
                    </h3>
                </div>
                <div class="widget lazur-bg col-md-3">
                    <h1 class="m-xs">{{ $totalRiders }}</h1>
                    <h3 class="font-bold no-margins">
                        Total Riders
                    </h3>
                </div>
                <div class="widget red-bg p-lg text-center col-md-3">
                    <h1 class="m-xs">{{ $totalOrders }}</h1>
                    <h3 class="font-bold no-margins">
                        Total Orders
                    </h3>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Order list</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content table-responsive">
                        <table class="table table-hover no-margins">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Restaurant</th>
                                <th>Rider</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td class="label-inverse">{{ ucfirst(str_replace('_',' ',$order->order_status)) }}</td>
                                <td>{{ $order->customer->phone_number }}</td>
                                <td>{{ $order->restaurant->phone_number }}</td>
                                <td>{{ isset($order->rider->phone_number) ? $order->rider->phone_number : "NA" }}</td>
                            </tr>
                            @empty
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>User Registered</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content table-responsive">
                        <table class="table table-hover no-margins">
                            <thead>
                            <tr>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <td>{{ $customer->phone_number }}</td>
                                    <td class="label-info">{{ 'Customer' }}</td>
                                    <td>{{ date('Y-m-d',strtotime($customer->created_at))  }}</td>
                                </tr>
                            @empty
                            @endforelse
                            @forelse($restaurants as $restaurant)
                                <tr>
                                    <td>{{ $restaurant->phone_number }}</td>
                                    <td class="label-warning">{{ 'Restaurant' }}</td>
                                    <td>{{ date('Y-m-d',strtotime($restaurant->created_at))  }}</td>
                                </tr>
                            @empty
                            @endforelse
                            @forelse($riders as $rider)
                                <tr>
                                    <td>{{ $rider->phone_number }}</td>
                                    <td class="label-primary">{{ 'Rider' }}</td>
                                    <td>{{ date('Y-m-d',strtotime($rider->created_at))  }}</td>
                                </tr>
                            @empty
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('e180952788257a84af69', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            //alert(JSON.stringify(data));
            location.reload();
        });
    </script>

{{--    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>--}}
{{--    <script>--}}

{{--        $(document).ready( function () {--}}
{{--            initFirebaseMessagingRegistration();--}}
{{--        });--}}

{{--        var firebaseConfig = {--}}
{{--            apiKey: "AIzaSyAlwdt-UxYXtJ9mc4KCN5B6ylI9uykO03o",--}}
{{--            authDomain: "ddweb-9f5ff.firebaseapp.com",--}}
{{--            databaseURL: "https://ddweb-9f5ff.firebaseio.com",--}}
{{--            projectId: "ddweb-9f5ff",--}}
{{--            storageBucket: "ddweb-9f5ff.appspot.com",--}}
{{--            messagingSenderId: "73865503844",--}}
{{--            appId: "1:73865503844:web:9e7c94d0c44c6ef3726b71",--}}
{{--            measurementId: "G-ZZRY3NP782"--}}
{{--        };--}}

{{--        firebase.initializeApp(firebaseConfig);--}}
{{--        const messaging = firebase.messaging();--}}

{{--        function initFirebaseMessagingRegistration() {--}}
{{--            messaging--}}
{{--                .requestPermission()--}}
{{--                .then(function () {--}}
{{--                    return messaging.getToken()--}}
{{--                })--}}
{{--                .then(function(token) {--}}
{{--                    console.log(token);--}}

{{--                    $.ajaxSetup({--}}
{{--                        headers: {--}}
{{--                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                        }--}}
{{--                    });--}}

{{--                    $.ajax({--}}
{{--                        url: '{{ route("admin.save-token") }}',--}}
{{--                        type: 'POST',--}}
{{--                        data: {--}}
{{--                            token: token--}}
{{--                        },--}}
{{--                        dataType: 'JSON',--}}
{{--                        success: function (response) {--}}
{{--                            //alert('Token saved successfully.');--}}
{{--                        },--}}
{{--                        error: function (err) {--}}
{{--                            console.log('User Chat Token Error'+ err);--}}
{{--                        },--}}
{{--                    });--}}

{{--                }).catch(function (err) {--}}
{{--                console.log('User Chat Token Error'+ err);--}}
{{--            });--}}
{{--        }--}}

{{--        messaging.onMessage(function(payload) {--}}
{{--            const noteTitle = payload.notification.title;--}}
{{--            const noteOptions = {--}}
{{--                body: payload.notification.body,--}}
{{--                icon: payload.notification.icon,--}}
{{--            };--}}
{{--            new Notification(noteTitle, noteOptions);--}}
{{--        });--}}

{{--    </script>--}}
@endpush
