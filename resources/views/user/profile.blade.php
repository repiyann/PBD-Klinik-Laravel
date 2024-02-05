@extends('user.app')

@section('content')

<div class="flex items-center justify-center lg:py-5 py-5 px-5">
    <div class="mx-auto w-full max-w-[550px]">
        <div class="tabs">
            <h3 class="w-full text-center text-2xl font-semibold mb-4 dark:text-white">Account Settings</h3>

            @if ($errors->has('name') || $errors->has('email'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                <p>{{ $errors->first() }}</p>
            </div>
            @endif

            <section id="account-info" class="tab-content card dark:bg-gray-700">
                @if ($errors->errorUpdateProfile->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <p>{{ $errors->errorUpdateProfile->first() }}</p>
                </div>
                @endif

                <form action="{{ route('updateProfile') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="-mx-3 flex flex-wrap">
                        <p class="w-full px-3 text-lg font-semibold dark:text-white">Profile Information</p>
                        <p class="w-full px-3 mb-6 dark:text-white">Update your account's profile information and email address.</p>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="name" class="block text-base font-medium text-[#07074D] dark:text-white">
                                    Name
                                </label>
                                <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name', Auth::user()->name) }}" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="email" class="block text-base font-medium text-[#07074D] dark:text-white">
                                    Email
                                </label>
                                <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email', Auth::user()->email) }}" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <button class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Update Account
                        </button>
                    </div>
                </form>
            </section>

            <section id="update-password" class="tab-content card dark:bg-gray-700">
                @if ($errors->errorUpdatePassword->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <p>{{ $errors->errorUpdatePassword->first() }}</p>
                </div>
                @endif

                <form action="{{ route('updatePassword') }}" method="POST">
                    @csrf
                    @method('POST')
                    <p class="w-full text-lg font-semibold dark:text-white">Update Password</p>
                    <p class="w-full mb-6 dark:text-white">Ensure your account is using a long, random password to stay secure.</p>
                    <div class="mb-5">
                        <label for="password" class="block text-base font-medium text-[#07074D] dark:text-white">
                            Current Password
                        </label>
                        <input type="password" name="oldPassword" id="current_password" placeholder="Current Password" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="newPassword" class="block text-base font-medium text-[#07074D] dark:text-white">
                            New Password
                        </label>
                        <input type="password" name="newPassword" id="new_password" placeholder="New Password" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="password_confirmation" class="block text-base font-medium text-[#07074D] dark:text-white">
                            Confirm New Password
                        </label>
                        <input type="password" name="newPassword_confirmation" id="new_password" placeholder="New Password" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>

                    <div>
                        <button class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Update Password
                        </button>
                    </div>
                </form>
            </section>

            <section id="delete-account" class="tab-content card dark:bg-gray-700">
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <p>{{ $errors->first() }}</p>
                </div>
                @endif

                <form action="{{ route('deleteAccount') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="mb-5">
                        <p class="w-full text-lg font-semibold dark:text-white">Delete Account</p>
                        <p class="w-full mb-6 dark:text-white">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                        <p class="text-base font-medium text-[#6B7280] dark:text-white">Are you sure you want to delete your account?</p>
                    </div>

                    <div>
                        <button class="hover:shadow-form rounded-md bg-red-500 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Delete Account
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<style>
    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }
</style>

@endsection