<template>
    <b-card no-body class="card-height-100">
        <b-card-header class="align-items-center d-flex">
        <b-card-title class="mb-0 flex-grow-1">Active Discount</b-card-title>
        <div class="flex-shrink-0">
            <!-- <button @click="viewCreate()" type="button" class="btn btn-primary btn-sm">New Order</button> -->
        </div>
        </b-card-header>
        <b-card-body class="p-0">
            <div data-simplebar style="height: 390px">
                <div class="p-3">
                    <div class="table-responsive" v-if="discounts.length > 0">
                       
                    </div>
                    <div v-else class="alert alert-warning text-center" role="alert">
                        No discounts found
                    </div>
                </div>
            </div>
        </b-card-body>
    </b-card>
</template>
<script>
export default {
    data(){
        return {
            discounts: []
        }
    },
    methods:{
        openView(data){
            this.$refs.view.show(data);
        }
    }
}
</script>