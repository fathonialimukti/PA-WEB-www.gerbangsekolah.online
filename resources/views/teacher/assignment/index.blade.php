@extends('layouts.app')

@section('content')
    @foreach ($teacher->grades as $class)

    <div class="mt-8 rounded border-b-4 border-gray-300">
        <h1 class="text-xl text-gray-700 uppercase font-bold">Nama Kelas : {{ $class->class_name }}</h1>
        <a href="{{ route('assignment-manager.create-assignment',$class->id) }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
            <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
            <span class="ml-2 text-xs font-semibold">Assignment</span>
        </a>
        <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
            <div class="w-1/6 px-4 py-3">#</div>
            <div class="w-2/6 px-4 py-3">Judul</div>
            <div class="w-1/6 px-4 py-3">Deskripsi</div>
            <div class="w-2/6 px-4 py-3 text-right">Atur</div>
        </div>

        @php $index=1 @endphp
        
        @foreach ($class->assignments as $assignment)

            @if ( $assignment->teacher_id == $teacher->id )

            <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                <div class="w-1/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $index }}</div>
                <div class="w-2/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $assignment->title }}</div>
                <div class="w-1/6 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $assignment->description }}</div>
                <div class="w-2/6 flex items-center justify-end px-3">
                    <a href="{{ route('assignment-manager.show',$assignment->id) }}" class="ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm" title="assign subject">
                        <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" class="svg-inline--fa fa-eye fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path></svg>
                    </a>
                    <a href="{{ route('assignment-manager.edit',$assignment->id) }}" class="ml-1">
                        <svg class="h-6 w-6 fill-current text-gray-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                    </a>
                    <form action="{{ route('assignment-manager.destroy',$assignment->id) }}" method="POST" class="inline-flex ml-1 delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Peringatan! File tugas yang telah dikumpulkan akan ikut dihapus.')" class="bg-gray-600 block p-1 border border-gray-600 rounded-sm">
                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            @php $index+=1 @endphp

            @endif
        @endforeach

    </div>
        
    @endforeach

@endsection
