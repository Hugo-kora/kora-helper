<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <title>.: Kora Helper :.</title>
</head>

<body>
    <header>
        <div class="interface" style="margin-top: 3px;">
            <a href="{{ route('site.home') }}" class="logo" style="margin-top: 10px;">
                <img src="{{ asset('images/Logo_Kora.png') }}" alt="Logo da Kora"
                    style="height: 35px; width: auto; margin-left: 80px;">
            </a>
        </div>
    </header>
    <main>
        <section class="topo-do-site" style="background-image: url('{{ asset('/images/Fundo_site.png') }}'); ">
            <div class="interface">
                <div class="flex">
                    <div class="txt-topo-site">
                        <section class="processos">
                            <div class="interface"
                                style="position: fixed; top: 55%; left: 50%; transform: translate(-50%, -50%);">
                                @php $chunks = array_chunk($finalCategories, 3); @endphp
                                @foreach ($chunks as $chunk)
                                    <div class="flex processos-coluna">
                                        @foreach ($chunk as $category)
                                            @if ($category)
                                                <div class="processos-box{{ $category['color_card'] }}"
                                                    style="display: flex; align-items: center; cursor: pointer; height: 150px; margin: 0 -1px;"
                                                    onclick="window.location='{{ route('subcategorias', $category['name']) }}';">
                                                    <img src="{{ url("storage/{$category['image']}") }}"
                                                        alt="{{ $category['name'] }}"
                                                        style="height: 40px; width: 40px; margin-right: 10px; align-self: flex-start;">
                                                    <h4
                                                        style="margin: 0; color: {{ $category['color_name'] === '-beje' ? '#efe1d3' : ($category['color_name'] === '-azul' ? '#153c53' : 'cor-padrão') }};">
                                                        {{ $category['name'] }}</h4>
                                                </div>
                                            @else
                                                <div class="processos-box-nulo"
                                                    style="display: flex; align-items: center; cursor: pointer; height: 120px; margin: 0 -1px;">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
    </footer>
</body>

</html>
