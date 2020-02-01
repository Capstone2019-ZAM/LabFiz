<template>
  <v-row justify="center">
    <v-col cols="12" md="9" sm="12" xs="12" xl="6" lg="6">
      <v-card class="mx-auto">
        <v-row align="center" justify="center">
          <v-row align="center" justify="center">
            <v-col cols="12" md="9">
              <v-card-title class="ma2">Template Builder</v-card-title>
            </v-col>

            <v-col cols="12" md="3" sm="6">
              <v-btn color="primary" @click="postTemplate()">
                <v-icon>mdi-content-save</v-icon>Save
              </v-btn>
            </v-col>
          </v-row>
        </v-row>
        <v-row align="center" justify="center">
          <v-alert type="info" text transition="scale-transition" :value="Saving">
            <v-progress-circular indeterminate color="primary"></v-progress-circular>Saving
          </v-alert>
          <v-alert
            type="warning"
            outlined
            prominent
            transition="scale-transition"
            :value="!valid"
          >Template missing required fields</v-alert>
          <v-alert type="success" transition="scale-transition" :value="SaveSucc">Saved Successfully</v-alert>
          <v-alert
            type="error"
            transition="scale-transition"
            :value="NetError"
          >Something went wrong. Please try again later</v-alert>
        </v-row>
        <v-form v-model="valid">
          <v-container>
            <div class="border pa-4 mb-4 mt-5">
              <v-row>
                <v-col cols="12" md="9" sm="12">
                  <v-text-field
                    v-model="title"
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
                <v-col cols="12" md="6">
                  <v-text-field
                    v-model="sec.section_nm"
                    label="Section Title"
                    :rules="qRules"
                    outlined
                    required
                  ></v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="12" md="1">
                  <v-btn color="red" small icon @click="removeSection(sec,sections)">
                    <v-icon>mdi-close-circle</v-icon>
                  </v-btn>
                </v-col>
              </v-row>
              <v-row v-for="(qs,index) in sec.questions" :key="index">
                <v-col cols="12" md="8">
                  <v-text-field
                    v-model="sec.questions[index]"
                    :rules="qRules"
                    label="Question"
                    required
                  ></v-text-field>
                </v-col>
                <v-spacer></v-spacer>

                <v-col cols="12" md="1">
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
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
export default {
  data: () => ({
    valid: false,
    Saving: false,
    NetError: false,
    SaveSucc: false,
    loading: false,
    AuthStr: localStorage.getItem("api"),
    id: 1, // Get this from URL or router
    title: "",

    qRules: [v => !!v || "Item value is required"],
    sections: Array
    // [
    //   {
    //     section_nm: "Section 1",
    //     questions: ["q1?", ""]
    //   }
    // ]
  }),
  methods: {
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
      this.Saving = true;
      const req = Object;
      req.title = this.title;
      req.sections = this.sections;
      if (this.valid) {
        axios
          .put("http://localhost/api/v1/template/" + this.id, {
            headers: { Authorization: this.AuthStr }

            //TO DO : ADD Data to sent
          })
          .then(
            response => {
              console.log("Update done!");
              this.items = response.data;
              this.loading = true;
            },
            error => {
              console.log("Update failed!");
              this.loading = false;
              this.Saving= false;
              this.NetError = true;
            }
          );
      }
    }
  },
  mounted() {
    this.loading = true;
    axios
      .get("http://localhost/api/v1/template/" + this.id, {
        headers: { Authorization: this.AuthStr }
      })
      .then(
        response => {
          console.log("fetch done!");
          let schema = JSON.parse(response.data.data.schema);
          this.sections = schema.sections;
          this.title = response.data.data.name;
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
};
</script>


<style scoped>
.border {
  border-color: black;
}
</style>