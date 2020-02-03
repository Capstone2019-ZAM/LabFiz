<template>
  <v-card
    max-width="420"
    max-height="200"
    min-height="200"
    min-width="200"
    class="mx-auto pa-3 d-flex flex-row"
    hover
    outlined
  >
    <v-layout dark row wrap align-content-center>
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
          <!-- <v-card-subtitle class="greFy--light">  </v-card-subtitle> -->
        </v-card-text>
      </v-flex>
    </v-layout>
  </v-card>
</template>
 
<script>
export default {
  props: ["data"]
};
</script>


// data() {
//     return {
//       icon: 'mdi-file-document-edit',
//       title: 'Inspections',
//       description: 'Something',
//     }
//  }