<template>
    <div id="app">
    <v-form v-model="valid">
      <v-container>
        <v-row>
          <v-col
            cols="12"
            md="8"
          >
            <v-text-field
              v-model="title"
              :rules="nameRules"
              :counter="10"
              label="Report Title"
              required
            ></v-text-field>          </v-col>

            <v-col
            cols="12"
            md="2">
             <v-btn right>
            Save
        </v-btn></v-col>
  
          <v-col
            cols="12"
            md="5"
          >
            <v-text-field
              v-model="section_title"
              :rules="nameRules"
              :counter="10"
              label="Section Title"
              required
            ></v-text-field>
          </v-col>
  
          <v-col
            cols="12"
            md="10"
          >
            <v-text-field
              v-model="question"
              :rules="emailRules"
              label="Question"
              required
            ></v-text-field>
             <v-btn>
            Add Question
        </v-btn>
          </v-col>
        </v-row>
        <v-btn>
            Add Section
        </v-btn>
      </v-container>
    </v-form>
</div>
</template>
<script>
export default {
    data: () => ({
    valid: false,
    title: '',
    section_title: '',
    nameRules: [
      v => !!v || 'Name is required',
      v => v.length <= 10 || 'Name must be less than 10 characters',
    ],
    email: '',
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+/.test(v) || 'E-mail must be valid',
    ],
  }),
}
</script>