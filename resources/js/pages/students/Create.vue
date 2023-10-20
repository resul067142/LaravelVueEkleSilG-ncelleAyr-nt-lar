<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <h1>Student Ekle</h1>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12">
                <v-form @submit.prevent="ekleStudent">
                    <v-text-field
                        v-model="student.name"
                        label="Name"
                    ></v-text-field>

                    <v-text-field
                        v-model="student.surname"
                        label="Surname"
                    ></v-text-field>

                    <v-text-field
                        v-model="student.number"
                        label="Number"
                        type="number"
                    ></v-text-field>

                    <v-text-field
                        v-model="student.class"
                        label="Class"
                    ></v-text-field>

                    <v-btn type="submit" color="#000000">Ekle</v-btn>
                </v-form>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "StudentEkle",
    data() {
        return {
            student: {
                name: null,
                surname: null,
                number: null,
                class: null,
            },
        };
    },
    methods: {
        ekleStudent() {
            console.log("güncellenecek veri : ", this.student);
            alert("ekledim");

            axios
                .post("/api/student", {
                    name: this.student.name,
                    surname: this.student.surname,
                    number: this.student.number,
                    class: this.student.class,
                })
                .then((resp) => {
                    if (resp.status === 200) {
                        this.$router.push("/students");
                    }
                });
        },
    },
    mounted() {
        const id = this.$route.params.id;
        console.log("id -> ", id);
        axios.get("/api/students/" + id).then((res) => {
            console.log("Student detayı ", res.data);

            this.student.name = res.data.name;
            this.student.surname = res.data.surname;
            this.student.number = res.data.number;
            this.student.class = res.data.class;
        });
    },
};
</script>
