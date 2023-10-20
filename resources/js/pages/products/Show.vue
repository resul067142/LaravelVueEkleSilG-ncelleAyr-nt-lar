<template>

    <v-container>
        <v-row>
            <v-col cols="9">
                <v-card
                    class="mx-auto"
                    max-width="344"
                >
                    <v-img
                        src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
                        height="200px"
                        cover
                    ></v-img>

                    <v-card-title>
                        {{ product.name}}
                    </v-card-title>

                    <v-card-subtitle>
                        Adet: {{ product.qty }}
                    </v-card-subtitle>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn
                            :icon="show ? 'mdi-chevron-up' : 'mdi-chevron-down'"
                            @click="show = !show"
                        ></v-btn>
                    </v-card-actions>

                    <v-expand-transition>
                        <div v-show="show">
                            <v-divider></v-divider>
                            <ul>
                                <li v-for="cat in product.categories"> {{cat.name}} </li>
                            </ul>
                        </div>
                    </v-expand-transition>
                </v-card>
            </v-col>
            <v-col cols="3">
                <Sidebar></Sidebar>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import Sidebar from "../../components/Sidebar.vue";
export default {
    components: {Sidebar},
    data() {
        return {
            product: {
                categories: [],
            },
            show: false,
        }
    },
    mounted() {
        axios.get('/api/products/' + this.$route.params.id).then(resp => {
            console.log(resp.data)
            this.product = resp.data.data
        })
    }
}
</script>
