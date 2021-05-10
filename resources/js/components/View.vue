<template>
    <div v-if="ready">
        <div class="my-3 d-flex justify-content-end">
            <router-link class="btn btn-outline-dark" to="/">Back</router-link>
        </div>
        <h1 class="text-center">{{ product.name }}</h1>
        <div class="card card-body">
            <div class="row">
                <div class="col-md-4">
                    <img :src="product.image" width="100%" :alt="product.name">
                </div>
                <div class="col-md-8">
                    {{ product.description }}
                </div>
            </div>
            <div>Price: ${{product.price}}</div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "View",
    data() {
        return{
            ready: false,
            product: {},
        }
    },
    mounted() {
        this.getProduct(this.$route.params.id);
    },
    methods: {
        getProduct(id){
            axios.get('/api/products/' + id)
                .then(res => {
                    this.product = res.data;
                    this.ready = true;
                });
        }
    }
}
</script>

<style scoped>

</style>
