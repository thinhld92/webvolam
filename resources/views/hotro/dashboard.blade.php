@extends('hotro.layouts.master')

@section('link_css')
<link rel="stylesheet" href="{{asset('backend/assets/vendor/css/pages/page-profile.css')}}" />
@endsection
@section('content')
<!-- Header -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="user-profile-header-banner">
        <img src="{{asset('backend/assets/img/pages/profile-banner.png')}}" alt="Banner image" class="rounded-top" />
      </div>
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          <img
            src="{{$user->photo}}"
            alt="user image"
            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
        </div>
        <div class="flex-grow-1 mt-3 mt-sm-5">
          <div
            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
            <div class="user-profile-info">
              <h4>{{$user->cAccName}}</h4>
              <ul
                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                <li class="list-inline-item d-flex gap-1">
                  <i class="ti ti-color-swatch"></i> {{$user->cRealName}}
                </li>
              </ul>
            </div>
            {{-- <a href="javascript:void(0)" class="btn btn-primary">
              <i class="ti ti-check me-1"></i>Connected
            </a> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Header -->

<!-- User Profile Content -->
<div class="row">
  <div class="col-xl-4 col-lg-5 col-md-5">
    <!-- About User -->
    <div class="card mb-4">
      <div class="card-body">
        <small class="card-text text-uppercase">{{ __('Account Details') }}</small>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3">
            <i class="fa fa-user"></i>
            <span class="fw-medium mx-2 text-heading">{{ __('Username') }}:</span> <span>{{ $user->cAccName }}</span>
          </li>
          <li class="d-flex align-items-center mb-3">
            <i class="fa fa-address-card"></i>
            <span class="fw-medium mx-2 text-heading">{{ __('Full Name') }}:</span> <span>{{ $user->cRealName }}</span>
          </li>
          <li class="d-flex align-items-center mb-3">
            <i class="fa fa-calendar-days"></i>
            <span class="fw-medium mx-2 text-heading">{{ __('Register Date') }}:</span>{{ $user->registerDate }}<span></span>
          </li>
      </div>
    </div>
    <!--/ About User -->

  </div>
  <div class="col-xl-8 col-lg-7 col-md-7">
    <div class="card">
      <h5 class="card-header">{{ __('Payment history') }}</h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Số tiền</th>
                <th>Số xu</th>
                <th>Phương thức</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  {{-- <i class="fa-solid fa-dollar-sign"></i> --}}
                  <i class="fa fa-dollar-sign fa-xl text-danger me-3"></i>
                  <span class="fw-medium">Hello</span>
                </td>
                <td>AHello</td>
                <td>
                  hello
                </td>
                <td><span class="badge bg-label-primary me-1">Active</span></td>
              </tr>
      
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ User Profile Content -->
    
@endsection

@section('script')
<script src="{{asset('backend/assets/js/pages-profile.js')}}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

    const token = $("input[name='_token']").val();

    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);

          const data = new FormData();
          data.append('avatar', fileInput.files[0]);
          data.append('_token', token);
          fetch("{{route('hotro.upload-avatar')}}", {
            method: 'POST',
            body: data
          }).then(
            response => response.json() // if the response is a JSON object
          ).then(
            // success
            (data) => {accountUserImage.src = data.urlFile;} // Handle the success response object
          ).catch(
            error => console.log(error) // Handle the error response object
          );
        }

      };
    }
  })();
  });
</script>
    
@endsection