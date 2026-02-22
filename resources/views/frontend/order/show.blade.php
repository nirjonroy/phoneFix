<div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">Order Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @forelse($order->orderProducts as $item)
                                    <tr class="">
                                        <td scope="row">Product Image</td>
                                        <td><img src="{{ asset($item->product->thumb_image) }}" alt="" height="100"></td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Order ID</td>
                                        <td>{{ $order->order_id }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Product Name</td>
                                        <td>{{ $item->product->name }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Product Price</td>
                                        <td>{{ $item->unit_price }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Product Quantity</td>
                                        <td>{{ $item->qty }}</td>
                                    </tr>
                                    <tr class="d-none">
                                        <td scope="row">Action</td>
                                        <td><button class="btn btn-danger border-0 rounded-0"><i class="fas fa-delete-left"></i> Remove Order</button></td>
                                    </tr>
                                    @empty
                                    <div>
                                        <strong class="text-danger text-center">
                                            No products are available!
                                        </strong>
                                    </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>