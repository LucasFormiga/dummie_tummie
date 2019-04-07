@include('users.modal')

<table class="table table-striped" id="dataTableUserList">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome Completo</th>
            <th scope="col">E-mail</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <!--<a href="{{ route('users.show', $user) }}" id="showMore" value="{{ $user->id }}">Ver mais</a>-->
                    <button type="button" class="btn btn-link" value="{{ $user->id }}" onclick="event.preventDefault(); showMore({{ $user->id }});">Ver mais</button>
                    &nbsp; &nbsp;
                    <button type="button" class="btn btn-link text-danger" id="deleteBtn" value="{{ $user->id }}">Deletar</button>
                    <!--<a href="#" class="text-danger"
                           onclick="event.preventDefault(); document.getElementById('removeUser{{$user->id}}').submit()">Deletar</a>-->
                    <form action="{{ route("users.destroy", $user) }}"
                          method="post"
                          id="removeUser{{$user->id}}">
                        @method('delete')
                        @csrf
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">{{ $users->firstItem() }} até {{ $users->lastItem() }} de {{ $users->total() }}</td>
            <td colspan="10">{{ $users->links() }}</td>
        </tr>
    </tfoot>
</table>
