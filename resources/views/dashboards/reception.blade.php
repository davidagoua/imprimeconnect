@extends('base')

@php
    $page_title= "Table de bord Secretaire"
@endphp
@section('content')
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Commandes</h4>
                    </div>
                    <div class="card-body">
                        13
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Balance</h4>
                    </div>
                    <div class="card-body">
                        $187,13
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Balance</h4>
                    </div>
                    <div class="card-body">
                        $187,13
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <h4>Résumé des commandes par format</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Format</th>
                        <th>Commandes</th>
                        <th>Impressions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Grand</td>
                        <td>20</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>Moyen</td>
                        <td>30</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <td>Petit</td>
                        <td>15</td>
                        <td>10</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-3">
                <h4>Résumé des commandes par format</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Format</th>
                        <th>Commandes</th>
                        <th>Impressions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Grand</td>
                        <td>20</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>Moyen</td>
                        <td>30</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <td>Petit</td>
                        <td>15</td>
                        <td>10</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <h4>Graphique de commandes par jour</h4>
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'],
                datasets: [{
                    label: 'Commandes par jour',
                    data: [10, 20, 15, 25, 18],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
