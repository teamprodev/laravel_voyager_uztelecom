{{ Aire::open()
  ->route('warehouse.create')
  ->enctype("multipart/form-data")
  ->post() }}
<div class="mt-6">
</div>
<div class="w-full text-center pb-8 ">
    <button class="bg-blue-500 hover:bg-blue-700 mx-4 p-2 transition duration-300 rounded-md text-white"
    name="status" value="товар получил">
        товар получил
    </button>
    <button class="bg-blue-500 hover:bg-red-700 mx-4 p-2 transition duration-300 rounded-md text-white"
    name="status" value="товар прибыл">
        товар прибыл
    </button>
</div>
{{Aire::close()}}
