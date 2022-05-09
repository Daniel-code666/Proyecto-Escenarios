@extends('layouts.app')

@section('content')
    @include('layouts.headers.sharedmargin')
    <h2 class="text-center fw-bold mt-2">Escenarios</h2>
    <div class="row">
        <div class="col-md-4">
            <a type="button" class="btn btn-primary" href="{{ route('stage.add') }}">Crear escenario</a>
        </div>

    </div>
    <hr>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="sort" data-sort="name">Project</th>
              <th scope="col" class="sort" data-sort="budget">Budget</th>
              <th scope="col" class="sort" data-sort="status">Status</th>
              <th scope="col">Users</th>
              <th scope="col" class="sort" data-sort="completion">Completion</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="list">
            
            <tr>
              <th scope="row">
                <div class="media align-items-center">
                  <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="../assets/img/theme/vue.jpg">
                  </a>
                  <div class="media-body">
                    <span class="name mb-0 text-sm">Vue Paper UI Kit PRO</span>
                  </div>
                </div>
              </th>
              <td class="budget">
                $2200 USD
              </td>
              <td>
                <span class="badge badge-dot mr-4">
                  <i class="bg-success"></i>
                  <span class="status">completed</span>
                </span>
              </td>
              <td>
                <div class="avatar-group">
                  <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                    <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                  </a>
                  <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                    <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                  </a>
                  <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                    <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                  </a>
                  <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                    <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                  </a>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="completion mr-2">100%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                  </div>
                </div>
              </td>
              <td class="text-right">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#">Detalle</a>
                    <a class="dropdown-item" href="#">Editar</a>
                    <a class="dropdown-item" href="#">Eliminar</a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush