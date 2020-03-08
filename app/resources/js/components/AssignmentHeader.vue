<template>

  <v-row justify="center">
    <v-card width="80%" max-width="1000px"
     v-if="data !== null" >
      <v-row>
        <v-col cols="12" md="8">
          <v-card-title>{{data.title}}</v-card-title>
       
          <v-card-subtitle class="headline">{{data.lab}}</v-card-subtitle>
        </v-col>
        <v-col cols="12" md="4">
          <v-card-subtitle class="subtitle-1	">{{'Status: ' +data.status}}<br>          
          {{'Due Date: ' +data.due_date}}</v-card-subtitle>

        </v-col>
      </v-row> 
    </v-card>
  </v-row>
</template>


<script>
export default {
    props: ["data"],
    methods:{
      navigate(point){
        window.location.href= '/'+point
      }
    }
};
</script>