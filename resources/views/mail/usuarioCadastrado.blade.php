@component('mail::message')
    <h2>Olá, {{$user->name}}!</h2>
    <br>
    <p>Esta é uma mensagem gerada automaticamente para lhe notificar que o seu cadastro
         no Sistema de Monitoramento de Ações Prioritárias foi realizado com sucesso!</p>
    <br>
    <div class="alert alert-success">
        <p>Email: <b>{{$user->email}}</b></p>
        <p>Senha: <b>{{$user->password}}</b></p>
    </div>
    <br>
    <p>Acesse o sistema clicando no botão abaixo</p>
    @component('mail::button', ['url' => url('\home')])
        Acessar o sistema
    @endcomponent
    <br>
    <p>Atenciosamente,</p>
    <span>Coordenadoria Geral de Informática</span><br>
    <span>Secretaria da Fazenda</span><br>
    <span>Prefeitura Municipal de Olinda</span>
@endcomponent
