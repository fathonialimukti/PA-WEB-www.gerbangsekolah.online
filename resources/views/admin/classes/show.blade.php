@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Grade details</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('grade.index') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Kembali</span>
                </a>
            </div>
        </div>

        <div class="mt-8 bg-white rounded">
            <div class="w-full max-w-2xl px-6 py-12">


                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Nama :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <span class="block text-gray-600 font-bold">{{ $grade->class_name }}</span>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Link Meeting :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <span class="text-gray-600 font-bold">{{ $grade->virtual_classroom }}</span>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Guru Pengajar :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        @foreach ($grade->teachers as $teacher)
                            <span class="text-gray-600 font-bold">{{ $teacher->user->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Pelajar :
                        </label>
                    </div>
                </div>
            </div>
            <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                    <div class="w-1/12 px-4 py-3">#</div>
                    <div class="w-8/12 px-4 py-3">Nama</div>
                    <div class="w-3/12 px-4 py-3">SPP</div>
                </div>
                @php $index=1 @endphp
                @foreach ($grade->students as $student)
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $student->class_id }}</div>
                        <div class="w-8/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $student->user->name }}</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <a href="{{ route('payment.show',$student->id) }}">Check</a>
                        </div>
                    </div>
                    @php $index+=1 @endphp
                @endforeach
            </div>
        </div>

    </div>
@endsection
