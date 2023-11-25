<template>
    <b-modal v-model="showModal" title="New Package" size="xl" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Name: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="package.name">
                    </div>
                </div>
                <div class="col-md-6 mt-1">
                    <label>Category: <span v-if="form.errors" v-text="form.errors.category_id" class="haveerror"></span></label>
                    <multiselect v-model="package.category" id="ajax" :track-by="id" label="name"
                        placeholder="Select Category" open-direction="bottom" :options="categories_list"
                        :allow-empty="false"
                        :show-labels="false">
                    </multiselect> 
                </div>
                <div class="col-md-3" style="margin-top: 15px;">
                   <div class="form-group">
                        <label>Quantity: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="package.name">
                    </div>
                </div>
                <div class="col-md-3" style="margin-top: 15px;">
                   <div class="form-group">
                        <label>Price: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="package.name">
                    </div>
                </div>

                <div class="col-md-12">
                    <hr class="text-muted"/>
                </div>
                <div class="col-sm-12 mt-1">
                     <b-row class="mt-n3">
                        <div class="col-md-6">
                            <div class="page-title-left mt-2">
                                <ol class="breadcrumb m-0 fs-13">
                                    <li class="breadcrumb-item text-primary fw-semibold">List of Products</li>
                                </ol>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="hstack float-end gap-2 mt-4 mt-sm-0">
                                <button @click="add()" class="btn btn-primary btn-sm btn-label mt-1" type="button">
                                    <div class="btn-content"><i class="ri-add-circle-fill label-icon align-middle fs-12 me-2"></i>Add Product</div>
                                </button>
                            </div>
                        </div>
                    </b-row>
                </div>
                <div class="col-sm-12 mt-n2">
                    <hr class="text-muted"/>
                </div>
                <div class="col-sm-12 mt-n2">
                    <div class="row">
                         <div class="col-sm-12 mt-n2">

                         <table class="table align-middle mt-2">
                            <thead class="table-light fs-11">
                               <tr>
                                    <th width="5%"></th>
                                    <th class="text-center" width="35%">Type</th>
                                    <th class="text-center" width="10%">Qnty</th>
                                    <th class="text-center" width="15%">Unit Price</th>
                                    <th class="text-center" width="15%">Price</th>
                                    <th class="text-center" width="25%">Total</th>
                                </tr>
                            </thead>
                         </table>
                         <table class="table table-borderless align-middle mt-n3">
                            <tbody>
                                <tr v-for="(list, index) in package.lists" v-bind:key="'a-'+index" class="mb-n4" style="display: block;">
                                    <td class="text-end" width="5%">
                                        <b-button @click="rmv(index)" variant="soft-danger" v-b-tooltip.hover title="Remove" class="edit-list btn-sm mt-n2">
                                            <i class="ri-delete-bin-5-line align-bottom"></i> 
                                        </b-button>
                                    </td>
                                    <td class="text-center" width="35%">
                                        <select @change="check('product',index)" :style="(form.errors && form.errors[`lists.${index}.product`]) ? 'color: red':''" v-model="list.product" class="form-select form-select-sm mt-n1">
                                            <option :value="null" disabled>Select Product</option>
                                            <option :value="product" v-for="(product,index) in products" v-bind:key="index" :disabled="isTypeSelected(product.id)">{{product.name}} - {{product.brand}}</option>
                                        </select>
                                    </td>
                                    <td class="text-center" width="10%">
                                        <input @change="check('quantity',index)" :style="(form.errors && form.errors[`lists.${index}.quantity`]) ? 'color: red':''" type="text" class="form-control form-control-sm text-center" v-model="list.quantity" placeholder="Quantity" required>
                                    </td>
                                    <td class="text-center" width="15%">
                                        <input type="text" readonly class="form-control form-control-sm text-center" :value="formatMoney(package.lists[index].current)" placeholder="Amount" required>
                                    </td>
                                    <td class="text-center" width="15%">
                                        <Amount class="text-center" @change="check('amount',index)" :style="(form.errors && form.errors[`lists.${index}.price`]) ? 'color: red':''" @amount="handleAmount" :index="index" :size="'form-control-sm'" ref="testing" :readonly="false"/>
                                        <!-- <input type="text" class="form-control form-control-sm" v-model="tub.amount" placeholder="Amount" required> -->
                                    </td>
                                    <td width="25%" class="text-center">
                                        <input type="text" readonly class="form-control form-control-sm text-center" :value="formatMoney(package.lists[index].quantity * package.lists[index].price)" placeholder="Amount" required>
                                    </td>
                                </tr>
                            </tbody>
                         </table>
                         </div>
                    </div>
                </div>
            </div>
        </b-form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
</template>
<script>
import Amount from "@/Shared/Components/Amount.vue";
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    props: ['categories','products'],
    components: { Multiselect, Amount },
    data(){
        return {
            showModal: false,
            package: {
                id: '',
                name: '',
                category: '',
                lists: [{product: null, current:0 ,quantity: 0,price: 0}]
            },
            form: {},
            editable: false,
        }
    },
    computed: {
        categories_list : function() {
            return this.categories.filter(x => x.type == 'Package');
        },
    },
    methods : {
        show() {
            this.showModal = true;
        },
        edit(data){
            this.product = data;
            this.editable = true;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.package.id,
                name: this.package.name, 
                category_id: (this.package.category) ? this.order.category.id : '', 
                lists: this.package.lists,
                editable: this.editable
            })

            this.form.post('/orders',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            this.customers = {
                id: '',
                name: '',
                contact: '',
                email: '',
            };
            this.$emit('message',true);
            this.showModal = false;
        },
        add(){
            this.package.lists.push({product: null,price: 0, current:0 ,quantity: 0})
        },
        rmv(index){
            this.package.lists.splice(index,1);
        },
        handleAmount(val){
            this.package.lists[val[1]].price = val[0].replace('₱ ', '').replace(/,/g, '');
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
        isTypeSelected(typeId) {
            return this.package.lists.slice(0, -1).some(item => item.product === typeId);
        },
        check(data,index){
            if(this.form.errors){
                if(data == 'product'){
                    this.form.errors[`lists.${index}.product`] = '';
                }else if(data == 'quantity'){
                    this.form.errors[`lists.${index}.quantity`] = '';
                }else{
                    this.form.errors[`lists.${index}.price`] = '';
                }
            }
            if(data == 'product'){
                this.package.lists[index].current = this.package.lists[index].product.price;
            }
        }
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
