<template>
    <div>
        <v-snackbar
            v-model="alert.show"
            :timeout="alert.timeout"
            top
            :color="alert.color"
            >{{ alert.text }}</v-snackbar
        >
        <v-container justify="center">
            <v-breadcrumbs :items="navlist"></v-breadcrumbs>
        </v-container>
        <v-row justify="center">
            <v-col cols="12" md="9" sm="12" xs="12" xl="6" lg="6">
                <v-card class="mx-auto">
                    <v-row align="center" justify="center">
                        <v-col cols="12" md="9">
                            <v-card-title class="ma2">Lab Details</v-card-title>

                            <v-card-text>
                                <v-text-field
                                    v-model="name"
                                    :rules="nameRules"
                                    label="Lab Name"
                                    required
                                >
                                </v-text-field>

                                <v-text-field
                                    v-model="location"
                                    :counter="10"
                                    label="Location"
                                    :disabled=namelock
                                    required
                                ></v-text-field>
                            </v-card-text>
                        </v-col>
                    </v-row>

                    <v-form v-model="valid"> </v-form>
                    <v-col align="right" justify="center">
                        <v-btn large class="ma-3" @click="navigate('labs')"
                            >Cancel</v-btn
                        >
                        <v-btn large color="primary" @click="postLab()">
                            <v-icon>mdi-content-save</v-icon>Save
                        </v-btn>
                    </v-col>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script>
export default {
    data: () => ({
        valid: null,
        loading: false,
        namelock: false,
        alert: {
            show: false,
            text: " ",
            timeout: 3000,
            color: "black"
        },
        AuthStr: localStorage.getItem("api"),
        id: window.location.pathname.split("/").pop(),
        name: "",
        location: "",
        nameRules: [
            v => !!v || "Name is required",
            v => v.length <= 400 || "Name must be less than 400 characters"
        ],

        navlist: [
            {
                text: "Home",
                disabled: false,
                href: "/dashboard"
            },
            {
                text: "All Labs",
                disabled: false,
                href: "/labs"
            },
            {
                text: "Lab",
                disabled: true,
                href: ""
            }
        ]
    }),
    methods: {
        navigate(point) {
            window.location.href = "/" + point;
        },
        setSnack(on, txt, col, time) {
            this.alert.show = on;
            this.alert.text = txt;
            this.alert.color = col;
        },
        postLab: function() {
            let req = Object();
            req.name = this.name;
            req.location = this.location;
            if (this.valid) {
                this.setSnack(true, "Saving...", "success");
                if (
                    Number.isInteger(
                        parseInt(window.location.pathname.split("/").pop())
                    )
                ) {
                    req.id = this.id;
                    axios
                        .post("/api/v1/lab/" + this.id, req, {
                            headers: {
                                Authorization: "Bearer " + this.AuthStr,
                                "Content-Type": "application/json"
                            }
                        })
                        .then(
                            response => {
                                this.items = response.data; //
                                this.setSnack(
                                    true,
                                    "Saved Successfully",
                                    "success"
                                );
                            },
                            error => {
                                this.setSnack(
                                    true,
                                    "Failed to save lab.",
                                    "error"
                                );
                            }
                        );
                } else {
                    axios
                        .post("/api/v1/lab", req, {
                            headers: {
                                Authorization: "Bearer " + this.AuthStr,
                                "Content-Type": "application/json"
                            }
                        })
                        .then(
                            response => {
                                this.items = response.data;
                                this.setSnack(
                                    true,
                                    "lab Created Successfully.",
                                    "success"
                                );
                                window.location.href =
                                    "/lab/" + this.items.data.id;
                            },
                            error => {
                                this.setSnack(
                                    true,
                                    "Failed to create lab.",
                                    "error"
                                );
                            }
                        );
                }
            }
        }
    },
    mounted() {
        this.loading = true;
            this.namelock = false;

        if (
            Number.isInteger(
                parseInt(window.location.pathname.split("/").pop())
            )
        ) {
            this.namelock = true;
            axios
                .get("/api/v1/lab/" + this.id, {
                    headers: { Authorization: "Bearer " + this.AuthStr }
                })
                .then(
                    response => {
                        this.name = response.data.data.name;
                        this.location = response.data.data.location;
                        this.id = response.data.data.id;
                        this.loading = false;
                        this.namelock = true;
                    },
                    error => {
                        this.setSnack(true, "Failed to retrieve lab", "error");
                    }
                );
        }
    }
};
</script>

<style scoped>
.border {
    border-color: black;
}
</style>
