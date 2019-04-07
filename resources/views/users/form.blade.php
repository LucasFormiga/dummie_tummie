<form action="{{ $user->id ? route('users.update', $user) : route('users.store', $user) }}"
    method="post" id="userForm">
    @csrf()
    @if($user->id)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="first_name">Primeiro Nome *</label>

        <input id="first_name" type="text"
        class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
        name="first_name" value="{{ old('first_name') ?? $user->first_name }}" required autofocus>

        @if ($errors->has('first_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="last_name">Último Nome *</label>

        <input id="last_name" type="text"
        class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
        name="last_name" value="{{ old('last_name') ?? $user->last_name }}" required>

        @if ($errors->has('last_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="address">Endereço *</label>

        <input id="address" type="text"
        class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
        name="address" value="{{ old('address') ?? $user->address }}" required>

        @if ($errors->has('address'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="phone">Telefone *</label>

        <input id="phone" type="tel"
        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
        name="phone" value="{{ old('phone') ?? $user->phone }}" required>

        @if ($errors->has('phone'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>

    @if (!$user->id)
    <div class="form-group">
        <label for="sex">Sexo *</label>
        <select class="form-control" id="sex" name="sex">
            <option value="0">Masculino</option>
            <option value="1">Feminino</option>
            <option value="2">Outro</option>
        </select>

        @if ($errors->has('sex'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('sex') }}</strong>
            </span>
        @endif
    </div>
    @endif

    @if (!$user->id) 
    <div class="form-group">
        <label for="cpfInput">CPF *</label>

        <input id="cpfInput" type="text"
        class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}"
        name="cpf" value="{{ old('cpf') ?? $user->cpf }}" required>

        @if ($errors->has('cpf'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('cpf') }}</strong>
            </span>
        @endif
    </div>
    @endif

    <div class="form-group">
        <label for="email">E-mail *</label>

        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
               value="{{ old('email') ?? $user->email }}" required>

        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="password">Senha {{ $user->id ? '' : '*'}}</label>

        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
               value="{{ old('password') ?? $user->password }}" {{ $user->id ? '' : 'required'}}>

        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block" id="userFormBtn">{{ $user->id ? 'Atualizar' : 'Inserir' }}</button>
    </div>
</form>
