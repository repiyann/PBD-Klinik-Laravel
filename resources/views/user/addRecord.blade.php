@extends('user.app')

@section('content')

<div class="flex items-center justify-center lg:py-5 py-5 px-5">
    <div class="mx-auto w-full max-w-[550px]">
        <div class="tabs h-[80.1vh]">
            <form action="{{ route('storeRecord') }}" method="POST">
                @csrf
                @method('POST')
                <div class="-mx-3 flex flex-wrap">
                    <h3 class="w-full text-center text-2xl font-semibold mb-4 dark:text-white"> Patient's Detail </h3>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="fName" class="block text-base font-medium text-[#07074D] dark:text-white">
                                First Name
                            </label>
                            <input type="text" name="firstName" id="fName" placeholder="First Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="lName" class="block text-base font-medium text-[#07074D] dark:text-white">
                                Last Name
                            </label>
                            <input type="text" name="lastName" id="lName" placeholder="Last Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                </div>
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="guest" class="block text-base font-medium text-[#07074D] dark:text-white">
                                National Identity Number
                            </label>
                            <input type="text" name="nationalID" id="guest" placeholder="National Identity Number" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="date" class="block text-base font-medium text-[#07074D] dark:text-white">
                                Date of Birth
                            </label>
                            <input type="date" name="birthDate" id="date" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="guest" class="block text-base font-medium text-[#07074D] dark:text-white">
                        Address
                    </label>
                    <textarea type="text" name="address" id="guest" placeholder="Address" min="0" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                </div>
                <div class="mb-5">
                    <label for="guest" class="block text-base font-medium text-[#07074D] dark:text-white">
                        Notes
                    </label>
                    <textarea type="text" name="notes" id="guest" placeholder="Notes" min="0" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                </div>
                <div>
                    <button type="submit" class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection