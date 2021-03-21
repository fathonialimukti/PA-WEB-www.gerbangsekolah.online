<div class="container mx-auto px-4 mt-20 relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg">
    <div class="px-6 flex flex-wrap justify-center">
        <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center relative">
            <img
            alt="User Profile"
            src="{{ asset('images/profile/' . auth()->user()->profile_picture) }}"
            class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16"
            style="max-width: 150px;"
            />
        </div>
    </div>
    <div class="text-center mt-24">
        <h3
        class="text-4xl font-semibold leading-normal mb-2 text-gray-800 mb-2"
        >
        {{ auth()->user()->name }}
        </h3>
        <div class="mb-2 text-gray-700">
            Kelas : {{ auth()->user()->student->grade->class_name }}
        </div>
    </div>
    <div class="mt-10 py-10 border-t border-gray-300 text-center">
        <a href="{{ auth()->user()->student->grade->virtual_classroom }}" target="_blank">
            <button class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">Masuk ke Kelas Virtual</button>
        </a>
    </div>
</div>