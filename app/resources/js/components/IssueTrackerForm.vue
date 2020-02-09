<template>
  <div id="app">
    <v-form>
      <v-card class="mx-auto" max-width="750" outlined>
        <v-card-title class="justify-center">
          <span class="headline">Issue Tracker Form</span>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col class="d-flex" cols="12" sm="8" md="8">
                <v-text-field
                  label="Title"
                  v-model="issue.title"
                  placeholder="Title"
                  :rules="titleRules"
                  outlined
                ></v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6" md="4">
                <v-select :items="statuses" label="Status" outlined v-model="issue.status"></v-select>
              </v-col>
            </v-row>
            <v-row>
              <v-col class="d-flex" cols="12" sm="6" md="3">
                <v-select :items="labs" label="Lab" outlined v-model="issue.room"></v-select>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6" md="5">
                <v-select
                  :items="assignables"
                  label="Assigned To"
                  outlined
                  v-model="issue.assigned_to"
                ></v-select>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6" md="4">
                <v-select :items="severities" label="Severity" outlined v-model="issue.severity"></v-select>
              </v-col>
            </v-row>
            <v-row cols="12" md="12">
              <v-col>
                <v-textarea
                  outlined
                  name="input-15-4"
                  :counter="150"
                  label="Description"
                  v-model="issue.description"
                ></v-textarea>
              </v-col>
            </v-row>
            <v-card>
              <v-card-text>Comments</v-card-text>
              <v-row>
                <v-list-item>
                  <v-list-item-avatar color="grey"></v-list-item-avatar>
                  <v-list-item-content>
                       <v-col md="4"> My Name here</v-col>
                      <v-col md="7">
                        <div>This is my first comment</div>
                      </v-col>
                     

                    <!-- <v-list-item-title class></v-list-item-title> -->
                  </v-list-item-content>
                </v-list-item>
              </v-row>
              <v-row cols="12" class="ma-4">
                <v-col>
                  <v-textarea
                    :counter="100"
                    label="Comments"
                    outlined
                    v-model="issue.latest_comment"
                  ></v-textarea>
                </v-col>
              </v-row>
              <v-card-actions>
                <v-btn>Post Comment</v-btn>
              </v-card-actions>
            </v-card>
            <v-row align="center" justify="center">
              <v-btn color="primary">
                <v-icon>mdi-mouse</v-icon>Post
              </v-btn>
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
    valid: false,
    issue: {
      title: null,
      desc: null,
      status: null,
      severity: null,
      room: null,
      assigned_to: null,
      latest_comment: null
    },
    id: window.location.pathname.split("/").pop(), //get this dynamic or from url

    titleRules: [v => !!v || "Title is required"],

    statuses: ["Open", "Closed"],
    labs: ["ED-400", "Lab2", "Lab3", "Lab4"],
    assignables: ["st4"],
    severities: [
      "Immediately Dangerous to Life or Health (IDLH)",
      "Critical Deficiency",
      "Urgent",
      "Non-critical"
    ]
  }),
  methods: {
    submitIssue() {
      if (valid) {
        var req = Object;
        req = Object.assign(req, this.id, this.issue);

        //     axios.put("/api/v1/issue/"+this.id, {
        //     // data : req
        //     headers: { Authorization: this.AuthStr }
        //     })
        //     .then(
        //     response => {
        //     console.log("fetch done!");
        //     this.issues = response.data.data;
        //     },
        // error => {console.log("fetch failed!");});
        //     }
      }
    }
  },
  mounted() {
    axios
      .all([
        axios.get("/api/v1/issue/" + this.id, {
          headers: { Authorization: this.AuthStr }
        }),
        axios.get("/api/v1/labs/", { headers: { Authorization: this.AuthStr } })
        //axios.get("/api/v1/users/", { headers: { Authorization: this.AuthStr }})
      ])
      .then(
        axios.spread(
          (issueResp, labResp) => {
            this.issue = issueResp.data.data;
            this.labs = labResp.data.data.map(x => x.location);
          },
          error => {
            console.log("fetch failed!");
          }
        )
      );
  }
};
</script>
