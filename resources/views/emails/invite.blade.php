@component('mail::message')
Olá, você está prestes a entrar na Kora Helper

Seja bem-vindo.

Para você acessar o sistema você deve clicar no botão abaixo e preencher alguns dados.

@component('mail::button', ['url' => route('invite', ['token' => $token])])
Aceitar Convite
@endcomponent

@endcomponent
