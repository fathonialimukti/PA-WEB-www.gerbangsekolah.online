@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-gray-700 uppercase font-bold">{{ $assignment->title }}</h2>
        </div>
        <div class="flex flex-wrap items-center">
            <a href="{{ route('assignment-manager.index') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                <span class="ml-2 text-xs font-semibold">Kembali</span>
            </a>
        </div>
    </div>

    <div class="mt-8 rounded border-b-4 border-gray-300">
        <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
            <div class="w-1/6 px-4 py-3">#</div>
            <div class="w-1/6 px-4 py-3">Nama</div>
            <div class="w-1/6 px-4 py-3">Status</div>
            <div class="w-2/6 px-4 py-3">Catatan</div>
            <div class="w-1/6 px-4 py-3 text-right">Download</div>
        </div>

        @php $index=1 @endphp
        
        @foreach ($assignment->files as $assignment)

            <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                <div class="w-1/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $index }}</div>
                <div class="w-1/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $assignment->student->user->name }}</div>
                @if (empty($assignment->file))
                    <div class="w-1/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Belum Mengumpulkan</div>
                @else
                    <form class="w-1/6 px-4 py-3 flex" method="POST" action="{{ route('assignment-manager.scoring',$assignment->id) }}">
                        @csrf
                        <div class=" text-sm font-semibold text-gray-600 tracking-tight md:w-1/3">
                            <label class="block md:text-right mb-1 md:mb-0 pr-4">
                                Nilai
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input name="score" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ $assignment->score }}">
                        </div>
                    </form>
                @endif
                <div class="w-2/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $assignment->note }}</div>
                <div class="animate-bounce w-1/6 flex items-center justify-end px-3">
                    @if (!empty($assignment->file))
                        <a href="{{ route('assignment-manager.download',$assignment->file) }}" class="ml-1 block p-2">
                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                        </a>
                    @endif                       
                </div>
            </div>

            @php $index+=1 @endphp

        @endforeach

    </div>

@endsection
