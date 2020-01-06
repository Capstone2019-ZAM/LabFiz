<template>
    <v-card max-width="420" max-height="200" class="mx-auto pa-3 d-flex flex-row" hover outlined>
      <v-layout row wrap align-content-center >
        <v-flex xs2 md4 centered>
          <v-responsive >
            <v-icon max-height="auto" size="90">{{data.icon}}</v-icon>
          </v-responsive>
        </v-flex>

        <v-flex xs10 md8 >
          <v-card-text>
            <v-card-title class="headline">
              <span >{{data.title}} </span> </v-card-title>

            <v-card-subtitle class="grey--light"> <span>{{data.description}} </span> </v-card-subtitle>
          </v-card-text>
        </v-flex>
      </v-layout>
    </v-card>
</template>

<script>
export default {
 props: ['data']
};
</script>


// data() {
//     return {
//       icon: 'mdi-file-document-edit',
//       title: 'Inspections',
//       description: 'Something',
//     }
//  }