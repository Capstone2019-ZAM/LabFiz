<template>
    <div>
        <v-snackbar
            v-model="alert.show"
            :timeout="alert.timeout"
            top
            :color="alert.color"
            >{{ alert.text }}</v-snackbar
        >
        <v-row justify="center">
            <v-col cols="12" md="9">
                <v-form v-model="valid">
                    <v-card>
                        <v-card-title>Assign Inspection</v-card-title>
                        <v-container>
                            <v-row>
                                <v-col cols="12" md="3">
                                    <v-select
                                        :rules="templateRules"
                                        item-text="name"
                                        item-value="id"
                                        v-model="inspection.selected_report"
                                        :items="reports"
                                        label="Report"
                                        prepend-icon="mdi-file-document"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" md="3">
                                    <v-select
                                        :rules="labRules"
                                        item-text="location"
                                        item-value="location"
                                        v-model="inspection.selected_lab"
                                        :items="labs"
                                        label="Labarotory"
                                        prepend-icon="mdi-office-building"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" md="3">
                                    <v-select
                                        :rules="inspectorRules"
                                        item-text="name"
                                        item-value="id"
                                        v-model="inspection.selected_inspector"
                                        :items="inspectors"
                                        label="Assigned To"
                                        prepend-icon="mdi-account"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" md="3">
                                    <v-menu
                                        v-model="menu2"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        transition="scale-transition"
                                        offset-y
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-text-field
                                                prepend-icon="mdi-calendar"
                                                :rules="dateRules"
                                                v-model="inspection.due_date"
                                                readonly
                                                label="Due Date"
                                                v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="inspection.due_date"
                                            @input="menu2 = false"
                                        ></v-date-picker>
                                    </v-menu>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col align="end">
                                    <v-btn dark @click="assign()">Assign</v-btn>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card>
                </v-form>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import format from "date-fns/format";
import parseISO from "date-fns/parseISO";

export default {
    data() {
        return {
            AuthStr: localStorage.getItem("api"),
            valid: false,
            alert: {
                show: false,
                text: " ",
                timeout: 3000,
                color: "black"
            },
            inspection: {
                selected_lab: null,
                selected_inspector: null,
                selected_report: null,
                due_date: new Date().toISOString().substr(0, 10)
            },
            reports: [],
            inspectors: [],
            labs: [],
            menu2: false,

            templateRules: [v => !!v || "Report Template is required"],
            labRules: [v => !!v || "Lab is required"],
            inspectorRules: [v => !!v || "Inspector is required"],
            dateRules: [v => !!v || "Due Date is required"]
        };
    },
    computed: {
        formattedDate() {
            return this.due_date
                ? format(parseISO(this.due_date), "Do MMM yyyy")
                : "";
        }
    },
    mounted() {
        this.initialize();
    },
    methods: {
        assign() {
            if (this.valid) {
                let req = new Object();
                req.template_id = this.inspection.selected_report;
                req.due_date = this.inspection.due_date;
                req.assigned_to = this.inspection.selected_inspector;
                req.lab = this.inspection.selected_lab;
                let t = new Date().toISOString().substr(0, 10);
                let y = this.reports.find(
                    x => x.id == this.inspection.selected_report
                );
                req.title = y.name + " - " + t;
                axios
                    .post("/api/v1/report", req, {
                        headers: { Authorization: "Bearer " + this.AuthStr }
                    })
                    .then(
                        response => {
                            this.setSnack(
                                true,
                                "Assignment Created Successfully.",
                                "success"
                            );

                        },
                        error => {
                            this.setSnack(
                                true,
                                "Failed to create assignment.",
                                "error"
                            );
                        }
                    );
            } else {
                this.setSnack(true, "Required items are missing.", "warning");
            }
        },
        initialize() {
            axios
                .all([
                    axios.get("/api/v1/labs", {
                        headers: { Authorization: "Bearer " + this.AuthStr }
                    }),
                    axios.get("/api/users", {
                        headers: { Authorization: "Bearer " + this.AuthStr }
                    }),
                    axios.get("/api/v1/templates", {
                        headers: { Authorization: "Bearer " + this.AuthStr }
                    })
                ])
                .then(
                    axios.spread(
                        (labResp, userResp, templateResp) => {
                            this.inspectors = userResp.data.data.map(x => {
                                let t = Object();
                                t.name = x.first_name + " " + x.last_name;
                                t.id = x.id;
                                return t;
                            });

                            this.labs = labResp.data.data.map(x => x.location);
                            this.reports = templateResp.data.data;
                        },
                        error => {
                            this.labs = ["No data found"];
                            this.reports = ["No data found"];
                        }
                    )
                );
        },
        setSnack(on, txt, col, time) {
            this.alert.show = on;
            this.alert.text = txt;
            this.alert.color = col;
        }
    }
};
</script>

<style scoped>
.border {
    border-block-color: black;
}
</style>
