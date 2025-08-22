@extends('layouts.dashboard_master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Bulk Data Entry</h1>

    {{-- Tabs Navigation --}}
    <ul class="nav nav-tabs" id="bulkEntryTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="products-tab-link" data-toggle="tab" href="#products-tab" role="tab" aria-controls="products-tab" aria-selected="true">Products</a>
        </li>
        {{-- Other tabs... --}}
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

        {{-- ✅ START: Updated Products Tab --}}
        <div class="tab-pane fade show active" id="products-tab" role="tabpanel" aria-labelledby="products-tab-link">
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
                                        <th>Name (EN/AR)</th>
                                        <th>Code</th>
                                        <th>Price / After Discount</th>
                                        <th>Category / Brand</th>
                                        <th>Type / Parent</th>
                                        <th>Descriptions (Short & Full)</th>
                                        <th>Specifications</th>
                                        <th>Images</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="products-tbody">
                                    <tr>
                                        {{-- Names --}}
                                        <td>
                                            <input type="text" name="products[0][name]" class="form-control mb-2" placeholder="Name (EN)" required>
                                            <input type="text" name="products[0][name_ar]" class="form-control" placeholder="Name (AR)" required>
                                        </td>
                                        {{-- Code --}}
                                        <td><input type="text" name="products[0][code]" class="form-control" placeholder="Product Code"></td>
                                        {{-- Prices --}}
                                        <td>
                                            <input type="number" name="products[0][price]" class="form-control mb-2" placeholder="Price" step="0.01" required>
                                            <input type="number" name="products[0][price_after_discount]" class="form-control" placeholder="Price After Discount" step="0.01">
                                        </td>
                                        {{-- Category & Brand --}}
                                        <td>
                                            <select name="products[0][sub_category_id]" class="form-control mb-2" required>
                                                <option value="">Select SubCategory...</option>
                                                @foreach($subCategories as $sub)
                                                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                                @endforeach
                                            </select>
                                            <select name="products[0][brand_id]" class="form-control" required>
                                                <option value="">Select Brand...</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        {{-- Type & Parent --}}
                                        <td>
                                            <select name="products[0][type]" class="form-control product-type-select mb-2" required>
                                                <option value="main">Main</option>
                                                <option value="variation">Variation</option>
                                            </select>
                                            <select name="products[0][parent_product_id]" class="form-control parent-product-select" style="display: none;">
                                                <option value="">Select Parent Product...</option>
                                                {{-- Assuming $mainProducts is passed from controller --}}
                                                @isset($mainProducts)
                                                @foreach($mainProducts as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                                @endisset
                                            </select>
                                        </td>
                                        {{-- Descriptions --}}
                                        <td>
                                            <input type="text" name="products[0][small_description]" class="form-control mb-2" placeholder="Small Description (EN)" required>
                                            <input type="text" name="products[0][small_description_ar]" class="form-control mb-2" placeholder="Small Description (AR)" required>
                                            <textarea name="products[0][description]" class="form-control mb-2" placeholder="Full Description (EN)" rows="2" required></textarea>
                                            <textarea name="products[0][description_ar]" class="form-control" placeholder="Full Description (AR)" rows="2" required></textarea>
                                        </td>
                                        {{-- Specifications --}}
                                        <td>
                                            <div class="specifications-container">
                                                {{-- Dynamic specs will be added here --}}
                                            </div>
                                            <button type="button" class="btn btn-info btn-sm mt-2 add-spec-row">Add Spec</button>
                                        </td>
                                        {{-- Images --}}
                                        <td><input type="file" name="products[0][image][]" class="form-control-file" multiple></td>
                                        {{-- Action --}}
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
        </div>
        {{-- ✅ END: Updated Products Tab --}}


        {{-- Other Tab Panes for Categories, Sub-Categories, Brands... --}}
        {{-- ... Your existing code for other tabs ... --}}

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // A single, smart function to handle adding rows to ANY table
    function initializeDynamicTable(tableId) {
        const tableBody = document.getElementById(tableId);
        if (!tableBody || tableBody.rows.length === 0) return;

        // Clone the first row to use as a template
        const rowTemplate = tableBody.rows[0].cloneNode(true);
        // Clear specs in the template
        rowTemplate.querySelector('.specifications-container').innerHTML = '';
        let rowIndex = tableBody.rows.length;

        const addButton = document.querySelector(`.add-row[data-table-id="${tableId}"]`);

        addButton.addEventListener('click', function () {
            const newRow = rowTemplate.cloneNode(true);
            const baseName = tableId.split('-')[0]; // 'products', 'categories', etc.

            newRow.querySelectorAll('input, select, textarea').forEach(input => {
                // Update the name attribute for the new row index
                if (input.name) {
                    input.name = input.name.replace(new RegExp(`${baseName}\\[\\d+\\]`), `${baseName}[${rowIndex}]`);
                }

                // Clear the values for the new row
                if (input.type === 'file') {
                    input.value = ''; // This doesn't fully clear it, but it's the standard way
                } else if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0; // Reset select to the first option
                } else {
                    input.value = '';
                }
            });

            // Hide parent product select by default in new rows
            const parentSelect = newRow.querySelector('.parent-product-select');
            if(parentSelect) {
                parentSelect.style.display = 'none';
            }

            tableBody.appendChild(newRow);
            rowIndex++;
        });

        // Event delegation for actions inside the table body
        tableBody.addEventListener('click', function (e) {
            // Handle removing a product row
            if (e.target.classList.contains('remove-row')) {
                if (tableBody.rows.length > 1) {
                    e.target.closest('tr').remove();
                } else {
                    alert('You must have at least one row.');
                }
            }

            // Handle adding a specification row
            if (e.target.classList.contains('add-spec-row')) {
                const specContainer = e.target.previousElementSibling;
                const productRow = e.target.closest('tr');
                const productIndex = Array.from(tableBody.children).indexOf(productRow);
                const specIndex = specContainer.children.length;

                const specHtml = `
                    <div class="input-group mb-2 spec-group">
                        <input type="text" name="products[${productIndex}][specifications][${specIndex}][key]" class="form-control" placeholder="Key (EN)">
                        <input type="text" name="products[${productIndex}][specifications][${specIndex}][value]" class="form-control" placeholder="Value (EN)">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-spec-row">X</button>
                        </div>
                    </div>
                `;
                specContainer.insertAdjacentHTML('beforeend', specHtml);
            }

            // Handle removing a specification row
            if (e.target.classList.contains('remove-spec-row')) {
                e.target.closest('.spec-group').remove();
            }
        });

        // Event delegation for changing product type
        tableBody.addEventListener('change', function(e) {
            if (e.target.classList.contains('product-type-select')) {
                const parentSelect = e.target.closest('td').querySelector('.parent-product-select');
                if (e.target.value === 'variation') {
                    parentSelect.style.display = 'block';
                } else {
                    parentSelect.style.display = 'none';
                    parentSelect.value = ''; // Clear value when hiding
                }
            }
        });
    }

    // Initialize all tables on the page
    initializeDynamicTable('products-tbody');
    // initializeDynamicTable('categories-tbody');
    // initializeDynamicTable('subcategories-tbody');
    // initializeDynamicTable('brands-tbody');
});
</script>
@endsection
