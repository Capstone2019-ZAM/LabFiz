<template>
  <v-card>
    <v-row>
      <v-col cols="12" md="6">
        <v-card-text>Question Here</v-card-text>
      </v-col>
      <v-col cols="12" md="2" v-for="n in 3" :key="n">
        <v-checkbox
        v-model="checkbox"
        :label="`Checkbox 1`"
      ></v-checkbox>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field></v-text-field>
      </v-col>
    </v-row>
  </v-card>
</template>


<script>
export default {
    data (){
        return{
              checkbox: true,
        }

    }


};
</script>