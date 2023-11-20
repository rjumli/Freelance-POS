<template>
    <b-modal v-model="showModal" title="Add Product" size="lg" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                
                <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Name: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="product.name" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-8 mt-2">
                   <div class="form-group">
                        <label>Brand: <span v-if="form.errors" v-text="form.errors.brand" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="product.brand">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                   <div class="form-group">
                        <label>Price: <span v-if="form.errors" v-text="form.errors.price" class="haveerror"></span></label>
                        <input type="email" class="form-control" v-model="product.price">
                    </div>
                </div>
                <div class="col-md-12 mt-2"><hr class="text-muted"/></div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Category: <span v-if="form.errors" v-text="form.errors.category_id" class="haveerror"></span></label>
                        <multiselect v-model="product.category" id="ajax" label="name" track-by="id"
                            placeholder="Select Category" open-direction="bottom" :options="categories"
                            :allow-empty="false"
                            :show-labels="false">
                        </multiselect> 
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                   <div class="form-group">
                        <label>Pricing: <span v-if="form.errors" v-text="form.errors.price_id" class="haveerror"></span></label>
                        <multiselect v-model="product.pricing" id="ajax" track-by="id" label="name"
                            placeholder="Select Pricing" open-direction="bottom" :options="pricings"
                            :allow-empty="false"
                            :show-labels="false">
                        </multiselect> 
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                   <div class="form-group">
                        <label>Unit: <span v-if="form.errors" v-text="form.errors.unit_id" class="haveerror"></span></label>
                        <multiselect v-model="product.unit" id="ajax" track-by="id" label="name"
                            placeholder="Select Unit" open-direction="bottom" :options="units"
                            :allow-empty="false"
                            :show-labels="false">
                        </multiselect> 
                    </div>
                </div>
                <div class="col-md-12 mt-2"><hr class="text-muted"/></div>
                <div class="col-md-12 mt-3">
                   <div class="form-group">
                        <textarea v-model="product.information" class="form-control" maxlength="225" rows="2" placeholder="Description"></textarea>
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
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    props: ['categories','suppliers','units','dropdowns'],
    components: { Multiselect },
    data(){
        return {
            showModal: false,
            product: {
                id: '',
                name: '',
                brand: '',
                price: '',
                stock: '',
                information: '',
                pricing: '',
                unit: '',
                category: ''
            },
            form: {},
            editable: false,
        }
    },
    computed: {
        pricings : function() {
            return this.dropdowns.filter(x => x.classification === 'Pricing');
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
                id: this.product.id,
                name: this.product.name,
                brand: this.product.brand,
                price: this.product.price,
                information: this.product.information,
                unit_id: (this.product.unit) ? this.product.unit.id : '' ,
                price_id: (this.product.pricing) ? this.product.pricing.id : '',
                category_id: (this.product.category) ? this.product.category.id : '',
                editable: this.editable
            })

            this.form.post('/products',{
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
        nameWithLang ({ name,supplier }) {
            return `${supplier.name} — ${name}`
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
</style>
