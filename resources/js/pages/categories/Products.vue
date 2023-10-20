<template>

    <v-container>

        <v-row>

            <v-col class="text-center" cols="9">

                <h1>{{ title }}</h1>

            </v-col>
        </v-row>
        <v-row class="mt-0">
            <v-col cols="9">
                <div v-for="product in products">
                    <!-- :products dediğimiz zaman product objesini alt componente göndermiş oluyoruz -->
                    <!-- deleteProductx şeklinde tanımladığımız event componentten çağrılabilir -->
                    <ProductItem :productx="product" @deleteProductx="deleteProduct"></ProductItem>
                </div>
            </v-col>
            <v-col cols="3">
                <sidebar></sidebar>
<!--                <v-card>-->
<!--                    <v-layout>-->
<!--                        <v-list>-->
<!--                            <v-list-item :to="'/kategoriler/' + category.slug " :title="category.name" :value="category.id" v-for="category in categories"></v-list-item>-->
<!--                        </v-list>-->
<!--                        <v-main style="height: 250px"></v-main>-->
<!--                    </v-layout>-->
<!--                </v-card>-->
            </v-col>
        </v-row>
    </v-container>

</template>
<script>
import axios from "axios";
import ProductItem from "../../components/products/ProductItem.vue";

import Sidebar from "@/components/Sidebar.vue";

export default {
    components: {Sidebar, ProductItem},
    data() {
        return {
            products: [],
            categories: [],
            title: null,
        }
    },
    methods: {
        deleteProduct(id) {
            const index = this.products.findIndex(item => item.id === id)
            this.products.splice(index,1)
        }
    },
    mounted() {
        /// mounted fonksiyonu sayfa açılırken açılan fonksiyondur.
        /// response = yanıt
        const slug = this.$route.params.slug
        console.log(slug);
        axios.get('/api/categories/' + slug).then(response => {
            const category = response.data.data
            console.log(category)
            this.products = category.products
            this.title = category.name
        })
        //
        // axios.get('/api/categories').then(response => {
        //     this.categories = response.data.data
        // })
    },
    updated() {
        console.log('updated')
        const slug = this.$route.params.slug
        console.log(slug);
        axios.get('/api/categories/' + slug).then(response => {
            const category = response.data.data
            console.log(category)
            this.products = category.products
            this.title = category.name
        })
    }
}
</script>

