
<!DOCTYPE html>
<html lang="ar">
	<!--begin::Head-->
	<head><base href="../../">
		<title>{{config('app.name')}}</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />
		<!--begin::Fonts-->
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Error 500 -->
			<div class="d-flex flex-column flex-column-fluid">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-column-fluid text-center p-10 py-lg-15">
					<!--begin::Logo-->
					<a href="#" class="mb-10 pt-lg-10">
						<img alt="Logo" src="{{asset('assets/media/logos/logo-1.svg')}}" class="h-40px mb-5" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="pt-lg-10 mb-10">
						<!--begin::Logo-->
						<h1 class="fw-bolder fs-2qx text-gray-800 mb-10">System Error</h1>
						<!--end::Logo-->
						<!--begin::Message-->
						<div class="fw-bold fs-3 text-muted mb-15">Something went wrong!
						<br />Please try again later.</div>
						<!--end::Message-->
						<!--begin::Action-->
						<div class="text-center">
							<a href="{{ route('dashboard') }}" class="btn btn-lg btn-primary fw-bolder">Go to homepage</a>
						</div>
						<!--end::Action-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Illustration-->
					<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url({{ asset('assets/media/illustrations/sketchy-1/17.png')}}"></div>
					<!--end::Illustration-->
				</div>
				<!--end::Content-->

			</div>
			<!--end::Authentication - Error 500-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
