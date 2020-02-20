<template>
  <v-card
  color="teal lighten-5"
    md="4"
    sm="12"
    hover
    outlined
      height="200"
      width="400"
    @click="navigate(data.link)"
  >
  <v-container  align="center" justify="center">
  <v-row cols="12" align="center" justify="center">
    <v-col md="4">
      <v-icon max-height="auto" size="90">{{data.img}}</v-icon>
    </v-col>
    
    <v-col md="8" >
        <div class="headline">
           {{data.title}}
        </div>
        <v-card-subtitle justify="start" >
          {{data.desc}}
        </v-card-subtitle>

    </v-col>
  </v-row>
  </v-container>
  </v-card>
</template>
 
<script>
export default {
  props: ["data"],
  methods :{
    navigate (addr){
        window.location.href = addr
    }
  }
};
</script>
