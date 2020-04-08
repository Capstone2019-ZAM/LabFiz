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
        <v-form v-model="valid">
            <v-card class="mx-auto" max-width="750">
                <v-card-title class="justify-center"
                    >Issue Tracker Form</v-card-title
                >
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col class="d-flex" cols="12" sm="8" md="8">
                                <v-text-field
                                    label="Title"
                                    v-model="issue.title"
                                    :rules="titleRules"
                                    outlined
                                ></v-text-field>
                            </v-col>
                            <v-col class="d-flex" cols="12" sm="6" md="4">
                                <v-select
                                    :rules="statusRules"
                                    :items="statuses"
                                    label="Status"
                                    outlined
                                    v-model="issue.status"
                                ></v-select>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col class="d-flex" cols="12" sm="6" md="3">
                                <v-select
                                    :rules="labRules"
                                    :items="labs"
                                    label="Lab"
                                    outlined
                                    v-model="issue.room"
                                ></v-select>
                            </v-col>
                            <v-col class="d-flex" cols="12" sm="6" md="5">
                                <v-select
                                    :items="assignables"
                                    item-text="name"
                                    item-value="id"
                                    label="Assigned To"
                                    outlined
                                    :rules="assignRules"
                                    v-model="issue.assigned_to"
                                ></v-select>
                            </v-col>
                            <v-col class="d-flex" cols="12" sm="6" md="4">
                                <v-select
                                    :rules="sevRules"
                                    :items="severities"
                                    label="Severity"
                                    outlined
                                    v-model="issue.severity"
                                ></v-select>
                            </v-col>
                        </v-row>
                        <v-row cols="12">
                            <v-col md="3">
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
                                            :rules="dateRules"
                                            v-model="issue.due_date"
                                            readonly
                                            label="Resolution Date"
                                            v-on="on"
                                            outlined
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="issue.due_date"
                                        @input="menu2 = false"
                                    ></v-date-picker>
                                </v-menu>
                            </v-col>
                        </v-row>
                        <v-row cols="12" md="12">
                            <v-col>
                                <v-textarea
                                    outlined
                                    name="input-15-4"
                                    :counter="150"
                                    label="Description"
                                    :rules="descRules"
                                    v-model="issue.description"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                        <v-card v-if="Number.isInteger(parseInt(this.id))">
                            <v-card-text>Comments</v-card-text>
                            <div class="scrollable">
                                <v-list dense disabled>
                                    <v-list-item
                                        class="ml-3 mr-3 mb-0"
                                        v-for="data in comments"
                                        :key="data.id"
                                    >
                                        <v-list-item-avatar
                                            color="grey"
                                        ></v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-col md="2" sm="1">
                                                <v-row>
                                                    <div>
                                                        {{ data.user_name }}
                                                    </div>
                                                </v-row>
                                                <v-row>{{
                                                    data.updated_at
                                                }}</v-row>
                                            </v-col>
                                            <v-col md="7" sm="9">
                                                <div>{{ data.content }}</div>
                                            </v-col>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </div>
                            <v-col>
                                <v-row cols="12" class="mr-4 ml-4">
                                    <v-col>
                                        <v-textarea
                                            label="Comment"
                                            outlined
                                            rows="3"
                                            auto-grow
                                            v-model="issue.latest_comment"
                                        ></v-textarea>
                                    </v-col>
                                </v-row>
                                <v-row align="start" justify="end">
                                    <v-btn class="mr-9" @click="postComment()"
                                        >Post Comment</v-btn
                                    >
                                </v-row>
                            </v-col>
                        </v-card>
                        <v-row align="center" justify="end" class="ma-9">
                            <v-btn
                                large
                                class="ma-3"
                                @click="navigate('issues')"
                                >Cancel</v-btn
                            >
                            <v-btn large color="primary" @click="saveIssue()"
                                >Save</v-btn
                            >
                        </v-row>
                    </v-container>
                </v-card-text>
            </v-card>
        </v-form>
    </div>
