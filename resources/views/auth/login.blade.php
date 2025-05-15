<x-auth-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!--begin::Form-->
<form class="form w-100" method="POST" action="{{ route('login') }}">
    @csrf
    <!--begin::Heading-->
    <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-gray-900 fw-bolder mb-3">Login</h1>
        <!--end::Title-->
        <!--begin::Subtitle-->
        <div class="text-gray-500 fw-semibold fs-6">Login melalui akun google anda</div>
        <!--end::Subtitle=-->
    </div>
    <!--begin::Heading-->
    <!--begin::Login options-->
    <div class="row g-3 mb-9">
        <!--begin::Col-->
        <div class="col-md-12">
            <!--begin::Google link=-->
            <a href="{{ route('oauth.google') }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100 border-2">
            <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-15px me-3" />Sign in with Google</a>
            <!--end::Google link=-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Login options-->
    <!--begin::Separator-->
    <div class="separator separator-content my-14">
        <span class="w-250px text-gray-500 fw-semibold fs-7">Atau dengan email</span>
    </div>
    <!--end::Separator-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <x-text-input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent pink-focus" id="email" :value="old('email')" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <!--end::Email-->
    </div>
    <!--end::Input group=-->
    <div class="fv-row mb-3">
        <!--begin::Password-->
        <div class="position-relative mb-3">
            <x-text-input type="password" placeholder="Password" name="password" id="password" autocomplete="off" class="form-control bg-transparent pink-focus" />
            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                <i class="ki-duotone ki-eye-slash fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
                <i class="ki-duotone ki-eye fs-2 d-none">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
            </span>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
        <!--end::Password-->
    </div>
    <!--end::Input group=-->
    <!--begin::Wrapper-->
    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-20 mt-6">
        <div class="form-check d-flex align-items-center form-check-sm">
            <input id="remember_me"  class="form-check-input me-3 !w-[18px] !h-[18px] border-4 checked:!bg-pink-500 checked:!border-pink-500" type="checkbox" name="remember" />
            <label class="form-check-label" for="remember_me">
                Ingat Saya
            </label>
        </div>
        <div></div>
        <!--begin::Link-->
        @if (Route::has('password.request'))
                <a class="text-pink-500" href="{{ route('password.request') }}">
                    {{ __('Lupa Password ?') }}
                </a>
        @endif
        {{-- <a href="authentication/layouts/corporate/reset-password.html" class="link-primary">Lupa Password ?</a> --}}
        <!--end::Link-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Submit button-->
    <div class="d-grid mb-10">
        <button type="submit" id="kt_sign_in_submit" class="btn !bg-pink-500 hover:!bg-pink-600 focus:!ring-4 focus:!ring-pink-300 text-white">
            <!--begin::Indicator label-->
            <span class="indicator-label">Login</span>
            <!--end::Indicator label-->
            <!--begin::Indicator progress-->
            <span class="indicator-progress">Please wait... 
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            <!--end::Indicator progress-->
        </button>
    </div>
    <!--end::Submit button-->
    <!--begin::Sign up-->
    <div class="text-gray-500 text-center fw-semibold fs-6">Belum memiliki akun? 
    <a href="register" class="text-pink-500">Register</a></div>
    <!--end::Sign up-->
</form>
<!--end::Form-->

{{-- Custom Javascript for password visibility toggle --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const visibilityToggle = document.querySelector('[data-kt-password-meter-control="visibility"]');
        const eyeIcon = visibilityToggle.querySelector('.ki-eye');
        const eyeSlashIcon = visibilityToggle.querySelector('.ki-eye-slash');

        visibilityToggle.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('d-none');
                eyeSlashIcon.classList.add('d-none');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.add('d-none');
                eyeSlashIcon.classList.remove('d-none');
            }
        });
    });
</script>
</x-auth-layout>