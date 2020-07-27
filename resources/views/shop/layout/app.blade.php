<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Shop Đồ Chơi |
        @yield('title')
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("asset/shop/css/open-iconic-bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/shop/css/animate.css") }}">

    <link rel="stylesheet" href="{{ asset("asset/shop/css/owl.carousel.min.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/shop/css/owl.theme.default.min.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/shop/css/magnific-popup.css") }}">

    <link rel="stylesheet" href="{{ asset("asset/shop/css/aos.css") }}">

    <link rel="stylesheet" href="{{ asset("asset/shop/css/ionicons.min.css") }}">

    <link rel="stylesheet" href="{{ asset("asset/shop/css/bootstrap-datepicker.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/shop/css/jquery.timepicker.css") }}">


    <link rel="stylesheet" href="{{ asset("asset/shop/css/flaticon.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/shop/css/icomoon.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/shop/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/shop/css/searchbox.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/shop/css/handle-counter.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/shop/css/custom.css") }}">
    <style>
        .invalid-feedback{
            display: block;
        }
    </style>
</head>
<body class="goto-here">

@include("shop.layout.header")

@yield("content")

@include("shop.layout.footer")

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center;font-size: 16px;font-weight: bold;">
                Đã thêm vào giỏ hàng.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tiếp tục</button>
                <a role="button" class="btn btn-secondary btn-primary" href="{{ route('cart.list') }}">Giỏ hàng</a>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset("asset/shop/js/jquery.min.js") }}"></script>
<script src="{{ asset("asset/shop/js/jquery-migrate-3.0.1.min.js") }}"></script>
<script src="{{ asset("asset/shop/js/popper.min.js") }}"></script>
<script src="{{ asset("asset/shop/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("asset/shop/js/jquery.easing.1.3.js") }}"></script>
<script src="{{ asset("asset/shop/js/jquery.waypoints.min.js") }}"></script>
<script src="{{ asset("asset/shop/js/jquery.stellar.min.js") }}"></script>
<script src="{{ asset("asset/shop/js/owl.carousel.min.js") }}"></script>
<script src="{{ asset("asset/shop/js/jquery.magnific-popup.min.js") }}"></script>
<script src="{{ asset("asset/shop/js/aos.js") }}"></script>
<script src="{{ asset("asset/shop/js/jquery.animateNumber.min.js") }}"></script>
<script src="{{ asset("asset/shop/js/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("asset/shop/js/scrollax.min.js") }}"></script>
<script src="{{ asset("asset/shop/js/handleCounter.js") }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="{{ asset("asset/shop/js/google-map.js") }}"></script>
<script src="{{ asset("asset/shop/js/main.js") }}"></script>
<script>
    $(function ($) {
        var options = {
            minimum: 1,
            maximize: 10,
            onChange: valChanged,
            onMinimum: function(e) {
                console.log('reached minimum: '+e)
            },
            onMaximize: function(e) {
                console.log('reached maximize'+e)
            }
        }
        $('#handleCounter').handleCounter(options)
        $('#handleCounter2').handleCounter(options)
        $('#handleCounter3').handleCounter({maximize: 100})
    })
    function valChanged(d) {
//            console.log(d)
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('script')

<script>
    $(document).ready(function () {
        $('.buy-now').click(function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            const form_data = new FormData();
            form_data.append('id', id);
            $.ajax({
                'url': '{{ route('cart.add.do') }}',
                'type': 'POST',
                'data': form_data,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.iSuccess) {
                        $('#count-quantity').attr("data-count", data.quantity);
                        $("#myModal").modal('show');
                    }
                },
            });
        });
    });
</script>
</body>
</html>
