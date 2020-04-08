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
                        <v-row align="center" justify="center">
                            <v-col cols="12" md="9">
                                <v-card-title class="ma2"
                                    >Template Builder</v-card-title
                                >
                                <v-spacer></v-spacer>
                            </v-col>
                        </v-row>
                    </v-row>

                    <v-form v-model="valid">
                        <v-container>
                            <div class="border pa-4 mb-4 mt-5">
                                <v-row>
                                    <v-col cols="12" md="9" sm="10">
                                        <v-text-field
                                            v-model="name"
                                            outlined
                                            :rules="qRules"
                                            label="Report Title"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                    <v-spacer></v-spacer>
                                </v-row>
                            </div>
                            <div
                                class="border pa-4"
                                v-for="sec in sections"
                                :key="sec.id"
                            >
                                <v-row>
                                    <v-col cols="12" md="6" sm="10">
                                        <v-text-field
                                            v-model="sec.section_nm"
                                            label="Section Title"
                                            :rules="qRules"
                                            outlined
                                            required
                                        ></v-text-field>
                                    </v-col>
                                    <v-spacer></v-spacer>
                                    <v-col cols="12" md="1" sm="1">
                                        <v-btn
                                            color="red"
                                            small
                                            icon
                                            @click="
                                                removeSection(sec, sections)
                                            "
                                        >
                                            <v-icon>mdi-close-circle</v-icon>
                                        </v-btn>
                                    </v-col>
                                </v-row>
                                <v-row
                                    v-for="(qs, index) in sec.questions"
                                    :key="index"
                                >
                                    <v-col cols="12" md="8" sm="10">
                                        <v-text-field
                                            v-model="sec.questions[index]"
                                            :rules="qRules"
                                            label="Question"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                    <v-spacer></v-spacer>

                                    <v-col cols="12" md="1" sm="1">
                                        <v-btn
                                            @click="
                                                removeQuestion(
                                                    qs,
                                                    sec.questions
                                                )
                                            "
                                            icon
                                            color="error"
                                        >
                                            <v-icon
                                                >mdi-minus-circle-outline</v-icon
                                            >
                                        </v-btn>
                                    </v-col>
                                </v-row>

                                <v-row align="center" justify="center">
                                    <v-btn
                                        color="primary"
                                        @click="addQuestion(sec)"
                                    >
                                        <v-icon>mdi-plus-circle</v-icon>Add
                                        Question
                                    </v-btn>
                                </v-row>
                            </div>
                            <v-row class="ma-3"></v-row>
                            <v-row align="center" justify="center">
                                <v-btn
                                    block
                                    color="primary"
                                    @click="addSection(this, sections)"
                                >
                                    <v-icon>mdi-plus-circle</v-icon>Add Section
                                </v-btn>
                            </v-row>
                        </v-container>
                    </v-form>
                    <v-col align="right" justify="center">
                        <v-btn large class="ma-3" @click="navigate('templates')"
                            >Cancel</v-btn
                        >
                        <v-btn large color="primary" @click="postTemplate()">
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
        alert: {
            show: false,
            text: " ",
            timeout: 3000,
            color: "black"
        },
        AuthStr: localStorage.getItem("api"),
        id: window.location.pathname.split("/").pop(),
        name: "",
        new: null,

        qRules: [v => !!v || "Item value is required"],
        sections: [
            {
                section_nm: "Section 1",
                questions: ["q1"]
            }
        ],
        navlist: [
            {
                text: "Home",
                disabled: false,
                href: "/dashboard"
            },
            {
                text: "All Templates",
                disabled: false,
                href: "/templates"
            },
            {
                text: "Template #",
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
        addQuestion: function(sec) {
            sec.questions.push("");
        },
        removeQuestion: function(q, section) {
            function toRemove(element, index, array) {
                return element == q;
            }
            var n = section.findIndex(toRemove);
            section.splice(n, 1);
        },
        addSection: function(t, sec) {
            var newSec = Object();
            newSec.section_nm = "New Section";
            newSec.questions = Array();
            sec.push(newSec);
        },
        removeSection: function(sec, sections) {
            function toRemove(element, index, array) {
                return element.section_nm == sec.section_nm;
            }
            var n = sections.findIndex(toRemove);
            sections.splice(n, 1);
        },

        postTemplate: function() {
            let req = Object();
            req.name = this.name;
            req.schema = JSON.stringify(this.sections);
            if (this.valid) {
                this.setSnack(true, "Saving...", "success");
                if (
                    Number.isInteger(
                        parseInt(window.location.pathname.split("/").pop())
                    )
                ) {
                    req.id = this.id;
                    axios
                        .post("/api/v1/template/" + this.id, req, {
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
                                    "Failed to save template.",
                                    "error"
                                );
                            }
                        );
                } else {
                    axios
                        .post("/api/v1/template", req, {
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
                                    "Template Created Successfully.",
                                    "success"
                                );
                                window.location.href =
                                    "/template/" + this.items.data.id;
                            },
                            error => {
                                this.setSnack(
                                    true,
                                    "Failed to create template.",
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

        if (
            Number.isInteger(
                parseInt(window.location.pathname.split("/").pop())
            )
        ) {
            axios
                .get("/api/v1/template/" + this.id, {
                    headers: { Authorization: "Bearer " + this.AuthStr }
                })
                .then(
                    response => {
                        let schema = JSON.parse(response.data.data.schema);
                        this.sections = schema;
                        this.name = response.data.data.name;
                        this.id = response.data.data.id;
                        this.loading = false;
                    },
                    error => {
                        this.setSnack(
                            true,
                            "Failed to retrieve template",
                            "error"
                        );
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
