<template>
    <v-container>
        <v-row>
            <v-col>
<!--                {{categories}}-->
<!--                {{selectedCategories}}-->
                <h1>Ürün Ekle</h1>
                <v-form @submit.prevent="storeProduct">
                    <v-text-field type="text" v-model="product.name" label="Ürün Adı"> </v-text-field>

                    <v-text-field type="number" v-model="product.qty" label="Stok"></v-text-field>

                    <v-select
                        v-model="selectedCategories"
                        :items="categories"
                        item-title="name"
                        item-value="id"
                        label="Kategoriler"
                        text
                        multiple
                        hint="Ürünlere kategorileri seçiniz"
                        persistent-hint
                    ></v-select>

                    <v-btn type="submit" color="#000000">Ekle</v-btn>
                </v-form>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
export default {
    data() {
        return {
            product : {
                name: null,
                qty: 0,
            },
            selectedCategories: [],
            categories: [],
        }
    },
    methods: {
        storeProduct() {
            console.log('storeProduct tetiklendi')
            const newProduct = {name: this.product.name, qty: this.product.qty, categories: this.selectedCategories}
            axios.post('/api/products', newProduct).then(res => {
                console.log(res)
                if (res.status === 200) {
                    this.$router.push('/urunler')
                }
            })
        }
    },
    mounted() {
        axios.get('/api/categories').then(res => {
            this.categories = res.data.data
        })
    }
}
</script>
