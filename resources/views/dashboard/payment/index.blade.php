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

<div class="main-panel" style="margin: 30px 0px">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Payments Overview</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payments</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Payment Proofs</h5>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>User</th>
                                            <th>Order</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($proofs as $proof)
                                        <tr>
                                            <td>
                                                <!-- Thumbnail triggers image modal -->
                                                <img src="{{ $proof->image }}" width="80" class="img-thumbnail" alt="Payment Proof"
                                                     style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#imageModal{{ $proof->id }}">
                                            </td>
                                            <td>{{ $proof->user->Fname ?? '-' }} {{ $proof->user->Lname ?? '-' }}</td>
<td>
  <a href="{{ route('order.show', $proof->order_id) }}">
    #{{ $proof->order_id }}
  </a>
</td>
                                            <td>{{ $proof->paid_amount !== null ? number_format($proof->paid_amount, 2) : '-' }}</td>
                                            <td>{{ $proof->payment_method ?? '-' }}</td>
                                            <td>
                                                @php
                                                    $statusClass = match($proof->status) {
                                                        'pending' => 'warning text-dark',
                                                        'accepted' => 'success',
                                                        'rejected' => 'danger',
                                                        default => 'secondary'
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $statusClass }}">
                                                    {{ ucfirst($proof->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $proof->id }}">
                                                    Details
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Image Modal -->
                                        <div class="modal fade" id="imageModal{{ $proof->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $proof->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel{{ $proof->id }}">Payment Proof Image</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ $proof->image }}" class="img-fluid" alt="Payment Proof Full Size">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Details Modal with tabs -->
                                        <div class="modal fade" id="detailsModal{{ $proof->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $proof->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailsModalLabel{{ $proof->id }}">Payment Proof Details #{{ $proof->id }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Nav tabs -->
                                                        <ul class="nav nav-tabs" id="tabMenu{{ $proof->id }}" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link active" id="details-tab-{{ $proof->id }}" data-bs-toggle="tab" data-bs-target="#details{{ $proof->id }}" type="button" role="tab" aria-controls="details{{ $proof->id }}" aria-selected="true">Details</button>
                                                            </li>
                                                            @if($proof->status === 'pending')
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="review-tab-{{ $proof->id }}" data-bs-toggle="tab" data-bs-target="#review{{ $proof->id }}" type="button" role="tab" aria-controls="review{{ $proof->id }}" aria-selected="false">Review</button>
                                                            </li>
                                                            @endif
                                                        </ul>

                                                        <!-- Tab panes -->
                                                        <div class="tab-content pt-3" id="tabContent{{ $proof->id }}">
                                                            <div class="tab-pane fade show active" id="details{{ $proof->id }}" role="tabpanel" aria-labelledby="details-tab-{{ $proof->id }}">
                                                                <p><strong>Transaction ID:</strong> {{ $proof->transaction_id ?? '-' }}</p>
                                                                <p><strong>Bank Name:</strong> {{ $proof->bank_name ?? '-' }}</p>
                                                                <p><strong>Account Number:</strong> {{ $proof->account_number ?? '-' }}</p>
                                                                <p><strong>Paid At:</strong>
                                                                    @if($proof->paid_at)
                                                                        @php
                                                                            try {
                                                                                $paidAt = $proof->paid_at instanceof \Illuminate\Support\Carbon
                                                                                    ? $proof->paid_at
                                                                                    : \Carbon\Carbon::parse($proof->paid_at);
                                                                                echo $paidAt->format('Y-m-d H:i');
                                                                            } catch (\Exception $e) {
                                                                                echo '-';
                                                                            }
                                                                        @endphp
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </p>
                                                                <p><strong>Reviewed By:</strong> {{ $proof->reviewedBy?->name ?? '-' }}</p>
                                                                <p><strong>Reviewed At:</strong>
                                                                    @if($proof->reviewed_at)
                                                                        @php
                                                                            try {
                                                                                $reviewedAt = $proof->reviewed_at instanceof \Illuminate\Support\Carbon
                                                                                    ? $proof->reviewed_at
                                                                                    : \Carbon\Carbon::parse($proof->reviewed_at);
                                                                                echo $reviewedAt->format('Y-m-d H:i');
                                                                            } catch (\Exception $e) {
                                                                                echo '-';
                                                                            }
                                                                        @endphp
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </p>
                                                                <p><strong>Note:</strong> {{ $proof->note ?? '-' }}</p>
                                                                <p><strong>Details:</strong> {{ $proof->details ?? '-' }}</p>
                                                            </div>

                                                            @if($proof->status === 'pending')
                                                            <div class="tab-pane fade" id="review{{ $proof->id }}" role="tabpanel" aria-labelledby="review-tab-{{ $proof->id }}">
                                                                <form action="{{ route('payment-proofs.review', $proof) }}" method="POST">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="statusSelect{{ $proof->id }}" class="form-label">Change Status</label>
                                                                        <select name="status" id="statusSelect{{ $proof->id }}" class="form-select" required>
                                                                            <option value="" disabled selected>Select status</option>
                                                                            <option value="accepted">Accept</option>
                                                                            <option value="rejected">Reject</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="noteTextarea{{ $proof->id }}" class="form-label">Note (optional)</label>
                                                                        <textarea name="note" id="noteTextarea{{ $proof->id }}" class="form-control" rows="3" placeholder="Add a note..."></textarea>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                                                </form>
                                                            </div>
                                                            @else
                                                            <div class="tab-pane fade" id="review{{ $proof->id }}" role="tabpanel" aria-labelledby="review-tab-{{ $proof->id }}">
                                                                <div class="alert alert-info">
                                                                    This payment proof has been reviewed.
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- table-responsive -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>

@endsection
