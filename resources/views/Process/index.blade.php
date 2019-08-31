
<meta name="csrf-token" content="{{ csrf_token() }}"><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/js.js') }}"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<div class="process">
	<h2>Tìm số đối xứng lớn nhất</h2>

	<div>
		<label>Nhập số cần kiểm tra:</label>
		<input type="number" name="number" id="number-check" min="0">
		<button type="button" class="btn-primary" id="btn-check" onclick="ProcessController.getValue();">Kiểm tra</button>
	</div>
	<div class="notification">
		<div class="lazyload">
			<img src="{{asset('img/station-loading.gif') }}">
		</div>
	</div>
</div>
<div class="alert">
	<div class="content-alert">
		<span>Bạn phải nhập số để kiểm tra!</span>
		<button class="btn-primary" onclick="ProcessController.back();">Quay Lại</button>
	</div>
</div>