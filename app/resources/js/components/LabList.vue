<template>
    <div>
        <v-row justify="center">
            <v-container justify="center">
                <v-breadcrumbs :items="navlist"></v-breadcrumbs>
            </v-container>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" md="12">
                <v-card class="mx-auto" width="80%">
                    <v-card-title>Labs</v-card-title>
                    <v-list two-line subheader>
                        <v-list-item
                            v-for="item in items.data"
                            :key="item.id"
                            @click="navigate(item.id)"
                        >
                            <v-list-item-avatar>
                                <v-icon
                                    :class="iconClass"
                                    v-text="icon"
                                ></v-icon>
                            </v-list-item-avatar>

                            <v-list-item-content>
                                <v-list-item-title
                                    v-text="item.name"
                                ></v-list-item-title>
                                <v-list-item-subtitle
                                    v-text="item.location"
                                ></v-list-item-subtitle>
                            </v-list-item-content>

                        
                        </v-list-item>
                    </v-list>

                    <v-btn
                        block
                        outlined
                        @click="navigate()"
                    >
                        Add new Lab
                        <v-icon dark>mdi-plus</v-icon>
                    </v-btn>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script>
export default {
    data() {
        return {
            AuthStr: localStorage.getItem("api"),
            loading: true,
            icon: "mdi-domain",
            iconClass: "grey lighten-1 white--text",
            items: { data: null },
            navlist: [
                {
                    text: "Home",
                    disabled: false,
                    href: "/dashboard"
                },
                {
                    text: "All Labs",
                    disabled: true,
                    href: "/labs"
                }
            ]
        };
    },

    methods: {
        navigate(id) {
            if (id == null) {
                window.location.href = "/lab";
            } else window.location.href = "/lab/" + id;
        },
         deleteLab(id) {
              axios
            .delete("/api/v1/lab", {
                headers: { Authorization: "Bearer " + this.AuthStr }
            })
            .then(
                response => {
                     window.location.href = "/labs";
                },
                error => {
                    this.loading = false;
                }
            );
           
        }
    },
    mounted() {
        this.loading = true;
        axios
            .get("/api/v1/labs", {
                headers: { Authorization: "Bearer " + this.AuthStr }
            })
            .then(
                response => {
                    this.items = response.data;
                    this.loading = true;
                },
                error => {
                    this.loading = false;
                }
            );
    }
};
</script>
