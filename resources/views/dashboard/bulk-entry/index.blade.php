@extends('layouts.dashboard_master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Bulk Data Entry</h1>

    <ul class="nav nav-tabs" id="bulkEntryTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="products-tab-link" data-toggle="tab" href="#products-tab" role="tab" aria-controls="products-tab" aria-selected="true">Products</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="categories-tab-link" data-toggle="tab" href="#categories-tab" role="tab" aria-controls="categories-tab" aria-selected="false">Categories</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="subcategories-tab-link" data-toggle="tab" href="#subcategories-tab" role="tab" aria-controls="subcategories-tab" aria-selected="false">Sub-Categories</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="brands-tab-link" data-toggle="tab" href="#brands-tab" role="tab" aria-controls="brands-tab" aria-selected="false">Brands</a>
        </li>
    </ul>

    <div class="tab-content" id="bulkEntryTabsContent">

        <div class="tab-pane fade show active" id="products-tab" role="tabpanel" aria-labelledby="products-tab-link">
            {{-- ✅ START: Restored Products Form --}}
            <form action="{{ route('products.bulk.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Bulk Products</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="products-table">
                                <thead>
                                    <tr>
                                        <th>Name (EN)</th>
                                        <th>Name (AR)</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>SubCategory</th>
                                        <th>Images</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="products-tbody">
                                    <tr>
                                        <td><input type="text" name="products[0][name]" class="form-control" required></td>
                                        <td><input type="text" name="products[0][name_ar]" class="form-control" required></td>
                                        <td><input type="number" name="products[0][price]" class="form-control" step="0.01" required></td>
                                        <td><input type="number" name="products[0][quantity]" class="form-control" required></td>
                                        <td>
                                            <select name="products[0][sub_category_id]" class="form-control" required>
                                                @foreach($subCategories as $sub)
                                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="file" name="products[0][images][]" class="form-control-file" multiple></td>
                                        <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary mt-3 add-row" data-table-id="products-tbody">Add Product Row</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Save All Products</button>
            </form>
            {{-- ✅ END: Restored Products Form --}}
        </div>

        <div class="tab-pane fade" id="categories-tab" role="tabpanel" aria-labelledby="categories-tab-link">
           {{-- ✅ START: Restored Categories Form --}}
           <form action="{{ route('categories.bulk.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="card shadow">
                    <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">Bulk Categories</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="categories-table">
                            <thead>
                                <tr>
                                    <th>Name (EN)</th>
                                    <th>Name (AR)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="categories-tbody">
                                <tr>
                                    <td><input type="text" name="categories[0][name]" class="form-control" required></td>
                                    <td><input type="text" name="categories[0][name_ar]" class="form-control" required></td>
                                    <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary mt-3 add-row" data-table-id="categories-tbody">Add Category Row</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Save All Categories</button>
            </form>
           {{-- ✅ END: Restored Categories Form --}}
        </div>

        <div class="tab-pane fade" id="subcategories-tab" role="tabpanel" aria-labelledby="subcategories-tab-link">
            {{-- ✅ START: Restored Sub-Categories Form --}}
            <form action="{{ route('subcategories.bulk.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Bulk Sub-Categories</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="subcategories-table">
                            <thead>
                                <tr>
                                    <th>Name (EN)</th>
                                    <th>Name (AR)</th>
                                    <th>Parent Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="subcategories-tbody">
                                <tr>
                                    <td><input type="text" name="subcategories[0][name]" class="form-control" required></td>
                                    <td><input type="text" name="subcategories[0][name_ar]" class="form-control" required></td>
                                    <td>
                                        <select name="subcategories[0][category_id]" class="form-control" required>
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary mt-3 add-row" data-table-id="subcategories-tbody">Add Sub-Category Row</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Save All Sub-Categories</button>
            </form>
            {{-- ✅ END: Restored Sub-Categories Form --}}
        </div>

        <div class="tab-pane fade" id="brands-tab" role="tabpanel" aria-labelledby="brands-tab-link">
            <form action="{{ route('brands.bulk.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Bulk Brands</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="brands-table">
                            <thead>
                                <tr>
                                    <th>Name (EN)</th>
                                    <th>Name (AR)</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="brands-tbody">
                                <tr>
                                    <td><input type="text" name="brands[0][name]" class="form-control" required></td>
                                    <td><input type="text" name="brands[0][name_ar]" class="form-control"></td>
                                    <td><input type="file" name="brands[0][image]" class="form-control-file"></td>
                                    <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary mt-3 add-row" data-table-id="brands-tbody">Add Brand Row</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Save All Brands</button>
            </form>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // A single, smart function to handle adding rows to ANY table
    function initializeDynamicTable(tableId) {
        const tableBody = document.getElementById(tableId);
        if (!tableBody || tableBody.rows.length === 0) return;

        const rowTemplate = tableBody.rows[0].cloneNode(true);
        let rowIndex = 1;

        const addButton = document.querySelector(`.add-row[data-table-id="${tableId}"]`);

        addButton.addEventListener('click', function () {
            const newRow = rowTemplate.cloneNode(true);
            const baseName = tableId.split('-')[0]; // 'products', 'categories', etc.

            newRow.querySelectorAll('input, select').forEach(input => {
                input.name = input.name.replace(new RegExp(`${baseName}\\[\\d+\\]`), `${baseName}[${rowIndex}]`);
                if(input.type !== 'file') {
                    input.value = '';
                } else {
                    // Clear file input by cloning it
                    const newFileInput = input.cloneNode(true);
                    newFileInput.value = '';
                    input.parentNode.replaceChild(newFileInput, input);
                }
            });
            tableBody.appendChild(newRow);
            rowIndex++;
        });

        tableBody.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row')) {
                if (tableBody.rows.length > 1) {
                    e.target.closest('tr').remove();
                } else {
                    alert('You must have at least one row.');
                }
            }
        });
    }

    // Initialize all tables on the page
    initializeDynamicTable('products-tbody');
    initializeDynamicTable('categories-tbody');
    initializeDynamicTable('subcategories-tbody');
    initializeDynamicTable('brands-tbody');
});
</script>
@endsection
