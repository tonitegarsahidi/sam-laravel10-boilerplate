@extends('admin.template-index')

@section('header-title')
    Sample of Pages with Charts
@endsection

@section('header-code')
@endsection

@section('main-content')
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                <div class="mdc-card">
                    <h6 class="card-title">Line chart</h6>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                <div class="mdc-card">
                    <h6 class="card-title">Bar chart</h6>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                <div class="mdc-card">
                    <h6 class="card-title">Area chart</h6>
                    <canvas id="areaChart"></canvas>
                </div>
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                <div class="mdc-card">
                    <h6 class="card-title">Doughnut chart</h6>
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                <div class="mdc-card">
                    <h6 class="card-title">Pie chart</h6>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                <div class="mdc-card">
                    <h6 class="card-title">Scatter chart</h6>
                    <canvas id="scatterChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-code')
    <script src="{{ asset('assets/js/chartjs.js') }}"></script>
@endsection
