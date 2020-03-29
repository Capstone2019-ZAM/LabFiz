<template>
  <div>
     <v-container justify="center" >
     <v-breadcrumbs :items="navlist"></v-breadcrumbs>
    </v-container>
    
    <inspection-my-table></inspection-my-table>
  </div>
</template>
<script>
import InspectionMyTable from "./InspectionMyTable";
export default {
  components: {
    "inspection-my-table": InspectionMyTable
  },
  data(){
    return {
      navlist:[
        {
          text: 'Home',
          disabled: false,
          href: '/dashboard',
        },
        {
          text: 'My Assignments',
          disabled: true,
          href: '/myassignments',
        },
      ],

    }
  }
};
</script>