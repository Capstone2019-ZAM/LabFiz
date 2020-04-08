<template>
    <v-row justify="center">
        <v-container justify="center">
            <v-breadcrumbs :items="navlist"></v-breadcrumbs>
        </v-container>
        <v-col cols="12" md="12">
            <v-card class="mx-auto" width="80%">
                <v-card-title>Report Templates</v-card-title>
                <v-list two-line subheader>
                    <v-list-item
                        v-for="item in items.data"
                        :key="item.id"
                        @click="navigate(item.id)"
                    >
                        <v-list-item-avatar>
                            <v-icon :class="iconClass" v-text="icon"></v-icon>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title
                                v-text="item.name"
                            ></v-list-item-title>
                            <v-list-item-subtitle
                                v-text="item.updated_at"
                            ></v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-action>
                            <v-btn icon>
                                <v-icon color="grey lighten-1"
                                    >mdi-information</v-icon
                                >
                            </v-btn>
                        </v-list-item-action>
                    </v-list-item>
                </v-list>

                <v-btn
                    block
                    outlined
                    color="indigo"
                    class="ma-10"
                    @click="navigate()"
                >
                    Add new Template
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </v-card>
        </v-col>
    </v-row>
</template>
<script>
import format from "date-fns/format";
import parseISO from "date-fns/parseISO";

export default {
    data() {
        return {
            AuthStr: localStorage.getItem("api"),
            loading: true,
            icon: "mdi-clipboard-text",
            iconClass: "grey lighten-1 white--text",
            items: { data: null },
            navlist: [
                {
                    text: "Home",
                    disabled: false,
                    href: "/dashboard"
                },
                {
                    text: "All Templates",
                    disabled: true,
                    href: "/templates"
                }
            ]
        };
    },

    methods: {
        navigate(id) {
            if (id == null) {
                window.location.href = "/template";
            } else window.location.href = "/template/" + id;
        },
        formattedDate(dt) {
            return dt ? format(parseISO(dt), "MM/dd/yyyy") : "";
        }
    },
    mounted() {
        this.loading = true;
        axios
            .get("/api/v1/templates", {
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
