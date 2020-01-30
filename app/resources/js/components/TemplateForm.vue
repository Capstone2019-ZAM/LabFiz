<template>
  <v-row justify="center">
    <v-card width="80%" max-height="600px" class="mx-auto">
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
                  v-model="section_title"
                  :counter="10"
                  label="Section Title"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" md="10">
                <v-text-field v-model="questions" :rules="qRules" label="Question" required></v-text-field>
              </v-col>
            </v-row>

            <v-row align="center" justify="center">
              <v-btn color="primary">
                <v-icon>mdi-plus-circle</v-icon>Add Question
              </v-btn>
            </v-row>
          </div>
          <v-row class="ma-3"></v-row>
          <v-row align="center" justify="center">
            <v-btn block color="primary">
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
    // title: "",
    // questions: "",
    // section_title: "",
    qRules: [v => !!v || "Question is required"],
    sections : [ {section_nm : "Section 1", id : 1 , questions: ["How are u?", "How do u do"]}]
    })
};
</script>


<style scoped>
.border {
  border-color: black;
}
</style>