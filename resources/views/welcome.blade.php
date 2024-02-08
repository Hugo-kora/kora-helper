<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="/favicon.ico" />
    <title>.: Kora Helper :.</title>
</head>
<body>
    <header>
        <div class="interface">
            <a href="#">
                <img src="images/Logo_Kora.png" alt="Logo da Kora" style="height: 40px; width: 250px;">
            </a>
        </div>
    </header>
    <main>
        <section class="topo-do-site" style="background-image: url('{{ asset('images/Fundo_site.png') }}');">
            <div class="interface">
                <div class="flex">
                    <div class="txt-topo-site">
                        <section class="processos">
                            <div class="interface">
                                <div class="flex">
                                    @php $index = 0; $nullCount = 0; @endphp
                                    @dump($finalCategories)
                                    @foreach ($finalCategories as $category)

                                        @if ($index % 3 == 0)
                                            <div class="processos-coluna">
                                        @endif

                                        @if ($category)
                                            <a href="{{ $category['anchor_url'] }}">
                                                <div class="processos-box{{ $category['color_card'] }}" style="display: flex; align-items: center;">
                                                    <img src="{{ url("storage/{$category['image']}") }}" alt="{{ $category['name'] }}" style="height: 40px; width: 40px; margin-right: 10px; align-self: flex-start;">
                                                    <div>
                                                        <h3 style="margin: 0;">{{ $category['name'] }}</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        @else
                                            <div class="processos-box-nulo"></div>
                                            @php $nullCount++ @endphp
                                        @endif

                                        @if (($index + 1) % 3 == 0 || $loop->last)
                                            </div>
                                        @endif

                                        @php $index++ @endphp
                                    @endforeach
                                    @if ($nullCount == 2)
                                        <div class="processos-box-nulo"></div>
                                    @endif
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
