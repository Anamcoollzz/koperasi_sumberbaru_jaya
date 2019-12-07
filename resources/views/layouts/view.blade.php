<!DOCTYPE html>
<html>
@include('layouts.head')
<body class="hold-transition skin-green sidebar-mini">
	<div class="wrapper">
		@include('layouts.header')
		@include('layouts.leftbar')
		@yield('content')
		@include('layouts.footer')
		{{-- @include('layouts.rightbar') --}}
    </div>
        @include('layouts.modal')
        @include('layouts.script')
</body>
</html>