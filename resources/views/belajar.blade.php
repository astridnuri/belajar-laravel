<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title?? 'Belajar Laravel' }}</title>
</head>
<body>
    <h1>Belajar Matematika Dasar</h1>
    <a href="{{route('tambah')}}">Tambah-tambahan</a>
    <a href="{{ route('pengurangan') }}">Pengurangan</a>
    <a href="{{ route('perkalian') }}">Kali2an</a>
    <a href="{{ route('bagi') }}">Bagi2an</a>


    <a href="{{ url()->previous() }}">Kembali</a>
    {{-- manggil url di laravel ada 3 macem. url, route, /nama route. palingh aman pake route utk mcegah miss --}}
    <main>
        {{-- {{ directive, pakenya @ }} --}}
        @yield('content')
    </main>
</body>
</html>
