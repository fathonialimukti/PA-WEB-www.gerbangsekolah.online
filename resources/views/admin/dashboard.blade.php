<div class="w-full  block mt-8">
    <div class="grid grid-flow-col grid-cols-1 grid-rows-3 md:grid-cols-3 md:grid-rows-1 gap-4">
        <div class="w-full bg-blue-100 text-center border border-gray-300 px-8 py-6 rounded">
            <h3 class="text-gray-700 uppercase font-bold">
                <span class="text-4xl">{{ sprintf("%02d", count($grades)) }}</span>
                <span class="leading-tight">Classes</span>
            </h3>
        </div>
        <div class="w-full bg-blue-100 text-center border border-gray-300 px-8 py-6 rounded">
            <h3 class="text-gray-700 uppercase font-bold">
                <span class="text-4xl">{{ sprintf("%02d", count($teachers)) }}</span>
                <span class="leading-tight">Teachers</span>
            </h3>
        </div>
        <div class="w-full bg-blue-100 text-center border border-gray-300 px-8 py-6 rounded">
            <h3 class="text-gray-700 uppercase font-bold">
                <span class="text-4xl">{{ sprintf("%02d", count($students)) }}</span>
                <span class="leading-tight">Students</span>
            </h3>
        </div>
    </div>
</div>