<template>
    <div>
        <div class="my-3 d-flex justify-content-end">
            <router-link class="btn btn-outline-dark" to="/">Back</router-link>
        </div>
        <div class="my-4">
            <h1>{{form.name}}</h1>
        </div>
        <form>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input v-model="form.name" type="text" class="form-control">
                <span v-if="errors.name" class="text-danger">{{errors.name[0]}}</span>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input v-model="form.price" type="text" class="form-control">
                <span v-if="errors.price" class="text-danger">{{errors.price[0]}}</span>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <div class="my-2" v-if="image && id">
                    <img width="150px" :src="image" :alt="form.name">
                    <span v-if="errors.image" class="text-danger">{{errors.image[0]}}</span>
                </div>
                <input @change="uploadImage" type="file" accept=".jpg, .jpeg, .png" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea v-model="form.description" class="form-control" rows="3"></textarea>
                <span v-if="errors.description" class="text-danger">{{errors.description[0]}}</span>
            </div>
            <button class="btn btn-success" @click.prevent="onSubmit">Save</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Edit",
    data() {
        return{
            id: null,
            fd: new FormData(),
            form: {
                name: '',
                price: '',
                description: '',
            },
            image: String,
            errors: {}
        }
    },
    mounted() {
        if (this.$route.params.id){
            this.id = this.$route.params.id;
            this.getProduct(this.id);
        }
    },
    methods: {
        getProduct(id){
            axios.get('/api/products/' + id)
                .then(res => {
                    _.assign(this.form, _.pick(res.data, _.keys(this.form)));
                    this.image = res.data.image;
                    console.log(this.form);
                });
        },
        onSubmit(){
            Object.entries(this.form).forEach(([key, value]) => {
                this.fd.append(key, value);
            });
            console.log(this.fd)
            if(this.id){
                this.fd.append("_method", "put");
                this.update();
            }
            else {
                this.create();
            }
        },
        update(){
            axios.post('/api/products/' + this.id, this.fd)
                .then(res => {
                    console.log(res);
                    this.$router.push('/');
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    console.log('-', err.response.data.errors)
                });
        },
        create(){
            axios.post('/api/products', this.fd)
                .then(res => {
                    console.log(res);
                    this.$router.push('/');
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    console.log(err.response.data.errors)
                });
        },
        uploadImage(e){
            let img = e.target.files[0]
            this.fd.append('image', img)
        }
    }
}
</script>

<style scoped>

</style>
