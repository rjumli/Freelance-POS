<template>
    <b-modal v-model="showModal" title="View Product" size="lg" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="col-xl-12">
                <div class="mt-xl-0 mt-5">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h4>{{product.name}}</h4>
                            <div class="hstack gap-3 flex-wrap">
                                <div><a href="#" class="text-primary d-block">{{product.category.name}}</a></div>
                                <div class="vr"></div>
                                <div class="text-muted">Brand : <span class="text-body fw-medium">{{product.brand}}</span></div>
                                <div class="vr"></div>
                                <div v-if="product.size" class="text-muted">Size : <span class="text-body fw-medium">{{product.size}}</span></div>
                                <div v-if="product.size" class="vr"></div>
                                <div class="text-muted">Created At : <span class="text-body fw-medium">{{product.created_at}}</span></div>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div>
                                <vue-barcode  :value="product.code" :options="{ displayValue: true }"  style="height: 50px;"></vue-barcode>
                                <!-- <a href="apps-ecommerce-add-product.html" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="ri-pencil-fill align-bottom"></i></a> -->
                            </div>
                        </div>
                    </div>

                   

                    <div class="row mt-4">
                        <div class="col-lg-3 col-sm-6">
                            <div class="p-2 border border-dashed rounded">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <div class="avatar-title rounded bg-transparent text-success fs-24">
                                            <i class="ri-money-dollar-circle-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted fs-11 mb-1">Price :</p>
                                        <h5 class="mb-0 fs-13">{{formatMoney(product.price)}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-lg-3 col-sm-6">
                            <div class="p-2 border border-dashed rounded">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <div class="avatar-title rounded bg-transparent text-success fs-24">
                                            <i class="ri-file-copy-2-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted fs-11 mb-1">Orders :</p>
                                        <h5 class="mb-0 fs-13">2,234</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-lg-3 col-sm-6">
                            <div class="p-2 border border-dashed rounded">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <div class="avatar-title rounded bg-transparent text-success fs-24">
                                            <i class="ri-stack-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted fs-11 mb-1">Stocks :</p>
                                        <h5 class="mb-0 fs-13">{{product.stock}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-lg-3 col-sm-6">
                            <div class="p-2 border border-dashed rounded">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <div class="avatar-title rounded bg-transparent text-success fs-24">
                                            <i class="ri-inbox-archive-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted fs-11 mb-1">Revenue :</p>
                                        <h5 class="mb-0 fs-13">$60,645</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>

                    <!-- <div class="row">
                        <div class="col-xl-6">
                            <div class="mt-4">
                                <h5 class="fs-14">Sizes :</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Out of Stock">
                                        <input type="radio" class="btn-check" name="productsize-radio" id="productsize-radio1" disabled="">
                                        <label class="btn btn-soft-primary avatar-xs rounded-circle p-0 d-flex justify-content-center align-items-center" for="productsize-radio1">S</label>
                                    </div>

                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="04 Items Available">
                                        <input type="radio" class="btn-check" name="productsize-radio" id="productsize-radio2">
                                        <label class="btn btn-soft-primary avatar-xs rounded-circle p-0 d-flex justify-content-center align-items-center" for="productsize-radio2">M</label>
                                    </div>
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="06 Items Available">
                                        <input type="radio" class="btn-check" name="productsize-radio" id="productsize-radio3">
                                        <label class="btn btn-soft-primary avatar-xs rounded-circle p-0 d-flex justify-content-center align-items-center" for="productsize-radio3">L</label>
                                    </div>

                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Out of Stock">
                                        <input type="radio" class="btn-check" name="productsize-radio" id="productsize-radio4" disabled="">
                                        <label class="btn btn-soft-primary avatar-xs rounded-circle p-0 d-flex justify-content-center align-items-center" for="productsize-radio4">XL</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class=" mt-4">
                                <h5 class="fs-14">Colors :</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Out of Stock" data-bs-original-title="Out of Stock">
                                        <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-primary" disabled="">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </button>
                                    </div>
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="03 Items Available" data-bs-original-title="03 Items Available">
                                        <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-secondary">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </button>
                                    </div>
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="03 Items Available" data-bs-original-title="03 Items Available">
                                        <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-success">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </button>
                                    </div>
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="02 Items Available" data-bs-original-title="02 Items Available">
                                        <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-info">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </button>
                                    </div>
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="01 Items Available" data-bs-original-title="01 Items Available">
                                        <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-warning">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </button>
                                    </div>
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="04 Items Available" data-bs-original-title="04 Items Available">
                                        <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-danger">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </button>
                                    </div>
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="03 Items Available" data-bs-original-title="03 Items Available">
                                        <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-light">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </button>
                                    </div>
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="04 Items Available" data-bs-original-title="04 Items Available">
                                        <button type="button" class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-body">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="mt-4 text-muted">
                        <h5 class="fs-14">Description :</h5>
                        <p>{{product.information}}.</p>
                    </div>

                 

                    
                </div>
            </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <!-- <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button> -->
        </template>
    </b-modal>
</template>
<script>
import VueBarcode from '@chenfengyuan/vue-barcode';
export default {
    components : {VueBarcode},
    data(){
        return {
            showModal: false,
            product: {
                category: ''
            },
        }
    },
    methods : {
        show(data) {
            this.product = data;
            this.showModal = true;
        },
        hide(){
            this.showModal = false;
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
</style>
