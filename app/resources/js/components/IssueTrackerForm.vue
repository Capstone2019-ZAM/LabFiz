<template>
  <div id="app">
    <v-form v-model="valid">
      <v-card class="mx-auto" max-width="750" outlined>
        <v-card-title class="justify-center">
          <span class="headline">Issue Tracker Form</span>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col class="d-flex" cols="12" sm="8" md="8">
                <v-text-field label="Title" v-model="issue.title" :rules="titleRules" outlined></v-text-field>
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
                <v-select :rules="labRules" :items="labs" label="Lab" outlined v-model="issue.room"></v-select>
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
                  <v-date-picker v-model="issue.due_date" @input="menu2 = false"></v-date-picker>
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
                <v-list-item class="ml-3 mr-3 mb-0" v-for="data in comments" :key="data.id">
                  <v-list-item-avatar color="grey"></v-list-item-avatar>
                  <v-list-item-content>
                    <v-col md="2" sm="1">
                      <v-row>
                        <div>{{data.user_name}}</div>
                      </v-row>
                      <v-row>{{data.updated_at}}</v-row>
                    </v-col>
                    <v-col md="7" sm="9">
                      <div>{{data.content}}</div>
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
                  <v-btn class="mr-9" @click="postComment()">Post Comment</v-btn>
                </v-row>
              </v-col>
            </v-card>
            <v-row align="center" justify="end" class="ma-9">
              <v-btn large color="primary" @click="saveIssue()">Save</v-btn>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-form>

    <v-dialog v-model="dialog" overlay-opacity="0" width="50%">
      <v-card color="white" class="ma-4" width="95%" v-if="!valid||Saving||NetError||SaveSucc">
        <v-alert type="info" text transition="scale-transition" :value="Saving&&valid">
          <v-progress-circular indeterminate color="primary"></v-progress-circular>Saving
        </v-alert>

        <v-alert
          type="warning"
          dense
          prominent
          transition="scale-transition"
          :value="!valid"
        >Form missing required fields</v-alert>

        <v-alert type="success" transition="scale-transition" :value="SaveSucc">Saved Successfully</v-alert>

        <v-alert
          type="error"
          transition="scale-transition"
          :value="NetError"
          dismissible="true"
          dense
        >Something went wrong. Please try again later</v-alert>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import format from "date-fns/format";
import parseISO from "date-fns/parseISO";

export default {
  data: () => ({
    AuthStr: localStorage.getItem("api"),
    dialog: false,
    Saving: false,
    NetError: false,
    SaveSucc: false,
    loading: false,
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
        id: 1,
        issue_id: 1,
        user_id: 1,
        updated_at: "2020-02-01",
        content: "My comment is here"
      },
      {
        id: 2,
        issue_id: 1,
        user_name: "",
        user_id: 1,
        updated_at: "2020-02-01",
        content: "My comment 2is here"
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
    getNamebyId(t_id){
     let n= this.assignables.find( x => x.id ==t_id);
     return n.name;
    },
    getFullName(el) {
      return el.first_name + " " + el.last_name;
    },
    saveIssue() {
      //this.dialog = true;

      if (this.valid) {
        var req = Object;
        // req = Object.assign(req, this.id, this.issue);
        req = this.issue;
        //Save Exisiting Issue
        if (
          Number.isInteger(parseInt(window.location.pathname.split("/").pop()))
        ) {
          axios
            .post("/api/v1/issue/" + this.id, req, {
              headers: {
                Authorization: this.AuthStr,
                "Content-Type": "application/json"
              }
            })
            .then(
              response => {
                console.log("fetch done!");
                this.issues = response.data.data;
              },
              error => {
                console.log("fetch failed!");
              }
            );
        } else {
          axios
            .post("/api/v1/issue", req, {
              headers: {
                Authorization: this.AuthStr,
                "Content-Type": "application/json"
              }
            })
            .then(
              response => {
                console.log("Issue created done!");
                window.location.href = "/issue/" + response.data.data.id;
                //this.issues = response.data.data;
              },
              error => {
                console.log("fetch failed!");
              }
            );
        }
      }
    },
    postComment() {
      let req = Object();
      req.content = this.issue.latest_comment;
      req.issue_id = this.id;
      axios
        .post("/api/v1/comment",req, {
          headers: { Authorization: this.AuthStr,  "Content-Type": "application/json" }
        })
        .then(
          response => {
            console.log("comment posted!");
            debugger
            response.data.data.user_name = this.getNamebyId(response.data.data.user_id);
            this.comments.push(response.data.data);
            this.issue.latest_comment = ""
          },
          error => {
            console.log("comment post failed!");
            // show error here
          }
        );
    }
  },
  mounted() {
    if (Number.isInteger(parseInt(window.location.pathname.split("/").pop()))) {
      axios
        .all([
          axios.get("/api/v1/issue/" + this.id, {
            headers: { Authorization: this.AuthStr }
          }),
          axios.get("/api/v1/labs", {
            headers: { Authorization: this.AuthStr }
          }),
          axios.get("/api/users", { headers: { Authorization: this.AuthStr } }),
          axios.get("/api/v1/comment/"+this.id, { headers: { Authorization: this.AuthStr }}),
        ])
        .then(
          axios.spread(
            (issueResp, labResp, userResp, commentResp) => {
              this.labs = labResp.data.data.map(x => x.location);
              this.assignables = userResp.data.data.map(x => {
                let t = Object();
                t.name = x.first_name + " " + x.last_name;
                t.id = x.id;
                return t;
              });

              this.issue = issueResp.data.data;
              this.issue.assigned_to = this.issue.user_id;
              
              commentResp.data.data=  commentResp.data.data.map( el=> {
                 let t = Object();
                t.user_name = this.getNamebyId(el.user_id);
                t.updated_at = el.updated_at;
                t.content = el.content;
                return t;
                });
              this.comments=commentResp.data.data;
              
            },
            error => {
              console.log("fetch failed!");
            }
          )
        );
    } else {
      axios
        .all([
          axios.get("/api/v1/labs", {
            headers: { Authorization: this.AuthStr }
          }),
          axios.get("/api/users", { headers: { Authorization: this.AuthStr } })
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
            error => {
              console.log("fetch failed!");
            }
          )
        );
    }
  }
};
</script>
<style>
.scrollable{
  height: 400px;
  overflow: auto;
}
</style>