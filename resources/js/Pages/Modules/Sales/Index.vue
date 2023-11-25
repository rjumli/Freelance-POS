<template>
    <Head title="Sales" />
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="input-group mb-1">
                                <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                                <input type="text" v-model="keyword" placeholder="Search Product Code" class="form-control" autofocus>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- <div class="card">
                        <div class="">
                            <div class="card ribbon-box border shadow-none mb-lg-0 right">
                                <div class="card-body text-muted">
                                    <div class="ribbon-two ribbon-two-danger"><span class="fs-10">Discounted</span></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <b-card no-body class="product">
                        <div class="card-header align-items-center d-flex">
                            <h5 class="card-title mb-0 flex-grow-1">CART ({{lists.length}} items)</h5>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="ribbons01-showcode" class="form-label text-muted">Show Code</label>
                                    <input class="form-check-input code-switcher" type="checkbox" id="ribbons01-showcode">
                                </div>
                            </div>
                        </div>
                        <b-card-body class="card ribbon-box border shadow-none mb-lg-0" style="height: calc(100vh - 340px); overflow: auto;">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light fs-11">
                                    <tr>
                                        <th width="5%"></th>
                                        <th width="52%">Product</th>
                                        <th class="text-center" width="12%">Quantity</th>
                                        <th class="text-center" width="13%">Price</th>
                                        <th class="text-center" width="13%">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="product  align-items-center">
                                    <tr class="fs-12" v-for="(list, index) in lists" v-bind:key="'a-'+index">
                                        <td class="text-center align-middle">
                                            <button @click="removeItem(index)" class="btn btn-soft-danger edit-list btn-sm" type="button">
                                                <div class="btn-content"><i class="ri-delete-bin-5-line align-bottom"></i></div>
                                            </button>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">{{list.name}} - {{ list.brand }}</h6>
                                            <p class="text-muted mb-0">{{list.code}}</p>
                                        </td>
                                        <td class="text-center">
                                            <div class="input-step">
                                                <button @click="minus(index)" type="button">–</button>
                                                    <input type="number" class="product-quantity" v-model="list.quantity" min="1" :max="list.stock" />
                                                <button @click="plus(index)" type="button" class="plus">+</button>
                                            </div>
                                        </td>
                                        <td class="text-center">{{formatMoney(list.price) }}</td>
                                        <td class="text-center">{{formatMoney(check(list.quantity,list.price,index))}}</td>
                                    </tr>
                                </tbody>
                            </table>
                           
                        </b-card-body>
                       
                    </b-card>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4" >
            <div class="card">
                <div class="card-header border-bottom-dashed">
                    <h5 class="card-title mb-0">Order Summary</h5>
                </div>
                <div class="card-header bg-light-subtle border-bottom-dashed">
                    <div class="col-md-12 ">
                        <multiselect v-model="customer" id="ajax" label="name" track-by="id"
                            placeholder="Select Customer" open-direction="bottom" :options="customers"
                            :allow-empty="false"
                            :show-labels="false">
                        </multiselect> 
                    </div>
                </div>
                <div class="card-header bg-light-subtle border-bottom-dashed">
                    <div class="col-md-12 ">
                        <multiselect v-model="discount" id="ajax" label="name" track-by="id"
                            placeholder="Select Discount" open-direction="bottom" :options="discounts"
                            :allow-empty="false"
                            :show-labels="false">
                        </multiselect> 
                    </div>
                </div>
                <div class="card-body" style="height: calc(100vh - 383px); overflow: auto;">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td>Sub Total :</td>
                                    <td class="text-end" id="cart-subtotal">{{formatMoney(subtotal)}}</td>
                                </tr>
                                <tr>
                                    <td>Discount : </td>
                                    <td class="text-end" id="cart-discount">{{formatMoney(discounted)}}</td>
                                </tr>
                                <tr>
                                    <td>Estimated Tax (12%) : </td>
                                    <td class="text-end" id="cart-tax">{{formatMoney(tax)}}</td>
                                </tr>
                                <tr class="table-active">
                                    <th class="fs-14">Total :</th>
                                    <td class="text-end fs-14">
                                        <span class="fw-semibold" id="cart-total">{{formatMoney(total)}}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</template>
<script>
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    components : { Multiselect },
    props: ['categories','suppliers','units','dropdowns','customers','discounts'],
    data() {
        return {
            lists: [],
            keyword: '',
            value: 1,
            form: {},
            customer: '',
            discount: this.discounts[0],
            discounted : 0
        };
    },
    watch: {
        keyword(newVal){
            this.checkSearchStr(newVal);
        },
        discount(newVal){
            if(newVal.subtype_id == 18){
                this.calculatePercent(newVal.value);
            }else{
                this.discounted = this.formatMoeny(newVal.value);
            }
        }
    },
    computed: {
        subtotal() {
            return this.lists.reduce((total, item) => total + item.total, 0);
        },
        tax() {
            return this.subtotal * 0.12;
        },
        total() {
            return this.subtotal + this.tax - this.discounted;
        }
    },
    methods: {
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),
        fetch(page_url) {
            page_url = page_url || '/sales';
            axios.get(page_url, {
                params: {
                    keyword: (this.keyword) ? this.keyword : '',
                    options: 'cart'
                }
            })
            .then(response => {
                if(response.data.data.length != 0){
                    const itemCode = response.data.data.code;
                    if (!this.itemExists(itemCode)) {
                        response.data.data.quantity = 1;
                        this.lists.unshift(response.data.data);
                    }
                    this.keyword = '';
                }
            })
            .catch(err => console.log(err));
        },
        itemExists(itemCode) {
            return this.lists.some(item => item.code === itemCode);
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
        plus(index){
            if(this.lists[index].quantity < this.lists[index].stock){
                this.lists[index].quantity++;
            }
        },
        minus(index){
            if(this.lists[index].quantity > 1){
                this.lists[index].quantity--;
            }
        },
        removeItem(index){
            if (window.confirm('Are you sure you want to remove this item?')) {
                this.lists.splice(index, 1);
            }
        },
        check(quantity,price,index){
            this.lists[index].total = quantity * price;
            return this.lists[index].total;
        },
        calculatePercent(val){
            let percent = val/100
            this.discounted = this.subtotal * percent;
        },
     
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
.multiselect__tags {
    border: 0;
    min-height: 37px;
    height: 37px;
} 
</style>