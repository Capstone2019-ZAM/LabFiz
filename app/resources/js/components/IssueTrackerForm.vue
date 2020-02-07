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
                  v-model="issue.title"
                  placeholder="Title"
                  :rules="titleRules"
                  clearable
                  outlined
                ></v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6" md="4">
                <v-select :items="statuses" label="Status" outlined v-model="issue.status"></v-select>
              </v-col>
            </v-row>
            <v-row>
              <v-col class="d-flex" cols="12" sm="6" md="3">
                <v-select :items="labs" label="Lab#" outlined v-model="issue.room"></v-select>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6" md="5">
                <v-select :items="assignables" label="Assigned To" outlined v-model="issue.assigned_to"></v-select>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6" md="3">
                <v-select :items="severities" label="Severity" outlined v-model="issue.severity"></v-select>
              </v-col>
            </v-row>
            <v-col cols="12" md="fill">
              <v-textarea solo name="input-15-4" :counter="150" label="Description" v-model="issue.desc"></v-textarea>
            </v-col>
            <v-col cols="12" md="fill">
              <v-textarea
                solo
                name="input-15-4"
                :counter="100"
                label="Comments"
                clearable
                v-model="issue.latest_comment"
              ></v-textarea>
            </v-col>
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
    data: ()=>({
        valid:false,
        issue:{
        title: null,
        desc: null,
        status : null,
        severity: null,
        room: null,
        assigned_to: null,
        latest_comment :null
        },
         id : 1,     //get this dynamic or from url
        
        titleRules: [
            v=> !!v || "Title is required"   ],

        statuses:['open',],
        labs:['ed-400','Lab2','Lab3','Lab4'],
        assignables:['st4'],
        severities:['high','low'],
    })
    ,
    methods:{
        submitIssue(){
            if(valid){
                var req = Object;
                req= Object.assign(req,this.title,this.desc,this.status,this.severity,this.lab,this.assigned_to);

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
      .get("/api/v1/issue/"+this.id, {
        headers: { Authorization: this.AuthStr }
      })
      .then(
        response => {
          console.log("fetch done!");
          this.issue = response.data.data;
          debugger
        },
        error => {
          console.log("fetch failed!");
        }
      );
    }
};
</script>
