<!-- resources/views/search.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="p-8 rounded shadow-md w-full">
    <h1 class="text-xl font-bold mb-4 mr-4 text-black rounded w-full h-full p-6">Hasil Pencarian</h1>

    <div id="searchResults" class="text-gray-700 rounded">
        @if($results->isEmpty())
            <p>Tidak ada hasil yang ditemukan.</p>
        @else
            <table class="min-w-full bg-white mb-4">
                <thead>
                    <tr>
                        @foreach($results->first()->getAttributes() as $key => $value)
                            <th class="py-4 border border-b border-gray-300 text-center">{{ $key }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            @foreach($result->getAttributes() as $key => $value)
                                <td class="py-4 border border-b border-gray-300 text-center">{{ $value }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
