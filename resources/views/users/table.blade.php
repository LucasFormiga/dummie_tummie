<table class="table table-striped">
    <tbody>
        <tr>
            <th>#</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Primeiro nome</th>
            <td>{{ $user->first_name }}</td>
        </tr>
        <tr>
            <th>Último nome</th>
            <td>{{ $user->last_name }}</td>
        </tr>
        <tr>
            <th>E-mail</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Endereço</th>
            <td>{{ $user->address }}</td>
        </tr>
        <tr>
            <th>Telefone</th>
            <td>{{ $user->phone }}</td>
        </tr>
        <tr>
            <th>Sexo</th>
            @if ($user->sex === 0)
            <td>Masculino</td>
            @elseif ($user->sex === 1)
            <td>Feminino</td>
            @else
            <td>Outro</td>
            @endif
        </tr>
        <tr>
            <th>CPF</th>
            <td>{{ $user->cpf }}</td>
        </tr>
        <tr>
            <th>Data de criação</th>
            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <th>Data de atualização</th>
            <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
        </tr>
    </tbody>
</table>
