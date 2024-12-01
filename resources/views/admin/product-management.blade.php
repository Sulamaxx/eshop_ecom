@extends('layout.admin-app')

@section('content')
    <div class="container py-5 pm-container">
        <!-- Product Management Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 pm-header">
            <h4>Product Management</h4>
            <button class="btn btn-success pm-add-product-btn" data-toggle="modal" data-target="#addProductModal">Add New
                Product</button>
        </div>

        <!-- Product Table -->
        <div class="table-responsive pm-table-container">
            <table class="table table-striped pm-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>${{ $product->cost_price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td><span
                                    class="badge text-white badge-{{ $product->status === 'active' ? 'success' : 'warning' }} pm-badge-active">
                                    {{ ucfirst($product->status) }}
                                </span></td>
                            <td>
                                <button class="btn btn-warning pm-btn-edit" data-toggle="modal"
                                    data-target="#editProductModal" data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}" data-brand="{{ $product->brand }}"
                                    data-cost_price="{{ $product->cost_price }}"
                                    data-selling_price="{{ $product->selling_price }}"
                                    data-quantity="{{ $product->quantity }}"
                                    data-description="{{ $product->description }}"
                                    data-image1="{{ asset('storage/' . $product->image1) }}"
                                    data-image2="{{ asset('storage/' . $product->image2) }}"
                                    data-image3="{{ asset('storage/' . $product->image3) }}">
                                    Edit
                                </button>
                                <form action="{{ route('product-management.destroy', $product->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger pm-btn-delete">Delete</button>
                                </form>

                                @if ($product->status === 'Active')
                                    <form action="{{ route('product-management.deactivate', $product->id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-secondary pm-btn-deactivate">Deactivate</button>
                                    </form>
                                @else
                                    <form action="{{ route('product-management.activate', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary pm-btn-deactivate">Activate</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- Add Product Modal -->
        <div class="modal fade pm-modal" id="addProductModal" tabindex="-1" role="dialog"
            aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog pm-modal-dialog" role="document">
                <div class="modal-content pm-modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addProductForm" method="POST" action="{{ route('product-management.store') }}"
                            enctype="multipart/form-data" class="pm-form">
                            @csrf
                            <div class="form-group pm-form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" id="productName"
                                    value="{{ old('productName') }}" name="productName">
                            </div>
                            <div class="form-group pm-form-group">
                                <label for="productBrand">Brand</label>
                                <input type="text" class="form-control" value="{{ old('productBrand') }}"
                                    id="productBrand" name="productBrand">
                            </div>
                            <div class="form-group pm-form-group">
                                <label for="productPrice">Cost Price</label>
                                <input type="number" class="form-control" value="{{ old('productCostPrice') }}"
                                    id="productCostPrice" name="productCostPrice">
                            </div>
                            <div class="form-group pm-form-group">
                                <label for="productPrice">Selling Price</label>
                                <input type="number" class="form-control" value="{{ old('productSellingPrice') }}"
                                    id="productSellingPrice" value="{{ old('productSellingPrice') }}"
                                    name="productSellingPrice">
                            </div>
                            <div class="form-group pm-form-group">
                                <label for="productQuantity">Quantity</label>
                                <input type="number" value="{{ old('productQuantity') }}" class="form-control"
                                    id="productQuantity" name="productQuantity">
                            </div>
                            <div class="form-group pm-form-group">
                                <label for="productDescription">Description</label>
                                <textarea name="productDescription" id="productDescription" class="form-control" cols="30" rows="10">{{ old('productDescription') }}</textarea>
                            </div>

                            <!-- Image Upload Section -->
                            <div class="form-group pm-form-group">
                                <label>Upload Images</label>
                                <div class="image-upload-container">
                                    <div class="image-box" onclick="document.getElementById('imageUpload1').click()">
                                        <input type="file" id="imageUpload1" name="imageUpload1" accept="image/*"
                                            onchange="previewImage(event, 1)">
                                        <img id="preview1" src="#" alt="Upload Image" style="display: none;">
                                        <span class="placeholder-text">Upload Image 1</span>
                                    </div>
                                    <div class="image-box" onclick="document.getElementById('imageUpload2').click()">
                                        <input type="file" id="imageUpload2" name="imageUpload2" accept="image/*"
                                            onchange="previewImage(event, 2)">
                                        <img id="preview2" src="#" alt="Upload Image" style="display: none;">
                                        <span class="placeholder-text">Upload Image 2</span>
                                    </div>
                                    <div class="image-box" onclick="document.getElementById('imageUpload3').click()">
                                        <input type="file" id="imageUpload3" name="imageUpload3" accept="image/*"
                                            onchange="previewImage(event, 3)">
                                        <img id="preview3" src="#" alt="Upload Image" style="display: none;">
                                        <span class="placeholder-text">Upload Image 3</span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary pm-btn-submit">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal -->
        <div class="modal fade pm-modal" id="editProductModal" tabindex="-1" role="dialog"
            aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog pm-modal-dialog" role="document">
                <div class="modal-content pm-modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editProductForm" method="POST" action="{{ route('product-management.update') }}"
                            enctype="multipart/form-data" class="pm-form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="productId" name="productId">

                            <div class="form-group pm-form-group">
                                <label for="editProductName">Product Name</label>
                                <input type="text" class="form-control" id="editProductName" name="productName">
                            </div>
                            <div class="form-group pm-form-group">
                                <label for="editProductBrand">Brand</label>
                                <input type="text" class="form-control" id="editProductBrand" name="productBrand">
                            </div>
                            <div class="form-group pm-form-group">
                                <label for="editProductCostPrice">Cost Price</label>
                                <input type="number" class="form-control" id="editProductCostPrice"
                                    name="productCostPrice">
                            </div>
                            <div class="form-group pm-form-group">
                                <label for="editProductSellingPrice">Selling Price</label>
                                <input type="number" class="form-control" id="editProductSellingPrice"
                                    name="productSellingPrice">
                            </div>
                            <div class="form-group pm-form-group">
                                <label for="editProductQuantity">Quantity</label>
                                <input type="number" class="form-control" id="editProductQuantity"
                                    name="productQuantity">
                            </div>
                            <div class="form-group pm-form-group">
                                <label for="editProductDescription">Description</label>
                                <textarea id="editProductDescription" name="productDescription" class="form-control" cols="30" rows="10"></textarea>
                            </div>

                            <!-- Image Upload Section -->
                            <div class="form-group pm-form-group">
                                <label>Upload Images</label>
                                <div class="image-upload-container">
                                    <div class="image-box" onclick="document.getElementById('imageUpload4').click()">
                                        <input type="file" id="imageUpload4" name="imageUpload4" accept="image/*"
                                            onchange="previewImage(event, 4)">
                                        <img id="preview4" src="#" alt="Upload Image" style="display: none;">
                                        <span class="placeholder-text">Upload Image 1</span>
                                    </div>
                                    <div class="image-box" onclick="document.getElementById('imageUpload5').click()">
                                        <input type="file" id="imageUpload5" name="imageUpload5" accept="image/*"
                                            onchange="previewImage(event, 5)">
                                        <img id="preview5" src="#" alt="Upload Image" style="display: none;">
                                        <span class="placeholder-text">Upload Image 2</span>
                                    </div>
                                    <div class="image-box" onclick="document.getElementById('imageUpload6').click()">
                                        <input type="file" id="imageUpload6" name="imageUpload6" accept="image/*"
                                            onchange="previewImage(event, 6)">
                                        <img id="preview6" src="#" alt="Upload Image" style="display: none;">
                                        <span class="placeholder-text">Upload Image 3</span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning pm-btn-submit">Save Changes</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        function isImageUrl(url) {
            return /\.(jpg|jpeg|png|gif|bmp|webp)$/i.test(url);
        }

        $(document).ready(function() {
            @if (session('error'))
                var errorMessage = "{{ session('error') }}";
                if (errorMessage.includes("Failed to add product")) {
                    $('#addProductModal').modal('show');
                }
            @endif
        });

        $('#editProductModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var brand = button.data('brand');
            var cost_price = button.data('cost_price');
            var selling_price = button.data('selling_price');
            var quantity = button.data('quantity');
            var description = button.data('description');
            var image1 = button.data('image1');
            var image2 = button.data('image2');
            var image3 = button.data('image3');
            console.log(image1)
            console.log(image2)
            console.log(image3)
            var modal = $(this);

            setTimeout(function() {
                modal.find('#productId').val(id);
                modal.find('#editProductName').val(name);
                modal.find('#editProductBrand').val(brand);
                modal.find('#editProductCostPrice').val(parseInt(cost_price));
                modal.find('#editProductSellingPrice').val(parseInt(selling_price));
                modal.find('#editProductQuantity').val(parseInt(quantity));
                modal.find('#editProductDescription').val(String(description));

                var defaultImageUrl = "{{ asset('storage/img/images.jpg') }}";
                modal.find('#preview4').attr('src', isImageUrl(image1) ? image1 : defaultImageUrl).show();
                modal.find('#preview5').attr('src', isImageUrl(image2) ? image2 : defaultImageUrl).show();
                modal.find('#preview6').attr('src', isImageUrl(image3) ? image3 : defaultImageUrl).show();
            }, 100);
        });
    </script>
@endpush
