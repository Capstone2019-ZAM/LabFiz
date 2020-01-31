<template>
  <v-row justify="center">
    <v-card width="80%" class="mx-auto">
      <v-row align="center" justify="center">
        <v-col cols="12" md="9">
          <v-card-title>Template Builder</v-card-title>
        </v-col>

        <v-col cols="12" md="3" sm="6">
          <v-btn color="primary">
            <v-icon>mdi-content-save</v-icon>Save
          </v-btn>
        </v-col>
      </v-row>
      <v-form v-model="valid">
        <v-container>
          <div class="border pa-4 mb-4">
            <v-row>
              <v-col cols="12" md="6" sm="12">
                <v-text-field
                  v-model="title"
                  :counter="10"
                  label="Report Title"
                  required
                ></v-text-field>
              </v-col>
              <v-spacer></v-spacer>
            </v-row>
          </div>
          <div class="border pa-4" v-for="sec in sections" :key="sec.id">
            <v-row >
              <v-col cols="12" md="5">
                <v-text-field
                  v-model="sec.section_nm"
                 
                  label="Section Title"
                  outlined
                  required
                ></v-text-field>
              </v-col><v-spacer></v-spacer>
            <v-col cols="12" md="3">
               <v-btn  color="black"  dark @click="removeSection(sec,sections)">
              <v-icon>mdi-minus-circle</v-icon>Remove Section
            </v-btn>
            </v-col>
            </v-row>
            <v-row  v-for="(qs,index) in sec.questions" :key="index">
              <v-col cols="12" md="9">
                <v-text-field  v-model="sec.questions[index]" :rules="qRules" label="Question" required ></v-text-field>
              </v-col>

              <v-col cols="12" md="2">
                <v-btn darl @click="removeQuestion(qs,sections)">Remove</v-btn>
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
  </v-row>
</template>
<script>
export default {
  data: () => ({
    valid: false,
     title: "",
    // questions: "",
    // section_title: "",
    qRules: [v => !!v || "Question is required"],
    sections : [ {section_nm : "Section 1", id : 1 , questions: ["A1w are u?", "B2w do u do"]},
                {section_nm : "Section 2", id :2 , questions: [ "H3w do u do"]}]
    }),
    methods :{

      addQuestion :function(sec){
        sec.questions.push("");
        console.log('Question Added')
      },
      removeQuestion : function(q, section){
        debugger
        const toRemove = ( element => element= q)
        section.splice(section.questions.findIndex(toRemove) ,1);
        // section.questions.pop();
        console.log('Question removed')
      },
      addSection : function(t , sec){
        var newSec = Object();
        newSec.section_nm = "";
        newSec.questions = Array();
        
        newSec.id= sec.length
        sec.push(newSec);
        console.log('Section Added')
      },
      removeSection : function(sec,sections){
        const toRemove = ( element => element.id = sec.id)
        sections.splice(sections.findIndex(toRemove) ,1);
        console.log('Section removed')
      },

      postTemplate : function(){

      }
      
      

    }
};
</script>


<style scoped>
.border {
  border-color: black;
}
</style>