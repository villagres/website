<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	@include('layout.links')
</head>
<body>
	<div class="container-fluid">	
		@yield('content')
	</div>
	@yield('javascript')
</body>
</html>