@extends('base')

@php
    $page_title= "Tableau de bord Administrateur"
@endphp
@section('content')
    <div>
        <h3>Commandes</h3>
    </div>
    <div class="row align-items-center">
        <div class="col-md-6 col-12 row">
            <div class="col-md-6 col-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total</h4>
                        </div>
                        <div class="card-body">
                            {{ $nb_commandes }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-success">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Terminées</h4>
                        </div>
                        <div class="card-body">
                            {{ $nb_commandes }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-secondary">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>En cours</h4>
                        </div>
                        <div class="card-body">
                            {{ $nb_commandes }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card card-statistic-2 mt-0">
                    <div class="card-icon shadow-primary bg-danger">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Annulées</h4>
                        </div>
                        <div class="card-body">
                            {{ $nb_commandes }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">Montants
                        <div class="dropdown d-inline">
                            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">Aujourd'hui</a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a href="#" class="dropdown-item" active>Aujourd'hui</a></li>
                                <li><a href="#" class="dropdown-item" active>Cette semaine</a></li>
                                <li><a href="#" class="dropdown-item" active>Ce mois</a></li>
                                <li><a href="#" class="dropdown-item" active>Cette année</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">24000</div>
                            <div class="card-stats-item-label">En cours</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">12000</div>
                            <div class="card-stats-item-label">Terminées</div>
                        </div>
                        <div class="card-stats-item text-danger border">
                            <div class="card-stats-item-count">23000</div>
                            <div class="card-stats-item-label">Annulées</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Caisse</h4>
                    </div>
                    <div class="card-body">
                        59000 FCFA
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <h4>Point des commandes par type</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Format</th>
                        <th>Nbre</th>
                        <th>Montant (FCFA)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Grand Format</td>
                        <td>20</td>
                        <td>150000</td>
                    </tr>
                    <tr>
                        <td>Petit Format</td>
                        <td>30</td>
                        <td>25000</td>
                    </tr>
                    <tr>
                        <td>Gadgets</td>
                        <td>15</td>
                        <td>100000</td>
                    </tr>
                    <tr>
                        <td>Autres</td>
                        <td>15</td>
                        <td>100000</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Etat des commandes</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-danger">Voir plus <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tbody><tr>
                                    <th>N°</th>
                                    <th>Client</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><a href="#">INV-87239</a></td>
                                    <td class="font-weight-600">Mr Koffi</td>
                                    <td><div class="badge badge-warning">En cours</div></td>
                                    <td>23 Novembre 2023</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#">INV-48574</a></td>
                                    <td class="font-weight-600">Mme Kone</td>
                                    <td><div class="badge badge-success">Terminée</div></td>
                                    <td>23 Novembre 2023</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#">INV-48574</a></td>
                                    <td class="font-weight-600">Mr Seri</td>
                                    <td><div class="badge badge-danger">Non livrée</div></td>
                                    <td>23 Novembre 2023</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>

                                </tbody></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
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
