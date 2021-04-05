@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection

<style>
    .ibox .label {
        font-size: 12px !important;
    }
</style>

@section('content')

    <div class="wrapper wrapper-content dashboard">

        <div class="row header_part">
            <div class="col-12 col-md-6">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/10dashboard32.png')}}" width="36" height="36" /> Dashboard</h1>
            </div>

            <hr>

            <div class="col-12 col-md-6 text-center">
                <div class="row">
                    <div class="widget col-3">
                        <div class="lazur-bg">
                            <h1 class="m-xs">{{ $totalRestaurants }}</h1>
                            <h4 class="font-bold no-margins">
                                Total Restaurant
                            </h4>
                        </div>
                    </div>
                    <div class="widget col-3">
                        <div class="red-bg">
                            <h1 class="m-xs">{{ $totalCustomers }}</h1>
                            <h4 class="font-bold no-margins">
                                Total Customer
                            </h4>
                        </div>
                    </div>
                    <div class="widget col-3">
                        <div class="lazur-bg">
                            <h1 class="m-xs">{{ $totalRiders }}</h1>
                            <h4 class="font-bold no-margins">
                                Total Riders
                            </h4>
                        </div>
                    </div>
                    <div class="widget col-3">
                        <div class="red-bg">
                            <h1 class="m-xs">{{ $totalOrders }}</h1>
                            <h4 class="font-bold no-margins">
                                Total Orders
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row table_part">

            <div class="col-md-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Order list</h5>
                        <!-- <div class="ibox-tools">
                            <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                            <a class="close-link"> <i class="fa fa-times"></i> </a>
                        </div> -->
                    </div>
                    <div class="ibox-content table-responsive">
                        <table class="table table-hover no-margins">
                            <thead>
                            <tr>
                                <th>Order#</th>
                                <th>Date Time</th>
                                <th class="text-center">Status</th>
                                <th>Detail</th>
                                <th>Rider</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td><a href="{{route('orders.view',['id'=>$order->id])}}">{{ $order->id}}</a></td>
                                <td>{{ $order->order_date}}</td>
                                <td class="label-inverse text-center">{{ ucfirst(str_replace('_',' ',$order->order_status)) }}</td>
                                <td><a href="{{route('customers.view',['id'=>$order->customer_id])}}">{{ $order->customer->name }}</a> ordered from <a href="{{route('restaurants.view',['id'=>$order->restaurant_id])}}">{{ $order->restaurant->name }}</a></td>
                                @if(isset($order->rider->phone_number))
                                    <td><a href="{{route('riders.view',['id'=>$order->rider_id])}}">{{ isset($order->rider->phone_number) ? $order->rider->name : "-" }}</a></td>
                                @else
                                    <td>-</td>
                                @endif
                            </tr>
                            @empty
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>User Registered</h5>
                        <!-- <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div> -->
                    </div>
                    <div class="ibox-content table-responsive">
                        <table class="table table-hover no-margins">
                            <thead>
                            <tr>
                                <th>Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <td>An User <a href="{{route('customers.view',['id'=>$customer->id])}}">{{ $customer->name }}</a>  Registered, {{ $customer->phone_number }}, {{ getAddress($customer->id, 'customer') }}</td>
                                </tr>
                            @empty
                            @endforelse
                            @forelse($restaurants as $restaurant)
                                <tr>
                                    <td>An User <a href="{{route('restaurants.view',['id'=>$restaurant->id])}}">{{ $restaurant->name }}</a> Registered, {{ $restaurant->phone_number }}, {{ getAddress($restaurant->id, 'restaurant') }}</td>
                                </tr>
                            @empty
                            @endforelse
                            @forelse($riders as $rider)
                                <tr>
                                    <td>An User <a href="{{route('riders.view',['id'=>$rider->id])}}">{{ $rider->name }}</a> Registered, {{ $rider->phone_number }}, {{ getAddress($rider->id, 'rider') }}</td>
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
