<template>
    <div>
        <v-container>
            <v-row>
                <v-col class="text-center" cols="9">
                    <h1>Ürünler</h1>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="9">
                    <v-text-field v-model="name" placeholder="Adı"></v-text-field>
                    <v-text-field v-model="surname" placeholder="Soyadı"></v-text-field>
                    <v-text-field type="number" v-model="number" placeholder="Sayı"></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="5">
                    <ul class="text-center">
                        <li v-for="item in cartItems">{{ item.name }} {{ item.qty }}</li>
                    </ul>
                </v-col>
                <v-col class="text-center" cols="4">
                    Toplam Ürün Sayısı: {{ getCartItemCount }}
                </v-col>
            </v-row>

            <v-row class="mt-0">
                <v-col cols="9">
                    <div v-for="product in products">
                        <!-- :products dediğimiz zaman product objesini alt componente göndermiş oluyoruz -->
                        <!-- deleteProductx şeklinde tanımladığımız event componentten çağrılabilir -->
                        <ProductItem :productx="product" @deleteProductx="deleteProduct"
                                     @addToCartx="addToCart"></ProductItem>
                    </div>
                </v-col>
                <v-col cols="3">
                    <Sidebar></Sidebar>
                </v-col>
            </v-row>
        </v-container>

    </div>
</template>
<script>
import axios from "axios";
import ProductItem from "../../components/products/ProductItem.vue";
import Sidebar from "../../components/Sidebar.vue";

export default {
    components: {ProductItem, Sidebar},
    data() {
        return {
            products: [],
            categories: [],
            cartItems: [],
            name: null,
            surname: null,
            number: 0,
        }
    },
    computed: {
        getCartItemCount() {
            console.log('count hesaplandı')
            var sum = 0
            this.cartItems.forEach(item => {
                sum += item.qty
            })
            return sum
        }
    },
    methods: {
        deleteProduct(id) {
            const index = this.products.findIndex(item => item.id === id)
            this.products.splice(index, 1)
        },
        addToCart(product) {
            this.cartItems.push(product)
        }
    },
    watch: {
        name(newValue, oldValue) {
            console.log('eski: ', oldValue)
            console.log('yeni: ', newValue)
        },
        surname(newValue, oldValue) {
            console.log('eski: ', oldValue)
            console.log('yeni: ', newValue)
        },
        number(newValue, oldValue) {
            if(newValue > 2000) {
                this.number = 2000
            }
        }
    },
    mounted() {
        /// mounted fonksiyonu sayfa açılırken açılan fonksiyondur.
        /// response = yanıt
        axios.get('/api/products').then(response => {
            console.log(response.data.data)
            this.products = response.data.data
        })

        axios.get('/api/categories').then(response => {
            this.categories = response.data.data
        })
    }
}
</script>
<script setup>
</script>
