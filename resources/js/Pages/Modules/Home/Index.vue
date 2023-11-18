<template>
    <Head title="Dashboard" />
    <!-- <PageHeader :title="title" :items="items" /> -->
</template>
<script>
import PageHeader from "@/Shared/Components/PageHeader.vue";
export default {
    components: { PageHeader },
    data() {
        return {
            title: "Dashboard",
            items: [{text: "View",href: "/"},{ text: "Dasboard",active: true},
            ],
        };
    },
}
</script>
