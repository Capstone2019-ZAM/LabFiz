<template>
  <v-card
    md="4"
    sm="12"
    hover
    outlined

     align="center" justify="center"
    @click="navigate(data.link)"
  >

  <v-row cols="12" align="center" justify="center">
    <v-col md="4">
      <v-icon max-height="auto" size="90">{{data.img}}</v-icon>
    </v-col>
    
    <v-col md="8">
        <v-card-title>
           {{data.title}}
        </v-card-title>
        <v-card-subtitle>
          {{data.desc}}
        </v-card-subtitle>

    </v-col>
  </v-row>
    <!-- <v-layout dark row wrap align-content-center>
      <v-flex xs2 md4 centered pa-3>
        <v-responsive pa-2>
          <v-icon max-height="auto" size="90">{{data.img}}</v-icon>
        </v-responsive>
      </v-flex>

      <v-flex xs10 md8>
        <v-card-text>
          <v-list-item-title class="headline">
            <span>{{data.title}}</span>
          </v-list-item-title>
          <v-list-item-subtitle class="grey--light">
            <span>{{data.desc}}</span>
          </v-list-item-subtitle>
          <!-- <v-card-title class="headline"> -->
          <!-- <v-card-subtitle class="greFy--light">  </v-card-subtitle> 
        </v-card-text>
      </v-flex>
    </v-layout> -->
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
