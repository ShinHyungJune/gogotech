<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=1400, user-scalable" />
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />-->
    <meta name="naver-site-verification" content="f04952055f73f2d54bc9dc7898d998793508b679" />
    <title>{{config("app.name")}}</title>
    <link rel="shortcut icon" href="{{asset('/img/favicon.ico')}}">
    <link href="{{ asset('css/default.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/aos-2.3.1.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/swiper.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/editor.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/module.css?v='.\Carbon\Carbon::now()->format("Y-m-d H:i:s")) }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css?v='.\Carbon\Carbon::now()->format("Y-m-d H:i:s")) }}" rel="stylesheet" />

    <!-- 날짜관련 -->
    <script src="{{ asset('js/jquery-1.12.4.js') }}" defer></script>
    <script src="{{ asset('js/jquery-ui-1.12.1.js') }}" defer></script>
    <script src="{{ asset('js/moment-2.24.0.js') }}" defer></script>

    <!-- 카카오 주소찾기 -->
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>


    <script src="{{ asset('js/swiper.min.js') }}" defer></script>
    <script src="{{ asset('js/aos-2.3.1.js') }}" defer></script>
    <script src="{{ asset('js/common.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- 아임포트 -->
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>

    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body>
@inertia
</body>
</html>
