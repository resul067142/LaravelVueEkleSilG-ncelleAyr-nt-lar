<template>
    <v-card variant="outlined" class="m-10">
        <v-row>
            <v-col align="center" class="pa-5">
                <v-img src="https://placehold.co/200x150/EEE/31343C" width="200" height="150"></v-img>
                <h2>{{productx.name}}</h2>
            </v-col>
            <v-col class="pa-5">
                <p class="mb-5">
                    Stok Adedi: {{productx.qty}}
                </p>
                <p class="mb-5">
                    <router-link :to="'/urunler/' + productx.id">
                        <v-btn color="indigo" variant="tonal">Ayrıntılar</v-btn>
                    </router-link>
                </p>
                <p class="mb-5">
                    <router-link :to="'/urunler/duzenle/' + productx.id">
                        <v-btn color="blue" variant="tonal">Düzenle</v-btn>
                    </router-link>
                </p>
                <p>
                    <v-btn @click="deleteProduct(productx.id)" color="red" variant="tonal">Sil</v-btn>
                </p>
                <p>
                    <v-btn @click="addToCart(productx)" color="green" variant="tonal">Sepete Ekle</v-btn>
                </p>
            </v-col>
        </v-row>
    </v-card>
</template>
<script>
import axios from "axios";

export default {
    props: {
        productx: {
            type: Object,
            required: true,
        }
    },
    methods: {
        deleteProduct(id) {
            console.log(id + ' id\'li ürün silindi')
            axios.delete('/api/products/' + id).then(res => {
                if (res.status === 200) {
                    console.log(res.data)
                    this.$emit('deleteProductx', id) // üst componentten gelen eventin tetiklenmesi
                }

            }).catch(err => {
                console.log(err.response)
            })
        },
        addToCart(product) {
            console.log('eklenen: ', product)

            this.$emit('addToCartx', product)

        }
    },
}
</script>
