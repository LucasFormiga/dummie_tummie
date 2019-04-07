@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
            <div class="card card-home">
                <div class="card-body">

                <div class="card">
                    <div class="card-body">
                        <h5>Usuários por Sexo</h5>

                        <div id="canvas-holder" class="mx-auto" style="width:50%">
                            <canvas id="chart-area"></canvas>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="card">
                    <div class="card-body">
                        <h5>Últimos Logins <small>5 últimos</small></h5>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">User Agent</th>
                                    <th scope="col">IP</th>
                                    <th scope="col">Data e Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $log->email }}</td>
                                    <td>{{ $log->user_agent }}</td>
                                    <td>{{ $log->ip }}</td>
                                    <td>{{ date("d/m/Y H:i:s", strtotime($log->event_date)) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="card">
                    <div class="card-body">
                        <h5>Seus Logins <small>5 últimos</small></h5>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">User Agent</th>
                                    <th scope="col">IP</th>
                                    <th scope="col">Data e Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($userLogs as $log)
                                <tr>
                                    <td>{{ $log->user_agent }}</td>
                                    <td>{{ $log->ip }}</td>
                                    <td>{{ date("d/m/Y H:i:s", strtotime($log->event_date)) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
const ctx = document.getElementById('chart-area');
console.log(ctx);

let myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Masculino', 'Feminino', 'Outro'],
        datasets: [{
            data: [{{ $men }}, {{ $women }}, {{ $other }}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
        }],
    },
    options: {
		responsive: true
	}
});
</script>
@endsection
