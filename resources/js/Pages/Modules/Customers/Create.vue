<template>
    <b-modal v-model="showModal" title="Add Customer" header-class="p-3 bg-light" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <b-form class="customform mb-2">
            <div class="row customerform">
                
                <div class="col-md-12 mt-4">
                   <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" v-model="customer.name" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Contact:</label>
                        <input type="text" class="form-control" v-model="customer.contact">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                   <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" v-model="customer.email">
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
export default {
    data(){
        return {
            showModal: false,
            customer: {
                id: '',
                name: '',
                contact: '',
                email: ''
            },
            form: {},
            editable: false,
        }
    },

    methods : {
        show() {
            this.showModal = true;
        },
        edit(data){
            this.customer = data;
            this.editable = true;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                id: this.id,
                name: this.customer.name,
                contact: this.customer.contact,
                email: this.customer.email,
                editable: this.editable
            })

            this.form.post('/customers',{
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
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
</style>
