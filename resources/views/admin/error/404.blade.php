<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>404</title>
    <link href="{{ asset("asset/admin/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("asset/admin/css/style.css") }}" rel="stylesheet">
</head>
<body class="app">
<div class='pos-a t-0 l-0 bgc-white w-100 h-100 d-f fxd-r fxw-w ai-c jc-c pos-r p-30'>
    <div class='mR-60'>
        <img alt='#' src='{{ asset("asset/images/404.png") }}' />
    </div>

    <div class='d-f jc-c fxd-c'>
        <h1 class='mB-30 fw-900 lh-1 c-red-500' style="font-size: 60px;">404</h1>
        <h3 class='mB-10 fsz-lg c-grey-900 tt-c'>Rất tiếc! Không tìm thấy Trang</h3>
        <p class='mB-30 fsz-def c-grey-700'>Trang bạn đang tìm kiếm không tồn tại hoặc đã được di chuyển.</p>
        <div>
            <a href="{{ route("dashboard") }}" type='primary' class='btn btn-primary'>Đi đến Trang chủ</a>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset("asset/admin/js/vendor.js") }}"></script>
<script type="text/javascript" src="{{ asset("asset/admin/js/bundle.js") }}"></script>
</body>
</html>
