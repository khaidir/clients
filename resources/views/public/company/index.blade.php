@include('layouts.public.header')
@include('layouts.public.sidebar')
<div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
    <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
        <div id="kt_app_toolbar" class="app-toolbar  py-6 ">
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex align-items-start ">
                <div class="d-flex flex-column flex-row-fluid">
                    <div class="d-flex align-items-center pt-1">
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                            <li class="breadcrumb-item text-white fw-bold lh-1">
                                <a href="/metronic8/demo30/index.html" class="text-white text-hover-primary">
                                    <i class="ki-outline ki-home text-white fs-3"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="ki-outline ki-right fs-4 text-white mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-white fw-bold lh-1"> Dashboard </li>
                            <li class="breadcrumb-item">
                                <i class="ki-outline ki-right fs-4 text-white mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-white fw-bold lh-1"> Company </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-6 pb-18 py-lg-13">
                        <div class="page-title d-flex align-items-center me-3">
                            <img alt="Logo" src="/assets/media/svg/misc/layer.svg" class="h-60px me-5">
                            <h1 class="page-heading d-flex text-white fw-bolder fs-2 flex-column justify-content-center my-0"> Company <span class="page-desc text-white opacity-50 fs-6 fw-bold pt-4"> Please field Company Complete </span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-container  container-xxl ">
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_content" class="app-content ">
                        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" data-kt-redirect="/metronic8/demo30/apps/ecommerce/catalog/products.html">
                            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Thumbnail</h2>
                                        </div>
                                    </div>
                                    <div class="card-body text-center pt-0">
                                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                            <div class="image-input-wrapper w-150px h-150px"></div>
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                                <i class="ki-outline ki-pencil fs-7"></i>
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                                <input type="hidden" name="avatar_remove">
                                            </label>
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                                <i class="ki-outline ki-cross fs-2"></i>
                                            </span>
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                                <i class="ki-outline ki-cross fs-2"></i>
                                            </span>
                                        </div>
                                        <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general" aria-selected="true" role="tab">General</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced" aria-selected="false" tabindex="-1" role="tab">Advanced</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>General</h2>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="fv-row fv-plugins-icon-container">
                                                        <label class="required form-label">Product Name</label>
                                                        <input type="text" name="product_name" class="form-control mb-2" placeholder="Product name" value="">
                                                        <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>Media</h2>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="fv-row mb-2">
                                                        <div class="dropzone dz-clickable" id="kt_ecommerce_add_product_media">
                                                            <div class="dz-message needsclick">
                                                                <i class="ki-outline ki-file-up text-primary fs-3x"></i>
                                                                <div class="ms-4">
                                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                                    <span class="fs-7 fw-semibold text-gray-500">Upload up to 10 files</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-muted fs-7">Set the product media gallery.</div>
                                                </div>
                                            </div>
                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>Pricing</h2>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <label class="required form-label">Base Price</label>
                                                        <input type="text" name="price" class="form-control mb-2" placeholder="Product price" value="">
                                                        <div class="text-muted fs-7">Set the product price.</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="fv-row mb-10">
                                                        <label class="fs-6 fw-semibold mb-2"> Discount Type <span class="ms-1" data-bs-toggle="tooltip" aria-label="Select a discount type that will be applied to this product" data-bs-original-title="Select a discount type that will be applied to this product" data-kt-initialized="1">
                                                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                            </span>
                                                        </label>
                                                        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']" data-kt-initialized="1">
                                                            <div class="col">
                                                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                                                                    <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                        <input class="form-check-input" type="radio" name="discount_option" value="1" checked="checked">
                                                                    </span>
                                                                    <span class="ms-5">
                                                                        <span class="fs-4 fw-bold text-gray-800 d-block">No Discount</span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                            <div class="col">
                                                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary  d-flex text-start p-6" data-kt-button="true">
                                                                    <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                        <input class="form-check-input" type="radio" name="discount_option" value="2">
                                                                    </span>
                                                                    <span class="ms-5">
                                                                        <span class="fs-4 fw-bold text-gray-800 d-block">Percentage %</span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                            <div class="col">
                                                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                                                    <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                        <input class="form-check-input" type="radio" name="discount_option" value="3">
                                                                    </span>
                                                                    <span class="ms-5">
                                                                        <span class="fs-4 fw-bold text-gray-800 d-block">Fixed Price</span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_percentage">
                                                        <label class="form-label">Set Discount Percentage</label>
                                                        <div class="d-flex flex-column text-center mb-5">
                                                            <div class="d-flex align-items-start justify-content-center mb-7">
                                                                <span class="fw-bold fs-3x" id="kt_ecommerce_add_product_discount_label">10</span>
                                                                <span class="fw-bold fs-4 mt-1 ms-2">%</span>
                                                            </div>
                                                            <div id="kt_ecommerce_add_product_discount_slider" class="noUi-sm noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
                                                                <div class="noUi-base">
                                                                    <div class="noUi-connects"></div>
                                                                    <div class="noUi-origin" style="transform: translate(-90.9091%, 0px); z-index: 4;">
                                                                        <div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="1.0" aria-valuemax="100.0" aria-valuenow="10.0" aria-valuetext="10.00">
                                                                            <div class="noUi-touch-area"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-muted fs-7">Set a percentage discount to be applied on this product.</div>
                                                    </div>
                                                    <div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_fixed">
                                                        <label class="form-label">Fixed Discounted Price</label>
                                                        <input type="text" name="dicsounted_price" class="form-control mb-2" placeholder="Discounted price">
                                                        <div class="text-muted fs-7">Set the discounted product price. The product will be reduced at the determined fixed price</div>
                                                    </div>
                                                    <div class="d-flex flex-wrap gap-5">
                                                        <div class="fv-row w-100 flex-md-root fv-plugins-icon-container">
                                                            <label class="required form-label">Tax Class</label>
                                                            <select class="form-select mb-2 select2-hidden-accessible" name="tax" data-control="select2" data-hide-search="true" data-placeholder="Select an option" data-select2-id="select2-data-13-9pv5" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                                <option data-select2-id="select2-data-15-qpf4"></option>
                                                                <option value="0">Tax Free</option>
                                                                <option value="1">Taxable Goods</option>
                                                                <option value="2">Downloadable Product</option>
                                                            </select>
                                                            <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-14-ays2" style="width: 100%;">
                                                                <span class="selection">
                                                                    <span class="select2-selection select2-selection--single form-select mb-2" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-tax-4x-container" aria-controls="select2-tax-4x-container">
                                                                        <span class="select2-selection__rendered" id="select2-tax-4x-container" role="textbox" aria-readonly="true" title="Select an option">
                                                                            <span class="select2-selection__placeholder">Select an option</span>
                                                                        </span>
                                                                        <span class="select2-selection__arrow" role="presentation">
                                                                            <b role="presentation"></b>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                                <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                            </span>
                                                            <div class="text-muted fs-7">Set the product tax class.</div>
                                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                        </div>
                                                        <div class="fv-row w-100 flex-md-root">
                                                            <label class="form-label">VAT Amount (%)</label>
                                                            <input type="text" class="form-control mb-2" value="">
                                                            <div class="text-muted fs-7">Set the product VAT about.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>Inventory</h2>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <label class="required form-label">SKU</label>
                                                        <input type="text" name="sku" class="form-control mb-2" placeholder="SKU Number" value="">
                                                        <div class="text-muted fs-7">Enter the product SKU.</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <label class="required form-label">Barcode</label>
                                                        <input type="text" name="barcode" class="form-control mb-2" placeholder="Barcode Number" value="">
                                                        <div class="text-muted fs-7">Enter the product barcode number.</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <label class="required form-label">Quantity</label>
                                                        <div class="d-flex gap-3">
                                                            <input type="number" name="shelf" class="form-control mb-2" placeholder="On shelf" value="">
                                                            <input type="number" name="warehouse" class="form-control mb-2" placeholder="In warehouse">
                                                        </div>
                                                        <div class="text-muted fs-7">Enter the product quantity.</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="fv-row">
                                                        <label class="form-label">Allow Backorders</label>
                                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                            <label class="form-check-label"> Yes </label>
                                                        </div>
                                                        <div class="text-muted fs-7">Allow customers to purchase products that are out of stock.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>Variations</h2>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                                        <label class="form-label">Add Product Variations</label>
                                                        <div id="kt_ecommerce_add_product_options">
                                                            <div class="form-group">
                                                                <div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3">
                                                                    <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
                                                                        <div class="w-100 w-md-200px">
                                                                            <select class="form-select select2-hidden-accessible" name="kt_ecommerce_add_product_options[0][product_option]" data-placeholder="Select a variation" data-kt-ecommerce-catalog-add-product="product_option" data-select2-id="select2-data-118-cj8n" tabindex="-1" aria-hidden="true">
                                                                                <option data-select2-id="select2-data-120-qiiv"></option>
                                                                                <option value="color">Color</option>
                                                                                <option value="size">Size</option>
                                                                                <option value="material">Material</option>
                                                                                <option value="style">Style</option>
                                                                            </select>
                                                                            <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-119-5ls3" style="width: 100%;">
                                                                                <span class="selection">
                                                                                    <span class="select2-selection select2-selection--single form-select" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-kt_ecommerce_add_product_options0product_option-qx-container" aria-controls="select2-kt_ecommerce_add_product_options0product_option-qx-container">
                                                                                        <span class="select2-selection__rendered" id="select2-kt_ecommerce_add_product_options0product_option-qx-container" role="textbox" aria-readonly="true" title="Select a variation">
                                                                                            <span class="select2-selection__placeholder">Select a variation</span>
                                                                                        </span>
                                                                                        <span class="select2-selection__arrow" role="presentation">
                                                                                            <b role="presentation"></b>
                                                                                        </span>
                                                                                    </span>
                                                                                </span>
                                                                                <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" class="form-control mw-100 w-200px" name="kt_ecommerce_add_product_options[0][product_option_value]" placeholder="Variation">
                                                                        <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger">
                                                                            <i class="ki-outline ki-cross fs-1"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mt-5">
                                                                <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-outline ki-plus fs-2"></i> Add another variation </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="/metronic8/demo30/apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5"> Cancel </a>
                                    <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                        <span class="indicator-label"> Save Changes </span>
                                        <span class="indicator-progress"> Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="kt_app_footer" class="app-footer  d-flex flex-column flex-md-row align-items-center flex-center flex-md-stack py-2 py-lg-4 ">
                    <div class="text-gray-900 order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2024©</span>
                        <a href="javascript:;" target="_blank" class="text-gray-800 text-hover-primary">PT Semen Bangun Andalas</a>
                    </div>
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        <li class="menu-item">
                            <a href="/about" target="_blank" class="menu-link px-2">About</a>
                        </li>
                        <li class="menu-item">
                            <a href="/faq" target="_blank" class="menu-link px-2">Frequently Asked Questions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.public.footer')
