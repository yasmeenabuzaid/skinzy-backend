@extends('layouts.dashboard_master')

@section('content')

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-octagon me-1"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif



    <div class="main-panel"  style="margin: 30px 0px">

        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Payments Overview </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payments</li>
              </ol>
            </nav>
          </div>
          <section class="section">
            <div class="row">
              <div class="col-lg-12">

                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"></h5>

                    <!-- Table with stripped rows -->
                    <table class="table">
            <thead >
              <tr>
                <th>#</th>
                <th>User</th>
                <th>Order number</th>
                <th>Payment ID</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Method</th>
                <th>Card</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
                @if($payments->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">No Data Available</td>
                </tr>
            @else
              @foreach($payments as $payment)
              <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->user?->Fname }} {{ $payment->user?->Lname }}</td>
                <td>
                    @if($payment->order_id)
                      <a href="{{ route('order.show', $payment->order_id) }}" class="text-decoration-underline text-primary">
                        {{ $payment->order_id }}
                      </a>
                    @else
                      <span class="text-muted">N/A</span>
                    @endif
                  </td>

                <td>{{ $payment->payment_id }}</td>
                <td>
                  <span class="badge bg-{{
                    $payment->status === 'COMPLETED' ? 'success' :
                    ($payment->status === 'pending' ? 'warning text-dark' :
                    'danger') }}">
                    {{ ucfirst($payment->status) }}
                  </span>
                </td>
                <td>{{ number_format($payment->amount / 100, 2) }}</td>
                <td>{{ strtoupper($payment->currency) }}</td>
                <td>{{ $payment->payment_method ?? 'N/A' }}</td>
                <td>
                  @if($payment->card_brand)
                    <span>{{ strtoupper($payment->card_brand) }} •••• {{ $payment->card_last_4 }}</span>
                  @else
                    <span>N/A</span>
                  @endif
                </td>
                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>

          </div>
          <!-- main-panel ends -->

        </div>
      </div>
    </div>
  </div>
</section>

<!-- Confirmation Modal -->
<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
  <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
    <p>Are you sure you want to delete this order?</p>
    <button id="confirmButton" class="btn btn-outline-danger">Delete</button>
    <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
  </div>
</div>

<script>
  function confirmDeletion(event, url) {
      event.preventDefault();
      const modal = document.getElementById('confirmationModal');
      const confirmButton = document.getElementById('confirmButton');
      const cancelButton = document.getElementById('cancelButton');

      modal.style.display = 'flex';

      confirmButton.onclick = function () {
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = url;

          const csrfToken = document.createElement('input');
          csrfToken.type = 'hidden';
          csrfToken.name = '_token';
          csrfToken.value = '{{ csrf_token() }}';
          form.appendChild(csrfToken);

          const methodField = document.createElement('input');
          methodField.type = 'hidden';
          methodField.name = '_method';
          methodField.value = 'DELETE';
          form.appendChild(methodField);

          document.body.appendChild(form);
          form.submit();
      };

      cancelButton.onclick = function () {
          modal.style.display = 'none';
      };
  }
</script>

@endsection
