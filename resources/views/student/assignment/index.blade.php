@extends('layouts.app')

@section('content')

    @foreach ($student->grade->teachers as $teacher)

    <div class="mt-8 rounded border-b-4 border-gray-300">
        <h1 class="text-lg text-bold">Teacher Name : {{ $teacher->user->name }}</h1>
        <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
            <div class="w-1/6 px-4 py-3">#</div>
            <div class="w-1/6 px-4 py-3">Judul</div>
            <div class="w-2/6 px-4 py-3">Deskripsi</div>
            <div class="w-1/6 px-4 py-3">Status</div>
            <div class="w-1/6 px-4 py-3 text-right">Atur</div>
        </div>

        @php $index=1 @endphp
        
        @foreach ($student->assignment as $item)

        @if ($item->assignment->teacher_id == $teacher->id)
            <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                <div class="w-1/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $index }}</div>
                <div class="w-1/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $item->assignment->title }}</div>
                <div class="w-2/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $item->assignment->description }}</div>

                @if (!empty($item->score))
                    <div class="w-1/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">NIlai : {{$item->score}}</div>
                @elseif(empty($item->file))
                    <div class="w-1/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Belum mengumpulkan</div>
                @else
                    <div class="w-1/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Sudah mengumpulkan</div>    
                @endif
    
                <div class="w-1/6 flex items-center justify-end px-3">
                    <a href="{{ route('assignment.submit',$item->id) }}" class="flex ml-1">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                    </a>
                </div>
            </div> 
            @php $index+=1 @endphp
            @endif

        @endforeach

    </div>
        
    @endforeach

@endsection
