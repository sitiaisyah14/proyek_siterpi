<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('admin/img/logo perusahaan.png')}}" rel="icon">
  <link href="{{asset('admin/img/logo perusahaan.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('admin/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('admin/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('admin/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('admin/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

  @yield('css')
  <script>
    const base_url = '{{ url('') }}';
    const web_token = '{{ csrf_token() }}';
</script>

</head>

<body>
@include('layouts.navbar')
@include('layouts.sidebar')

  <main id="main" class="main">
    @yield('content')
  </main><!-- End #main -->

@include('layouts.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{asset('admin/js/jquery-3.6.0.js')}}"></script>
  <!-- Vendor JS Files -->
  <script src="{{asset('admin/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('admin/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('admin/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('admin/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('admin/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('admin/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('admin/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('admin/vendor/extensions/sweetalert2.all.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('admin/js/main.js')}}"></script>
  <script>
    const Toast = Swal.mixin({
        toast: true,
        animation: false,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>
@yield('js')
    @if ($message = Session::get('message'))
    <script>
        Toast.fire({
            position: 'bottom-end',
            icon: 'success',
            title: '{{ $message }}'
        })
    </script>
    @endif

    @if ($error = Session::get('error'))
    <script>
        Toast.fire({
            position: 'bottom-end',
            icon: 'warning',
            title: '{{ $error }}'
        })
    </script>
    @endif
</body>

</html>
