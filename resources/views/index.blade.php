<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Jadwal</title>
</head>

<body>
  <div class="w-full h-24 bg-blue-500 flex justify-center items-center">
    <p class="text-3xl font-semibold text-blue-900">
      Pengaturan Jadwal
    </p>
  </div>
  <div>
    <div>
      <form method="POST" id="jadwalForm" action="/jadwal" class="grid grid-cols-2 gap-2 justify-center py-12 px-4">
        @csrf
        @method("POST")
        <div class="flex flex-col">
          <label>Title</label>
          <input id="title" name="title" required type="text" class="border h-10 border-gray-300 rounded shadow px-2" />
        </div>
        <div class="flex flex-col">
          <label>Description</label>
          <input id="description" name="description" required type="text" class="border h-10 border-gray-300 rounded shadow px-2" />
        </div>
        <div class="flex flex-col">
          <label>Location</label>
          <input id="location" name="location" required type="text" class="border h-10 border-gray-300 rounded shadow px-2" />
        </div>
        <div class="flex flex-col">
          <label>Start Date</label>
          <input id="startDate" name="startDate" required type="date" class="border h-10 border-gray-300 rounded shadow px-2" />
        </div>
        <div class="flex flex-col">
          <label>End Date</label>
          <input id="endDate" name="endDate" required type="date" class="border h-10 border-gray-300 rounded shadow px-2" />
        </div>
        <div class="flex flex-col">
          <label class="invisible">.</label>
          <div class="w-full flex gap-2">
            <button type="button" id="cancelUpdate" style="display: none;" class="bg-blue-500 h-10 rounded text-white w-full">
              Cancel
            </button>
            <button type="submit" class="bg-blue-500 h-10 rounded text-white w-full">
              Submit
            </button>
          </div>
        </div>
      </form>
      <hr />
    </div>
  </div>
  <div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5  gap-4 px-4 pt-6">
      @foreach ($data as $d)
      <article class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow">
        <div class="p-4 sm:p-6">
          <p datetime="2022-10-10" class="block text-xs text-gray-500">{{ $d->startDate }} - {{ $d->endDate}}</p>
          <h3 class="text-lg font-medium text-gray-900">
            {{ $d->title }}
          </h3>
          <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
            {{ $d->description }}
          </p>
          <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">endDate
            {{ $d->location }}
          </p>
          <div class="flex gap-4">
            <button onclick="update('{{ $d->id }}','{{ $d->title }}','{{ $d->description }}','{{ $d->location }}','{{ $d->startDate }}','{{ $d->endDate }}')" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600">
              Edit
            </button>

            <button onclick="del('{{ $d->id }}','{{ $d->title }}')" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-red-600">
              Remove
            </button>
          </div>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</body>
<script>
  async function del(id, title) {
    const sure = confirm(`Yakin mau hapus? ${title}`)

    if (!sure) return;

    try {
      const csrfToken = document.querySelector(
        'meta[name="csrf-token"]'
      ).content;
      const request = await fetch(
        `http://localhost:8000/jadwal/${id}`, {
          method: "DELETE",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
          },
        }
      );
      return window.location.reload();
    } catch (error) {
      return error;
    }
  }

  function update(id, title, description, location, start, end) {
    document.querySelector('input[name="_method"]').value = 'PATCH'
    document.getElementById("cancelUpdate").style.display = "block"
    document.getElementById("title").value = title;
    document.getElementById("description").value = description;
    document.getElementById("location").value = location;
    document.getElementById("startDate").value = start;
    document.getElementById("endDate").value = end;

    // SET THE ROUTE TO UPDATE API
    const form = document.getElementById("jadwalForm");
    return form.action = `/jadwal/${id}/`;
  }

  document.getElementById("cancelUpdate").addEventListener("click", () => {
    document.querySelector('input[name="_method"]').value = 'POST'
    document.getElementById("title").value = "";
    document.getElementById("description").value = "";
    document.getElementById("location").value = "";
    document.getElementById("startDate").value = undefined;
    document.getElementById("endDate").value = undefined;
    document.getElementById("cancelUpdate").style.display = "none"

    // SET THE ROUTE TO INSERT API
    const form = document.getElementById("jadwalForm").form.action = `/jadwal/`;
    form.action = `/jadwal/`;

  })
</script>

</html>