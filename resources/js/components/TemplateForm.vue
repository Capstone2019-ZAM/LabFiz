<template>
  <div id="app">
    <v-form v-model="valid">
      <v-container >
        <v-row  >
          <v-col cols="12" md="6" sm="4">
            <v-text-field
              v-model="title"
              :rules="nameRules"
              :counter="10"
              label="Report Title"
              required
            ></v-text-field>
          </v-col>

          <!-- <v-col cols="12" md="3">
            <v-spacer></v-spacer>
          </v-col>-->
          <v-spacer></v-spacer>

          <v-col  align="center" justify="end">
          <v-btn dark>
            <v-icon>mdi-content-save</v-icon>Save
          </v-btn>
          </v-col>
        </v-row>
        <v-row> 
          <v-col cols="12" md="5">
            <v-text-field
              v-model="section_title"
              :rules="nameRules"
              :counter="10"
              label="Section Title"
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>

          <v-col cols="12" md="10">
            <v-text-field v-model="question" :rules="emailRules" label="Question" required></v-text-field>
          </v-col>
        </v-row>

        <v-row align="center" justify="center">
          <v-btn dark>
            <v-icon>mdi-plus-circle</v-icon>Add Question
          </v-btn>
        </v-row>
        <v-row class="ma-3">
        <v-spacer></v-spacer>
        </v-row>
        <v-row align="center" justify="center" >
            <v-btn dark block>
              <v-icon>mdi-plus-circle</v-icon>Add Section
            </v-btn>
        </v-row>
      </v-container>
    </v-form>
  </div>
</template>
<script>
export default {
  data: () => ({
    valid: false,
    title: "",
    section_title: "",
    nameRules: [
      v => !!v || "Name is required",
      v => v.length <= 10 || "Name must be less than 10 characters"
    ],
    email: "",
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+/.test(v) || "E-mail must be valid"
    ]
  })
};
</script>