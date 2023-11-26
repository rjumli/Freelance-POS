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
                        <table class="table table-nowrap table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr class="fs-11">
                                    <th style="width: 10%;" class="text-center">#</th>
                                    <th style="width: 60%;">Name</th>
                                    <th style="width: 15%;" class="text-center">Value</th>
                                    <th style="width: 15%;" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fs-12" v-for="(list,index) in discounts" v-bind:key="index">
                                    <td class="text-center"> {{index+1}}</td>
                                    <td>
                                        <h6 class="mb-0">{{list.name}}</h6>
                                    </td>
                                    <td class="text-center"> {{(list.subtype.name == 'Amount') ? formatMoney(list.value) : list.value+'%'}}</td>
                                    <td class="text-center">
                                        <b-button @click="view(list)" variant="soft-primary" v-b-tooltip.hover title="View Product" size="sm" class="edit-list me-1">View</b-button>
                                        <!-- <b-button @click="edit(list)" variant="soft-primary" v-b-tooltip.hover title="Edit Product" size="sm" class="edit-list me-1 w-xs">Edit</b-button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="alert alert-warning text-center" role="alert">
                        No pending orders
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
    props: ['discounts'],
    methods:{
        openView(data){
            this.$refs.view.show(data);
        }
    }
}
</script>