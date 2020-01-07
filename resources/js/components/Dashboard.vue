<template>
  <v-container >
    <!-- <v-layout row wrap align-start="">
        <v-flex  xs12 sm6 md4 lg4 xl2 > 
            <dash-button></dash-button>
        </v-flex>

        <v-flex  xs12 sm6 md3 lg3 xl2 > 
            <dash-button></dash-button>
        </v-flex>

    
    </v-layout>-->
   
    <v-row>
         <div v-for="data in options">
      <v-col>
        <dash-button :data="data"></dash-button>
      </v-col>
          </div>
 
    </v-row>
  </v-container>
</template>

<script>
import DashButton from "./DashButton";
export default {
  components: {
    "dash-button": DashButton
  },
  data() {
    return {
      options: [
        {
          icon: "mdi-file-document-edit",
          title: "Assign Inspections",
          description: "Something said here"
        },
        {
          icon: "mdi-account-card-details",
          title: "Account Managment",
          description: "Something said here"
        },
        {
          icon: "mdi-clipboard-text-multiple",
          title: "Templates",
          description: "Something said here"
        },
        {
          icon: "mdi-bug",
          title: "Issue Tracker",
          description: "Something said here"
        },
        {
          icon: "mdi-timetable",
          title: "Pending Inspections",
          description: "Something said here"
        }

      ]
    };
  }
};
</script>

