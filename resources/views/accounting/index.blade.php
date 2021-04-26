@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Biaya Sekolah </h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ URL::previous() }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
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
                        <span class="block text-gray-600 font-bold">{{ $student->user->name }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                    <div class="w-6/12 px-4 py-3">Bulan</div>
                    <div class="w-3/12 px-4 py-3">Tagihan</div>
                    <div class="w-3/12 px-4 py-3">Status</div>
                </div>
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-6/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Januari</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Rp.130.000,-</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <a href="">Lunas</a>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-6/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Februari</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Rp.130.000,-</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <a href="">Lunas</a>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-6/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Maret</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Rp.130.000,-</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <a href="">Lunas</a>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-6/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">April</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Rp.130.000,-</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <a href="">Belum Bayar</a>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-6/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Mei</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Rp.130.000,-</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <a href="">Belum Bayar</a>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-6/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Juni</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Rp.130.000,-</div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <a href="">Belum Bayar</a>
                        </div>
                    </div>
        </div>

    </div>
@endsection
