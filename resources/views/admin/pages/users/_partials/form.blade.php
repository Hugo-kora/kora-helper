@include('admin.includes.alerts')

@section('title', 'Cadastre-se')

@section('content_header')
    <h1>Cadastre-se</h1>
@stop

@include('admin.includes.alerts')

<script>
const maskPhoneNumber = (value) => {
    if (!value) return ''
  
    return value
      .replace(/[\D]/g, '')
      .replace(/(\d{2})(\d)/, '($1) $2')
      .replace(value[5] != 9 ? /(\d{5})(\d)/ : /(\d{5})(\d)/, '$1-$2')
      .replace(/(-\d{4})(\d+?)/, '$1')
}

const applyPhoneNumberMask = (input) => {
    input.value = maskPhoneNumber(input.value)
}

const handleCelPhoneInGame = (event) => {
    let input = event.target
    input.value = CelPhoneGameInMask(input.value)
}

const CelPhoneGameInMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g,'')
    value = value.replace(/(\d{3})(\d)/,'$1-$2')
    return value
}
</script>

<div class="container">
    <div class="form-group">
        <label class="col-sm-12 col-form-label"><h2>Dados Pessoais</h2></label>
        <br>
        <label>Nome:</label>
        <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
    </div>
    <div class="form-group">
        <label>Telefone:</label>
        <input type="text" name="cellphoneReal" id="cellphoneReal" oninput="applyPhoneNumberMask(this)" class="form-control" placeholder="Telefone Pessoal" value="{{ $user->cellphoneReal ?? old('cellphoneReal') }}">
    </div>

    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" name="email" class="form-control" placeholder="Nome" value="{{ $user->email ?? old('email') }}">
    </div>
    <br>
    <label>Este usuário faz live? </label>
    <br>
    <label class="radio-inline">
        <input type="radio" name="opcao" value="sim"> Sim
    </label>
    <label class="radio-inline">
        <input type="radio" name="opcao" value="nao"> Não
    </label>
    <br>
    <div class="modal fade custom-modal-dark" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content custom-modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insira seus dados da sua live</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>URL da live</label>
                    <div class="form-group">
                        <input type="text" name="urlLive" value="{{ $user->urlLive ?? old('urlLive') }}" class="form-control">
                    </div>
                    <label>Inserindo uma imagem da Live</label>
                    <div class="form-group">
                        <input type="file" name="foto" value="{{ $user->foto ?? old('foto') }}" class="form-control-file">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <label class="col-sm-6 col-form-label"><h2>Dados de dentro do jogo</h2></label>
    <div class="form-group">
        <label>Nome No Jogo:</label>
        <input type="text" name="nomeInGame" class="form-control" placeholder="Nome no Jogo" value="{{ $user->nomeInGame ?? old('nomeInGame') }}">
    </div>

    <div class="form-group">
        <label>Apelido no Game:</label>
        <input type="text" name="surnameInGame" class="form-control" placeholder="Apelido no Jogo" value="{{ $user->surnameInGame ?? old('surnameInGame') }}">
    </div>

    <div class="form-group">
        <label>Telefone no jogo:</label>
        <input type="text" name="cellphoneInGame" maxlength="7" onkeyup="handleCelPhoneInGame(event)" class="form-control" placeholder="Telefone No Jogo" value="{{ $user->cellphoneInGame ?? old('cellphoneInGame') }}">
    </div>

    <div class ="form-group">
        <label>Passaporte:</label>
        <input type="text" name="passaporte" class="form-control" placeholder="Passaporte" value="{{ $user->passaporte ?? old('passaporte') }}">
    </div>

    <div class="form-group">
        <label>ID discord:</label>
        <input type="text" name="discord_id" class="form-control" placeholder="Discord ID" value="{{ $user->discord_id ?? old('discord_id') }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-dark">Enviar</button>
    </div>
</div>
