<div class="w-full block mt-8">
    <div class="flex flex-wrap sm:flex-no-wrap justify-between">
        <div class="w-full bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded">
            <h3 class="text-gray-700 uppercase font-bold">
                <span class="leading-tight">Jumlah Kelas yang Diampu : </span>
                <span class="text-4xl">{{ sprintf("%d", $teacher->grades->count()) }}</span>
            </h3>
        </div>
        <div class="w-full bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded">
            <h3 class="text-gray-700 uppercase font-bold">
                <span class="leading-tight">Mata Pelajaran : </span>
                <span class="text-4xl">{{ $teacher->subject }}</span>
            </h3>
        </div>
    </div>
</div>

<br>

<div class="overflow-x-auto">
    <div class="min-w-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
        <div class="w-full">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Nama Kelas</th>
                            <th class="py-3 px-6 text-left">Link Kelas Virtual</th>
                            <th class="py-3 px-6 text-center">Masuk Kelas</th>
                        </tr>
                    </thead>

                    {{-- Start Class list --}}
                    @foreach ($teacher->grades as $class)
                        <tbody class="text-gray-600 text-lg">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <span class="font-medium">{{ $class->class_name }}</span>
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <form action="{{ route('update-virtual-classroom',$class->id) }}" method="POST">
                                        @csrf
                                        <input name="virtual_classroom" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ $class->virtual_classroom }}">
                                    </form>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="{{ $class->virtual_classroom }}" target="_blank">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                        Masuk
                                    </button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                    
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ./END TEACHER -->