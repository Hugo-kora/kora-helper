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
        <div class="interface" style="margin-top: 2px;">
            <a href="{{ route('site.home') }}" class="logo" style="margin-top: 20px;">
                <img src="{{ asset('images/Logo_Kora.png') }}" alt="Logo da Kora"
                    style="height: 25px; width: auto; margin-left: 120px;">
            </a>
        </div>
    </header>
    <main>
        <section class="topo-do-site" style="background-image: url('{{ asset('/images/Fundo_branco.png') }}'); ">
            <div class="interface">
                <div class="flex">
                    <div class="txt-topo-site">
                        <section class="processos">
                            <div class="interface"
                            style="position: fixed; top: 55%; left: 50%; transform: translate(-50%, -50%);">
                                    <h1 style="text-align: center; color: black;">Como podemos lhe ajudar hoje?</h1>
                                    <div class="flex processos-linha" style="margin-bottom: 5px;">
                                        @php $first_group = array_slice($subcategorias, 0, 3); @endphp
                                        @foreach ($first_group as $category)
                                            @if ($category)
                                                <div class="processos-box" style="display: flex; align-items: center; cursor: pointer; height: 240px;  margin: 0 5px; width: calc(33.33% - 10px); max-width: 190px; border: 1px solid black; border-radius: 10px;"> <!-- Modificando estilo dos cards -->
                                                    @if ($category['anchor_url'])
                                                        <a href="{{ $category['anchor_url'] }}" target="_blank" style="text-decoration: none; display: flex; align-items: center; height: 100%; width: 100%;"> <!-- Modificando para englobar todo o conteúdo do card -->
                                                    @endif
                                                    <img src="{{ url("storage/{$category['image']}") }}"
                                                        alt="{{ $category['name'] }}"
                                                        style="height: 40px; width: 30px; margin-right: 2px; align-self: flex-start;">
                                                    <div>
                                                        <h3
                                                            style="margin: 0;"> <!-- Removendo estilos de cor do texto -->
                                                            {{ $category['name'] }}</h3>
                                                    </div>
                                                    @if ($category['anchor_url'])
                                                        </a> <!-- Fechando o link -->
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="flex processos-linha processos-linha-3" style="margin-bottom: 30px;">
                                        @php $second_group = array_slice($subcategorias, 3, 3); @endphp
                                        @foreach ($second_group as $category)
                                            @if ($category)
                                            <div class="processos-box" style="display: flex; align-items: center; cursor: pointer; height: 240px;  margin: 0 5px; width: calc(33.33% - 10px); max-width: 190px; border: 1px solid black; border-radius: 10px;">
                                                    @if ($category['anchor_url'])
                                                        <a href="{{ $category['anchor_url'] }}" target="_blank" style="text-decoration: none; display: flex; align-items: center; height: 100%; width: 100%;"> <!-- Modificando para englobar todo o conteúdo do card -->
                                                    @endif
                                                    <img src="{{ url("storage/{$category['image']}") }}"
                                                        alt="{{ $category['name'] }}"
                                                        style="height: 40px; width: 30px; margin-right: 2px; align-self: flex-start;">
                                                    <div>
                                                        <h3
                                                            style="margin: 0;">
                                                            {{ $category['name'] }}</h3>
                                                    </div>
                                                    @if ($category['anchor_url'])
                                                        </a> <!-- Fechando o link -->
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Itens restantes organizados em linhas de 4 -->
                                    @php $remaining_items = array_slice($subcategorias, 6); @endphp
                                    @php $chunks = array_chunk($remaining_items, 4); @endphp
                                    @foreach ($chunks as $chunk)
                                        <div class="flex processos-linha processos-linha-4">
                                            @foreach ($chunk as $category)
                                                @if ($category)
                                                    <div class="processos-box-micro-cinza-claro"> <!-- Modificando estilo dos cards -->
                                                        @if ($category['anchor_url'])
                                                            <a href="{{ $category['anchor_url'] }}" target="_blank" style="text-decoration: none; display: flex; align-items: center; height: 100%; width: 100%;"> <!-- Modificando para englobar todo o conteúdo do card -->
                                                        @endif
                                                        <img src="{{ url("storage/{$category['image']}") }}"
                                                            alt="{{ $category['name'] }}"
                                                            style="height: 40px; width: 40px; margin-right: 10px; align-self: flex-start;">
                                                        <div>
                                                            <h3
                                                                style="margin: 0;"> <!-- Removendo estilos de cor do texto -->
                                                                {{ $category['name'] }}</h3>
                                                        </div>
                                                        @if ($category['anchor_url'])
                                                            </a> <!-- Fechando o link -->
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
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
