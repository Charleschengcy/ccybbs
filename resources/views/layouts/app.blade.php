<!DOCTYPE html>
<!-- 获取的是 config/app.php 中的 locale 选项，因为我们在之前做了修改 -->
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'CcyBBS') - {{ setting('site_name', 'Laravel Project') }}</title>
  <meta name="description" content="@yield('description', setting('seo_description', 'LaraBBS'))" />
   <meta name="keyword" content="@yield('keyword', setting('seo_keyword', 'CcyBBS'))" />

  <!-- Styles -->
<!--   会根据 webpack.mix.js 的逻辑来生成 CSS 文件链接 -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

  @yield('styles')

</head>

<body>
  <!-- 是我们自定义的辅助方法，我们还需要在 helpers.php 文件中添加此方法 -->
  <div id="app" class="{{ route_class() }}-page">

    @include('layouts._header')

    <div class="container">

      @include('shared._messages')

      @yield('content')

    </div>

    @include('layouts._footer')
  </div>

  @if (app()->isLocal())
    @include('sudosu::user-selector')
  @endif

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>

  @yield('scripts')
</body>

</html>
