<template>
    <div>
        <div class="my-3">
            <h1 class="text-center">List of Products</h1>
        </div>
        <div class="my-3 d-flex justify-content-end">
            <router-link class="btn btn-success" to="/add">Add Product</router-link>
        </div>
        <div class="my-4">
            <table class="table table-striped table-hover">
                <thead>
                    <td>No</td>
                    <td>Name</td>
                    <td>Price</td>
                    <td colspan="3">Actions</td>
                </thead>
                <tbody>
                    <tr v-for="(product, i) in products" :key="product.id">
                        <td>{{ i+1 }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                        <td><router-link :to="'/show/'+product.id"><i  class="fa fa-eye"></i></router-link></td>
                        <td><router-link :to="'/edit/'+product.id"><i  class="fa fa-pen"></i></router-link></td>
                        <td><button @click="deleteProduct(product.id)" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "Index",
    data() {
        return{
            products: [],
        }
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        getProducts(){
            axios.get('/api/products')
            .then(res => {
                this.products = res.data;
            });
        },
        deleteProduct(id){
            axios.delete('api/products/' + id)
                .then(res => {
                    this.products = this.getProducts();
                })
                .catch(err => {
                    console.log(err.response.data);
                });
        }
    }
}
</script>

<style scoped>

</style>
