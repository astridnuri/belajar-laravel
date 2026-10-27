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
    <br>
    <br>
    <form action="{{ route('actionKurang') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Angka 1</label>
            <input type="number" name="angka1" placeholder="Masukkan angka">
        </div>
        <br>
        <div class="form-group">
            <label for="">Angka 2</label>
            <input type="number" name="angka2" placeholder="Masukkan angka">
            <br>
        </div>
        <br>
        <div class="form-group">
            <button type="submit">Kurangkan</button>
        </div>
        <br>
    </form>
    <h2>Hasilnya adalah {{ $kurangan ?? 0 }}</h2>
</body>
</html>

