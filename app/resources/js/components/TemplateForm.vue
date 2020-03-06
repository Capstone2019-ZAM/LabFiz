<template>
<div>
   <v-container justify="center">
     <v-breadcrumbs :items="navlist"></v-breadcrumbs>
    </v-container>
  <v-row justify="center">
    <v-col cols="12" md="9" sm="12" xs="12" xl="6" lg="6">
      <v-card class="mx-auto">
        <v-row align="center" justify="center">
          <v-row align="center" justify="center">
            <v-col cols="12" md="9">
              <v-card-title class="ma2">Template Builder</v-card-title>
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
            <div class="border pa-4" v-for="sec in sections" :key="sec.id">
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
                  <v-btn color="red" small icon @click="removeSection(sec,sections)">
                    <v-icon>mdi-close-circle</v-icon>
                  </v-btn>
                </v-col>
              </v-row>
              <v-row v-for="(qs,index) in sec.questions" :key="index">
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
                  <v-btn @click="removeQuestion(qs,sec.questions)" icon color="error">
                    <v-icon>mdi-minus-circle-outline</v-icon>
                  </v-btn>
                </v-col>
              </v-row>

              <v-row align="center" justify="center">
                <v-btn color="primary" @click="addQuestion(sec)">
                  <v-icon>mdi-plus-circle</v-icon>Add Question
                </v-btn>
              </v-row>
            </div>
            <v-row class="ma-3"></v-row>
            <v-row align="center" justify="center">
              <v-btn block color="primary" @click="addSection(this, sections)">
                <v-icon>mdi-plus-circle</v-icon>Add Section
              </v-btn>
            </v-row>
          </v-container>
        </v-form>
        <v-col align="right" justify="center">
          <v-btn large class="ma-3" @click="navigate('templates')">Cancel</v-btn>
        <v-btn large color="primary" @click="postTemplate()">
                <v-icon>mdi-content-save</v-icon>Save
              </v-btn>
        </v-col>
      </v-card>
    </v-col>
  </v-row>
 <v-dialog v-model="dialog"  overlay-opacity="0"  width="50%">
        <v-card color="white" class="ma-4" width="95%"  v-if="!valid||Saving||NetError||SaveSucc">
          <v-alert
            type="info"
            text
            transition="scale-transition"
            :value="Saving&&valid"
          >
            <v-progress-circular indeterminate color="primary"></v-progress-circular>Saving
          </v-alert>
        
          <v-alert
            type="warning"
            dense
            prominent
            transition="scale-transition"
            :value="!valid"
          >Template missing required fields</v-alert>
     
          <v-alert      
            type="success"
            transition="scale-transition"
            :value="SaveSucc"
          >Saved Successfully</v-alert>
  
          <v-alert
            type="error"
            transition="scale-transition"
            :value="NetError"
            
            dense
          >Something went wrong. Please try again later</v-alert>
           </v-card>
  </v-dialog>
</div>
</template>
<script>
export default {
  data: () => ({
    dialog: false,
    valid: null,
    Saving: false,
    NetError: false,
    SaveSucc: false,
    loading: false,
    AuthStr: localStorage.getItem("api"),
    id: window.location.pathname.split("/").pop(), // Get this from URL or router
    name: "",
    new: null,

    qRules: [v => !!v || "Item value is required"],
    sections: 
    [
      {
        section_nm: "Section 1",
        questions: ["q1"]
      }
    ],
    navlist:[
        {
          text: 'Home',
          disabled: false,
          href: '/dashboard',
        },
        {
          text: 'All Templates',
          disabled: false,
          href: '/templates',
        },
        {
          text: 'Template #',
          disabled: true,
          href: '',
        },
      ],
  }),
  methods: {
    navigate(point){
      window.location.href = '/'+point
    },
    setAlert: async function(msg) {
      this.dialog= true;
      this.Saving = false;
      this.NetError = false;
      this.SaveSucc = false;

      let promise = new Promise((resolve, reject) => {
        setTimeout(() => resolve(true), 400);
      });

      let result = await promise; // wait until the promise resolves (*)

      switch (msg) {
        case "Saving":
          this.Saving = result;
          break;
        case "NetError":
          this.NetError = result;

          break;
        case "SaveSucc":
          this.SaveSucc = result;
          break;

        default:
          break;
      }
    },
    addQuestion: function(sec) {
      sec.questions.push("");
      console.log("Question Added");
    },
    removeQuestion: function(q, section) {
      function toRemove(element, index, array) {
        return element == q;
      }
      var n = section.findIndex(toRemove);
      section.splice(n, 1);
      console.log("Question removed");
    },
    addSection: function(t, sec) {
      var newSec = Object();
      newSec.section_nm = "New Section";
      newSec.questions = Array();

      //newSec.id = sec.length;
      sec.push(newSec);
      console.log("Section Added");
    },
    removeSection: function(sec, sections) {
      //const toRemove = element => (element.id = sec.id);
      function toRemove(element, index, array) {
        return element.section_nm == sec.section_nm;
      }
      var n = sections.findIndex(toRemove);
      sections.splice(n, 1);
      console.log("Section removed");
    },

    postTemplate: function() {
      // this.NetError = false;
      // this.SaveSucc = false;

      let req = Object();
      req.name = this.name;
      req.schema = JSON.stringify( this.sections);
      if (this.valid) {
        this.setAlert("Saving");

       if (Number.isInteger(parseInt(window.location.pathname.split("/").pop()))){
         req.id = this.id;
        axios
          .post("http://localhost/api/v1/template/" +this.id, req,{
            headers: { "Authorization":'Bearer '+ this.AuthStr ,  "Content-Type" : "application/json"},
          })
          .then(
            response => {
              console.log("Update done!");
              this.items = response.data; //
              //this.loading = true;
              this.setAlert("SaveSucc");
              console.log('Template Updated');
              window.location.href = '/template/'+ this.items.data.id
              //this.SaveSucc = true; //TODO: time it
            },
            error => {
              console.log("Update failed!");
              //this.loading = false;
              this.setAlert("NetError");
            }
          );
      }
      else{
        axios
          .post("http://localhost/api/v1/template", req,{
            headers: { "Authorization":'Bearer '+ this.AuthStr ,  "Content-Type" : "application/json"},
          })
          .then(
            response => {
              console.log("Create done!");
              this.items = response.data; //
              //this.loading = true;
              this.setAlert("SaveSucc");
              console.log('Template Created');
              window.location.href = '/template/'+ this.items.data.id
            },
            error => {
              console.log("Update failed!");
              //this.loading = false;
              this.setAlert("NetError");
            }
          );

      }
      }
    },
  },
  mounted() {
    this.loading = true;
    
    if (Number.isInteger(parseInt(window.location.pathname.split("/").pop()))){
      
      console.log(window.location.pathname.split("/").pop())
          axios
      .get("/api/v1/template/" + this.id, {
        headers: { Authorization:'Bearer '+ this.AuthStr }
      })
      .then(
        response => {
          console.log("fetch done!");
          let schema = JSON.parse(response.data.data.schema);
          this.sections = schema;
          this.name = response.data.data.name;
          this.id = response.data.data.id;
          this.loading = false;
        },
        error => {
          console.log("fetch failed!");
          this.loading = false;
          this.NetError = true;
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