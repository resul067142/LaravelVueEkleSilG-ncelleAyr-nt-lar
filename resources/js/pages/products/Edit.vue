<template>
    <v-container>
        <v-row>
            <v-col>
                <h1>Ürün Düzenle</h1>
                <v-form @submit.prevent="updateProduct">

                    <v-text-field type="text" v-model="product.name" label="Ürün Adı"></v-text-field>

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

                    <v-btn type="submit" color="success">Güncelle</v-btn>
                </v-form>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
export default {
    data() {
        return {
            product: {
                name: null,
                qty: 0,
            },
            selectedCategories: [],
            categories: [],
        }
    },
    methods: {
        updateProduct() {
            console.log('güncellenecek veri : ', this.product)
            axios.put('/api/products/' + this.$route.params.id,
                {name: this.product.name, qty: this.product.qty, categories: this.selectedCategories}).then(resp => {

                if (resp.status === 200) {
                    this.$router.push('/urunler')
                }
            })
        }
    },
    mounted() {
        const id = this.$route.params.id
        console.log('id -> ', id)
        axios.get('/api/products/' + id).then(res => {

            const product = res.data.data;
            const categories = product.categories
            console.log('Ürün detayı ', product)
            console.log('Ürün kategorileri ', product.categories)

            this.product.name = product.name
            this.product.qty = product.qty

            const categoryIds = categories.map(item => item.id)

            console.log(categoryIds)

            this.selectedCategories = categoryIds

        })

        axios.get('/api/categories').then(res => {
            this.categories = res.data.data
        })
    }
}
</script>