</template>
<script>
export default {
    data: () => ({
        AuthStr: localStorage.getItem("api"),
        dialog: false,
        alert: {
            show: false,
            text: " ",
            timeout: 3000,
            color: "black"
        },
        valid: true,
        menu2: false,
        issue: {
            title: null,
            description: null,
            status: null,
            severity: null,
            room: null,
            assigned_to: null,
            due_date: new Date().toISOString().substr(0, 10)
        },
        latest_comment: null,
        comments: [
            {
                id: null,
                issue_id: null,
                user_name: "",
                user_id: null,
                updated_at: "2020-02-01",
                content: ""
            }
        ],
        id: window.location.pathname.split("/").pop(), //get this dynamic or from url
        titleRules: [v => !!v || "Title is required"],
        labRules: [v => !!v || "Lab is required"],
        assignRules: [v => !!v || "Assignee is required"],
        dateRules: [v => !!v || "Resolution date is required"],
        statusRules: [v => !!v || "Status is required"],
        descRules: [v => !!v || "Description is required"],
        sevRules: [v => !!v || "Severity classification is required"],
        statuses: ["Open", "Closed"],

        labs: [],
        assignables: [],
        severities: [
            "Immediately Dangerous to Life or Health (IDLH)",
            "Critical Deficiency",
            "Urgent",
            "Non-critical"
        ],
        navlist: [
            {
                text: "Home",
                disabled: false,
                href: "/dashboard"
            },
            {
                text: "All Issues",
                disabled: false,
                href: "/issues"
            },
            {
                text: "Issue",
                disabled: true,
                href: ""
            }
        ]
    }),
    computed: {
        formattedDate() {
            return this.issue.due_date
                ? format(parseISO(this.issue.due_date), "Do MMM yyyy")
                : "";
        }
    },
    methods: {
        setSnack(on, txt, col, time) {
            this.alert.show = on;
            this.alert.text = txt;
            this.alert.color = col;
        },
        navigate(point) {
            window.location.href = "/" + point;
        },
        getNamebyId(t_id) {
            let n = this.assignables.find(x => x.id == t_id);
            return n.name;
        },
        getFullName(el) {
            return el.first_name + " " + el.last_name;
        },
        saveIssue() {

            if (this.valid) {
                var req = Object;
                req = this.issue;
                //Save Exisiting Issue
                if (
                    Number.isInteger(
                        parseInt(window.location.pathname.split("/").pop())
                    )
                ) {
                    axios
                        .post("/api/v1/issue/" + this.id, req, {
                            headers: {
                                Authorization: "Bearer " + this.AuthStr,
                                "Content-Type": "application/json"
                            }
                        })
                        .then(
                            response => {
                                this.issues = response.data.data;
                                this.setSnack(
                                    true,
                                    "Saved Successfully",
                                    "success"
                                );
                            },
                            error => {
                                this.setSnack(
                                    true,
                                    "Failed to save issue log.",
                                    "error"
                                );
                            }
                        );
                } else {
                    axios
                        .post("/api/v1/issue", req, {
                            headers: {
                                Authorization: "Bearer " + this.AuthStr,
                                "Content-Type": "application/json"
                            }
                        })
                        .then(
                            response => {
                                window.location.href =
                                    "/issue/" + response.data.data.id;
                                this.setSnack(
                                    true,
                                    "Issue Logged Successfully.",
                                    "success"
                                );
                            },
                            error => {
                                this.setSnack(
                                    true,
                                    "Failed to create issue log.",
                                    "error"
                                );
                            }
                        );
                }
            } else {
                this.setSnack(
                    true,
                    "Required items are not filled.",
                    "warning"
                );
            }
        },
        postComment() {
            let req = Object();
            req.content = this.issue.latest_comment;
            req.issue_id = this.id;
            axios
                .post("/api/v1/comment", req, {
                    headers: {
                        Authorization: "Bearer " + this.AuthStr,
                        "Content-Type": "application/json"
                    }
                })
                .then(
                    response => {
                        response.data.data.user_name = this.getNamebyId(
                            response.data.data.user_id
                        );
                        this.setSnack(true, "Comment Added", "success");
                        this.comments.push(response.data.data);
                        this.issue.latest_comment = "";
                    },
                    error => {
                        this.setSnack(true, "Failed to post comment.", "error");
                    }
                );
        }
    },
    mounted() {
        if (
            Number.isInteger(
                parseInt(window.location.pathname.split("/").pop())
            )
        ) {
            axios
                .all([
                    axios.get("/api/v1/issue/" + this.id, {
                        headers: { Authorization: "Bearer " + this.AuthStr }
                    }),
                    axios.get("/api/v1/labs", {
                        headers: { Authorization: "Bearer " + this.AuthStr }
                    }),

                    axios.get("/api/v1/comment/" + this.id, {
                        headers: { Authorization: "Bearer " + this.AuthStr }
                    })
                ])
                .then(
                    axios.spread(
                        (issueResp, labResp, commentResp) => {                            
                            this.labs = labResp.data.data.map(x => x.location);
                            this.assignables = issueResp.data.data.users.map(
                                x => {
                                    let t = Object();
                                    t.name = x.first_name + " " + x.last_name;
                                    t.id = x.id;
                                    return t;
                                }
                            );

                            this.issue = issueResp.data.data;
                            commentResp.data.data = commentResp.data.data.map(
                                el => {
                                    let t = Object();
                                    t.user_name = this.getNamebyId(el.user_id);
                                    t.updated_at = el.updated_at;
                                    t.content = el.content;
                                    return t;
                                }
                            );
                            this.comments = commentResp.data.data;
                        },
                        error => {}
                    )
                );
        } else {
            axios
                .all([
                    axios.get("/api/v1/labs", {
                        headers: { Authorization: "Bearer " + this.AuthStr }
                    }),
                    axios.get("/api/users", {
                        headers: { Authorization: "Bearer " + this.AuthStr }
                    })
                ])
                .then(
                    axios.spread(
                        (labResp, userResp) => {
                            this.assignables = userResp.data.data.map(x => {
                                let t = Object();
                                t.name = x.first_name + " " + x.last_name;
                                t.id = x.id;
                                return t;
                            });

                            this.labs = labResp.data.data.map(x => x.location);
                        },
                        error => {}
                    )
                );
        }
    }
};
</script>
<style>
.scrollable {
    max-height: 400px;
    /* height: 400px; */
    overflow: auto;
}
</style>
