<template>



    <v-card>


        <h2 class="text-center" >KATEGORİLER</h2>

        <v-layout>

            <v-list>
                <v-list-item :to="'/kategoriler/' + category.slug" :title="category.name" :value="category.id"
                             v-for="category in categories"></v-list-item>
            </v-list>
            <v-main style="height: 250px"></v-main>
        </v-layout>
    </v-card>

</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            categories: [],
        }
    },
    mounted() {
        axios.get('/api/categories/').then(response => {
            console.log(response.data.data)
            this.categories = response.data.data
        })
    }
}
</script>
