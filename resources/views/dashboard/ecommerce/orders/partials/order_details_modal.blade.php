<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailsLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details - #{{ $order->order_no }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- User Details -->
                <h6 class="mb-3">Customer Information</h6>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Name:</strong> {{ $order->user->first_name  }} {{ $order->user->last_name  }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $order->user->phone_number ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Address:</strong> {{ $order->user->address ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>City:</strong> {{ $order->user->city ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>State:</strong> {{ $order->user->state ?? 'N/A' }}</li>
                </ul>

                <!-- Order Summary -->
                <h6 class="mb-3">Order Summary</h6>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Delivery Method:</strong> {{ $order->delivery_method }}</li>
                    <li class="list-group-item"><strong>Delivery Fee:</strong> ₦{{ number_format($order->delivery_fee, 2) }}</li>
                    <li class="list-group-item"><strong>Subtotal:</strong> ₦{{ number_format($order->subtotal_price, 2) }}</li>
                    <li class="list-group-item"><strong>Total:</strong> ₦{{ number_format($order->total_price, 2) }}</li>
                    <li class="list-group-item"><strong>Payment Status:</strong>
                        <span class="badge bg-{{ $order->payment_status == 'Paid' ? 'success' : 'warning' }}">{{ $order->payment_status }}</span>
                    </li>
                    <li class="list-group-item"><strong>Order Status:</strong>
                        <span class="badge bg-{{ $order->status == 'Completed' ? 'success' : ($order->status == 'Pending' ? 'warning' : 'danger') }}">{{ $order->status }}</span>
                    </li>
                    <li class="list-group-item"><strong>Payment Method:</strong> {{ $order->payment_method }}</li>
                    <li class="list-group-item"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y h:i A') }}</li>
                </ul>

                <!-- Order Items Table -->
                <h6 class="mb-3">Order Items</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->product->product->name ?? 'N/A' }}</td>
                                    <td>{{ $item->product->size ?? 'N/A' }}</td>
                                    <td>₦{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₦{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
