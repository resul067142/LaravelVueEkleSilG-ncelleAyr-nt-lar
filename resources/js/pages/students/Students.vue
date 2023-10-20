<template>
    <v-container>
        <v-row>
            <v-col class="bg-red" cols="5" >sgbgf</v-col>
            <v-col  class="bg-black" cols="5" >nhn</v-col>
            <v-col  class="bg-red " cols="2" >hmhh</v-col>

            <v-col v-for=" student in students" cols="3">
                <v-card
                    class="mx-auto"
                    max-width="434"
                    rounded="0"
                >
                    <v-img
                        height="150px"
                        cover
                        src="https://cdn.vuetifyjs.com/images/cards/server-room.jpg"
                    >
                        <v-avatar
                            color="grey"
                            size="50"
                            rounded="0"
                        >
                            <v-img cover src="https://cdn.vuetifyjs.com/images/profiles/marcus.jpg"></v-img>
                        </v-avatar>
                        <v-list-item
                            class="text-white"
                            :title="student.name"
                            :subtitle="student.surname"
                        ></v-list-item>
                    </v-img>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-list>
                    <v-list-item v-for="student in students" :key="student.id">
                        <v-list-item-title>
                            {{ student.name }} {{ student.surname }} {{ student.number }} {{ student.class }}
                        </v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from "axios";

export default {
    name: "Students",
    data() {
        return {
            students: [],
        };
    },

    methods: {
        deleteStudent(id) {
            console.log(id + "silindi");
            alert(SİLİNDİ);

            axios
                .delete("/api/student/" + id)
                .then((res) => {
                    if (res.status === 200) {
                        console.log(res.data);
                        const index = this.students.findIndex(item => item.id === id);
                        this.students.splice(index, 1);
                    }
                })
                .catch((err) => {
                    console.log(err.response);
                });
        },
    },

    mounted() {
        axios.get("/api/student").then((response) => {
            console.log(response.data);

            this.students = response.data;
        });
    },
};
</script>
