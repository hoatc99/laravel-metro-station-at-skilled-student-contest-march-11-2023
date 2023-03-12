<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.metas')
    @include('includes.styles')
    <title>Trần Cẩm Hòa - TKW.B31</title>
</head>

<body>
    <div class="container-fluid">
        <div class="wrapper d-flex flex-column h-100">

            @include('partials.navbar')

            @include('partials.header')

            <div class="mb-4">
                @yield('content')
            </div>

            @include('partials.footer')

        </div>
    </div>

    @include('includes.scripts')

    @yield('scripts')
</body>

</html>
