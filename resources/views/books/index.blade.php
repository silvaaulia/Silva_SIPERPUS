<x-app-layout>
    <!-- Header Section -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 dark:text-gray-200 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    <!-- Main Content with full-screen background -->
    <div class="min-h-screen bg-cover bg-center" style="background-image: url('https://i.pinimg.com/736x/b6/db/c1/b6dbc1286429b2e9c6f6472b78d54b60.jpg');">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="bg-white dark:bg-blue-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Input Pencarian -->
<input type="text" id="searchQuery" placeholder="Search books..."
    class="rounded-md border-indigo-500 focus:border-indigo-700 focus:ring focus:ring-indigo-200 transition text-sm px-3 py-1.5 w-full mb-4 text-black"
    oninput="searchBooks()">

<!-- Tombol-tombol -->
<x-primary-button tag="a" href="{{ route('book.create') }}" class="border-indigo-500 hover:border-indigo-700">Tambah Data Buku</x-primary-button>
<x-primary-button tag="a" href="{{ route('book.print') }}" class="border-indigo-500 hover:border-indigo-700">Print PDF</x-primary-button>
<x-primary-button tag="a" href="{{ route('book.export') }}" target="_blank" class="border-indigo-500 hover:border-indigo-700">Export Excel</x-primary-button>


                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Kode Rak</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        <tbody id="bookTableBody">
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->year }}</td>
                                    <td>{{ $book->publisher }}</td>
                                    <td>{{ $book->city }}</td>
                                    <td>
                                        <img src="{{ asset('storage/cover_buku/' . $book->cover) }}" width="100px" />
                                    </td>
                                    <td>{{ $book->bookshelf->code }}-{{ $book->bookshelf->name }}</td>
                                    <td>
                                        <x-primary-button tag="a" href="{{ route('book.edit', $book->id) }}">Edit</x-primary-button>
                                        <x-danger-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')"
                                            x-on:click="$dispatch('set-action', '{{ route('book.destroy', $book->id) }}')">{{ __('Delete') }}</x-danger-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table>

                    <!-- Modal untuk konfirmasi penghapusan -->
                    <x-modal name="confirm-book-deletion" focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @method('delete')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin akan menghapus data?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-danger-button class="ml-3">
                                    {{ __('Delete!!!') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>

                    <!-- Modal untuk import buku -->
                    <x-modal name="import-book" focusable maxWidth="xl">
                        <form method="post" action="{{ route('book.import') }}" class="p-6"
                            enctype="multipart/form-data">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Import Data Buku') }}
                            </h2>
                            <div class="max-w-xl">
                                <x-input-label for="cover" class="sr-only" value="File Import" />
                                <x-file-input id="cover" name="file" class="mt-1 block w-full" required />
                            </div>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Batal') }}
                                </x-secondary-button>
                                <x-primary-button class="ml-3">
                                    {{ __('Upload') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>

                </div>
            </div>
        </div>
    </div>

    <script>
        function searchBooks() {
            // Ambil query pencarian
            let query = document.getElementById('searchQuery').value;

            // Gunakan fetch untuk mengambil data buku yang sudah difilter
            fetch(`/books/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    displayResults(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function displayResults(books) {
            let tableBody = document.getElementById('bookTableBody');
            tableBody.innerHTML = ''; // Kosongkan isi tabel sebelumnya

            if (books.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="9" class="text-center">No books found.</td></tr>';
                return;
            }

            books.forEach((book, index) => {
                tableBody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${book.title}</td>
                        <td>${book.author}</td>
                        <td>${book.year}</td>
                        <td>${book.publisher}</td>
                        <td>${book.city}</td>
                        <td><img src="${book.cover}" width="100px" /></td>
                        <td>${book.bookshelf}</td>
                        <td>
                            <x-primary-button tag="a" href="/book/${book.id}/edit">Edit</x-primary-button>
                            <x-danger-button x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')"
                                             x-on:click="$dispatch('set-action', '/book/${book.id}/destroy')">Delete</x-danger-button>
                        </td>
                    </tr>
                `;
            });
        }
    </script>

</x-app-layout>
